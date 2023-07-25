<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\Validation\Validation;
use Cake\Validation\Validator;
use Psr\Http\Message\UploadedFileInterface;

/**
 * BookCollections Controller
 *
 * @property \App\Model\Table\BookCollectionsTable $BookCollections
 * @method \App\Model\Entity\BookCollection[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BookCollectionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['LibCollections'],
        ];
        $bookCollections = $this->paginate($this->BookCollections);

        $this->set(compact('bookCollections'));
    }

    /**
     * View method
     *
     * @param string|null $id Book Collection id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bookCollection = $this->BookCollections->get($id, [
            'contain' => ['LibCollections', 'Books'],
        ]);

        $this->set(compact('bookCollection'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        //dd($this->request->getData());
        $targetPath = WWW_ROOT. 'uploads'. DS;
        $maxFileUploadSizeMB = intval(ini_get('upload_max_filesize'));
        $maxFileUploadSizeB = $maxFileUploadSizeMB*1024*1024;

        $bookCollection = $this->BookCollections->newEmptyEntity();

        if ($this->request->is('post')) {

            $videoFiles = ['video_files' => []];

            if($this->request->getData('video_file')){
                foreach($this->request->getData('video_file') as $video){
                    $videoFiles['video_files'][] = ['video_file' => $video];
                }
            }

            $validator = new Validator();

            $videoValidator = new Validator();

            $videoValidator
                ->notEmptyFile('video_file')
                ->uploadedFile('video_file', [
                    'types' => ['video/mp4'], // only PNG image files
                    'minSize' => 1024, // Min 1 KB
                    'maxSize' => $maxFileUploadSizeB
                ], 'File size max '.$maxFileUploadSizeMB.'MB, only mp4 video')
                ->add('video_file', 'filename', [
                    'rule' => function (UploadedFileInterface $file) {
                        // filename must not be a path
                        $filename = $file->getClientFilename();
                        if (strcmp(basename($filename), $filename) === 0) {
                            return true;
                        }

                        return false;
                    }
                ])
                ->add('video_file', 'extension', [
                    'rule' => ['extension', ['mp4']] // .png file extension only
                ]);

            $validator->addNestedMany('video_files', $videoValidator);

            $videoFileErrors = $validator->validate($videoFiles);

            $errors = [];
            $connection = ConnectionManager::get('default');
            $connection->begin();

            if(!empty($videoFileErrors)){
                foreach($videoFileErrors['video_files'] as $i=>$video){
                    foreach($video as $errors) {
                        foreach ($errors as $message){
                            $errors[] = __('Video '.($i+1).': '.$message);
                        }
                    }
                }
            }
            else{
                $bookCollectionData = array_replace_recursive([
                    'name' => null,
                    'lib_collection_id' => null,
                    'start_date' => null,
                    'end_date' => null,
                ], $this->request->getData());

                $bookCollection = $this->BookCollections->patchEntity($bookCollection, $bookCollectionData);

                if ($this->BookCollections->save($bookCollection)) {

                    $theLib = $this->BookCollections->LibCollections->get($this->request->getData()['lib_collection_id']);
                    $totalRequiredBooks = 0;
                    if(!$theLib) $errors[] = __("No Lib Collection Selected");
                    else $totalRequiredBooks = $theLib->lib_count;

                    if(!$errors){
                        $imageFiles = $this->request->getData('image_file');
                        if(count($imageFiles) != $totalRequiredBooks) $errors[] = __("Not enough images");
                        if(count($videoFiles['video_files']) != $totalRequiredBooks) $errors[] = __("Not enough videos");

                        if(!$errors){
                            if($videoFiles['video_files']){
                                foreach($videoFiles['video_files'] as $i=>$videoContainer){
                                    if($errors) break;
                                    $video = $videoContainer['video_file'];
                                    //echo 'looping '.$i.'<br/>';
                                    if($video->getSize() > 0 && $video->getError() == 0){
                                        //echo 'video '.$i.' no error<br/>';
                                        $book = $this->fetchTable('Books')->newEmptyEntity();
                                        $pathInfo = pathinfo($video->getClientFilename());
                                        $book['name'] = $pathInfo['filename'];
                                        $video_file_name = $pathInfo['filename'].'_'.time().'.'.$pathInfo['extension'];
                                        $book['video'] = $video_file_name;

                                        if($this->fetchTable('Books')->save($book)){
                                            //echo 'book '.$i.' saved<br/>';
                                            try {
                                                $video->moveTo($targetPath.$video_file_name);
                                            } catch (\Exception $exception){
                                                $errors[] = 'Could not save uploaded video '.($i+1);
                                            }

                                            if(!$errors && isset($imageFiles[$i])){
                                                //echo 'image found '.$i.'<br/>';
                                                $img = explode(',', $imageFiles[$i]);
                                                $imgData = base64_decode($img[1]);
                                                $imgFilename = $pathInfo['filename'].'_'.time().'.jpg';

                                                $bookImage = $this->fetchTable('BookImages')->newEmptyEntity();
                                                $bookImage['book_id'] = $book->id;
                                                $bookImage['filename'] = $imgFilename;

                                                if($this->fetchTable('BookImages')->save($bookImage)){
                                                    //echo 'book image saved '.$i.'<br/>';
                                                    if(file_put_contents($targetPath.$imgFilename, $imgData) === false)
                                                        $errors[] = 'Could not save image file for book '.($i+1);

                                                    if(!$errors){
                                                        $bookCollectionBooks = $this->fetchTable('BookCollectionsBooks')->newEmptyEntity();
                                                        $bookCollectionBooks['book_collection_id'] = $bookCollection->id;
                                                        $bookCollectionBooks['book_id'] = $book->id;

                                                        if($this->fetchTable('BookCollectionsBooks')->save($bookCollectionBooks) === false){
                                                            $errors[] = __("Could not store assign the book ".($i+1)." to the book collection");
                                                        }
                                                    }
                                                }
                                                else $errors[] = __("Could not save book image of book ".($i+1));
                                            }
                                        }
                                        else $errors[] = __("Could not save book ".($i+1));
                                    }
                                    else $errors[] = __("Video ".($i+1).": error");
                                }
                            }
                        }
                    }
                }
                else $errors[] = __('Could not save the book collection');
            }

            if($errors) {
                $connection->rollback();
                $this->Flash->error(implode(htmlspecialchars(PHP_EOL), $errors));
            }
            else{
                $connection->commit();
                $this->Flash->success(__('The book collection has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $libCollections = $this->BookCollections->LibCollections->find('list', ['limit' => 200])->all();
        $libCollectionsLibCount = $this->BookCollections->LibCollections->find('list', ['limit' => 200, 'keyField' => 'id', 'valueField' => 'lib_count'])->all();
        $books = $this->BookCollections->Books->find('list', ['limit' => 200])->all();
        $this->set(compact('bookCollection', 'libCollections', 'books', 'libCollectionsLibCount'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Book Collection id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bookCollection = $this->BookCollections->get($id, [
            'contain' => ['Books'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bookCollection = $this->BookCollections->patchEntity($bookCollection, $this->request->getData());
            if ($this->BookCollections->save($bookCollection)) {
                $this->Flash->success(__('The book collection has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book collection could not be saved. Please, try again.'));
        }
        $libCollections = $this->BookCollections->LibCollections->find('list', ['limit' => 200])->all();
        $books = $this->BookCollections->Books->find('list', ['limit' => 200])->all();
        $this->set(compact('bookCollection', 'libCollections', 'books'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Book Collection id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bookCollection = $this->BookCollections->get($id);
        if ($this->BookCollections->delete($bookCollection)) {
            $this->Flash->success(__('The book collection has been deleted.'));
        } else {
            $this->Flash->error(__('The book collection could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

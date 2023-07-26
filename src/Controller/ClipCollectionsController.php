<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\Validation\Validation;
use Cake\Validation\Validator;
use Psr\Http\Message\UploadedFileInterface;

/**
 * ClipCollections Controller
 *
 * @property \App\Model\Table\ClipCollectionsTable $ClipCollections
 * @method \App\Model\Entity\ClipCollection[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClipCollectionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ScreenCollections'],
        ];
        $clipCollections = $this->paginate($this->ClipCollections);

        $this->set(compact('clipCollections'));
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
        $clipCollection = $this->ClipCollections->get($id, [
            'contain' => ['ScreenCollections', 'Clips'],
        ]);

        $this->set(compact('clipCollection'));
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

        $clipCollection = $this->ClipCollections->newEmptyEntity();

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
                $clipCollectionData = array_replace_recursive([
                    'name' => null,
                    'screen_collection_id' => null,
                    'start_date' => null,
                    'end_date' => null,
                ], $this->request->getData());

                $clipCollection = $this->ClipCollections->patchEntity($clipCollection, $clipCollectionData);

                if ($this->ClipCollections->save($clipCollection)) {

                    $theLib = $this->ClipCollections->ScreenCollections->get($this->request->getData()['screen_collection_id']);
                    $totalRequiredClips = 0;
                    if(!$theLib) $errors[] = __("No Lib Collection Selected");
                    else $totalRequiredClips = $theLib->screen_count;

                    if(!$errors){
                        $imageFiles = $this->request->getData('image_file');
                        if(count($imageFiles) != $totalRequiredClips) $errors[] = __("Not enough images");
                        if(count($videoFiles['video_files']) != $totalRequiredClips) $errors[] = __("Not enough videos");

                        if(!$errors){
                            if($videoFiles['video_files']){
                                foreach($videoFiles['video_files'] as $i=>$videoContainer){
                                    if($errors) break;
                                    $video = $videoContainer['video_file'];
                                    //echo 'looping '.$i.'<br/>';
                                    if($video->getSize() > 0 && $video->getError() == 0){
                                        //echo 'video '.$i.' no error<br/>';
                                        $clip = $this->fetchTable('Clips')->newEmptyEntity();
                                        $pathInfo = pathinfo($video->getClientFilename());
                                        $clip['name'] = $pathInfo['filename'];
                                        $video_file_name = $pathInfo['filename'].'_'.time().'.'.$pathInfo['extension'];
                                        $clip['video'] = $video_file_name;

                                        if($this->fetchTable('Clips')->save($clip)){
                                            //echo 'clip '.$i.' saved<br/>';
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

                                                $bookImage = $this->fetchTable('ClipImages')->newEmptyEntity();
                                                $bookImage['clip_id'] = $clip->id;
                                                $bookImage['filename'] = $imgFilename;

                                                if($this->fetchTable('ClipImages')->save($bookImage)){
                                                    //echo 'clip image saved '.$i.'<br/>';
                                                    if(file_put_contents($targetPath.$imgFilename, $imgData) === false)
                                                        $errors[] = 'Could not save image file for clip '.($i+1);

                                                    if(!$errors){
                                                        $clipCollectionItems = $this->fetchTable('ClipCollectionsItems')->newEmptyEntity();
                                                        $clipCollectionItems['clip_collection_id'] = $clipCollection->id;
                                                        $clipCollectionItems['clip_id'] = $clip->id;

                                                        if($this->fetchTable('ClipCollectionsItems')->save($clipCollectionItems) === false){
                                                            $errors[] = __("Could not store assign the clip ".($i+1)." to the clip collection");
                                                        }
                                                    }
                                                }
                                                else $errors[] = __("Could not save clip image of clip ".($i+1));
                                            }
                                        }
                                        else $errors[] = __("Could not save clip ".($i+1));
                                    }
                                    else $errors[] = __("Video ".($i+1).": error");
                                }
                            }
                        }
                    }
                }
                else $errors[] = __('Could not save the clip collection');
            }

            if($errors) {
                $connection->rollback();
                $this->Flash->error(implode(htmlspecialchars(PHP_EOL), $errors));
            }
            else{
                $connection->commit();
                $this->Flash->success(__('The clip collection has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $screenCollections = $this->ClipCollections->ScreenCollections->find('list', ['limit' => 200])->all();
        $screenCollectionsScreenCount = $this->ClipCollections->ScreenCollections->find('list', ['limit' => 200, 'keyField' => 'id', 'valueField' => 'screen_count'])->all();
        $clips = $this->ClipCollections->Clips->find('list', ['limit' => 200])->all();
        $this->set(compact('clipCollection', 'screenCollections', 'clips', 'screenCollectionsScreenCount'));
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
        $clipCollection = $this->ClipCollections->get($id, [
            'contain' => ['Clips'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $clipCollection = $this->ClipCollections->patchEntity($clipCollection, $this->request->getData());
            if ($this->ClipCollections->save($clipCollection)) {
                $this->Flash->success(__('The clip collection has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clip collection could not be saved. Please, try again.'));
        }
        $screenCollections = $this->ClipCollections->ScreenCollections->find('list', ['limit' => 200])->all();
        $clips = $this->ClipCollections->Clips->find('list', ['limit' => 200])->all();
        $this->set(compact('clipCollection', 'screenCollections', 'clips'));
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
        $clipCollection = $this->ClipCollections->get($id);
        if ($this->ClipCollections->delete($clipCollection)) {
            $this->Flash->success(__('The clip collection has been deleted.'));
        } else {
            $this->Flash->error(__('The clip collection could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

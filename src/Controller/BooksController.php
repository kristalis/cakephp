<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Books Controller
 *
 * @property \App\Model\Table\BooksTable $Books
 * @method \App\Model\Entity\Book[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BooksController extends AppController
{
    public function beforeRender(\Cake\Event\EventInterface $event)
    {
        //$this->viewBuilder()->setTheme('Modern');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $books = $this->paginate($this->Books);

        $this->set(compact('books'));
    }

    /**
     * View method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $book = $this->Books->get($id, [
            'contain' => ['BookImages'],
        ]);

        $this->set(compact('book'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $book = $this->Books->newEmptyEntity();
        if ($this->request->is('post')) {
            $book = $this->Books->patchEntity($book, $this->request->getData());
            if ($this->Books->save($book)) {
                $book_image = $this->fetchTable('BookImages')->newEmptyEntity();
                $book_image_data = [
                    'book_id' => $book->id,
                ];
                $postImage = $this->request->getData('book_image');
                $name = $postImage->getClientFilename();
                $type = $postImage->getClientMediaType();
                $targetPath = WWW_ROOT. 'uploads'. DS;

                if ($type == 'image/jpeg' || $type == 'image/jpg' || $type == 'image/png') {
                    if (!empty($name)) {
                        if ($postImage->getSize() > 0 && $postImage->getError() == 0) {
                            $postImage->moveTo($targetPath.$name);
                            $book_image_data['filename'] = $name;
                            $book_image = $this->fetchTable('BookImages')->patchEntity($book_image, $book_image_data);
                            if($this->fetchTable('BookImages')->save($book_image)){
                                $this->Flash->success(__('Book image uploaded'));
                            }
                            else{
                                $this->Flash->error(__('Book image not uploaded'));
                            }
                        }
                        else{
                            $this->Flash->error(__('Book image not saved'));
                        }
                    }
                    else{
                        $this->Flash->error(__('Book image not found'));
                    }
                }
                else{
                    $this->Flash->error(__('Book image has to be JPEG, PNG type.'));
                }

                $this->Flash->success(__('The book has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book could not be saved. Please, try again.'));
        }
        $this->set(compact('book'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $book = $this->Books->get($id, [
            'contain' => ['BookImages'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $book = $this->Books->patchEntity($book, $this->request->getData());
            if ($this->Books->save($book)) {
                $previous_image = null;
                $book_image = $book->book_images ? $book->book_images[0] : $this->fetchTable('BookImages')->newEmptyEntity();
                if($book->book_images){
                    $previous_image = $book_image->filename;
                }
                $book_image_data = [
                    'book_id' => $book->id,
                ];
                $postImage = $this->request->getData('book_image');
                $name = $postImage->getClientFilename();
                $pathInfo = pathinfo($name);
                $newFilename = $pathInfo['filename'].time().'.'.$pathInfo['extension'];
                $type = $postImage->getClientMediaType();
                $targetPath = WWW_ROOT. 'uploads'. DS;
                //TODO: we should rename the file as we upload same file as previous it will unlink the previous file
                if (!empty($name)) {
                    if ($postImage->getSize() > 0 && $postImage->getError() == 0) {
                        if($type == 'image/jpeg' || $type == 'image/jpg' || $type == 'image/png'){
                            $postImage->moveTo($targetPath.$newFilename);
                            $book_image_data['filename'] = $newFilename;
                            $book_image = $this->fetchTable('BookImages')->patchEntity($book_image, $book_image_data);
                            if($this->fetchTable('BookImages')->save($book_image)){
                                if($previous_image) @unlink(WWW_ROOT.'uploads'.DS.$previous_image);
                                $this->Flash->success(__('Book image uploaded'));
                            }
                            else{
                                $this->Flash->error(__('Book image not uploaded'));
                            }
                        }
                        else{
                            $this->Flash->error(__('Book image has to be JPEG, PNG type.'));
                        }
                    }
                    else{
                        $this->Flash->error(__('Error in book image upload'));
                    }
                }

                $this->Flash->success(__('The book has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book could not be saved. Please, try again.'));
        }
        $this->set(compact('book'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $book = $this->Books->get($id);
        if ($this->Books->delete($book)) {
            $this->Flash->success(__('The book has been deleted.'));
        } else {
            $this->Flash->error(__('The book could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Clips Controller
 *
 * @property \App\Model\Table\ClipsTable $Clips
 * @method \App\Model\Entity\Book[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClipsController extends AppController
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
        $clips = $this->paginate($this->Clips);

        $this->set(compact('clips'));
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
        $clip = $this->Clips->get($id, [
            'contain' => ['ClipImages'],
        ]);

        $this->set(compact('clip'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $clip = $this->Clips->newEmptyEntity();
        if ($this->request->is('post')) {
            $clip = $this->Clips->patchEntity($clip, $this->request->getData());
            if ($this->Clips->save($clip)) {
                $clip_image = $this->fetchTable('ClipImages')->newEmptyEntity();
                $book_image_data = [
                    'clip_id' => $clip->id,
                ];
                $postImage = $this->request->getData('clip_image');
                $name = $postImage->getClientFilename();
                $type = $postImage->getClientMediaType();
                $targetPath = WWW_ROOT. 'uploads'. DS;

                if ($type == 'image/jpeg' || $type == 'image/jpg' || $type == 'image/png') {
                    if (!empty($name)) {
                        if ($postImage->getSize() > 0 && $postImage->getError() == 0) {
                            $postImage->moveTo($targetPath.$name);
                            $book_image_data['filename'] = $name;
                            $clip_image = $this->fetchTable('ClipImages')->patchEntity($clip_image, $book_image_data);
                            if($this->fetchTable('ClipImages')->save($clip_image)){
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

                $this->Flash->success(__('The clip has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clip could not be saved. Please, try again.'));
        }
        $this->set(compact('clip'));
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
        $clip = $this->Clips->get($id, [
            'contain' => ['ClipImages'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $clip = $this->Clips->patchEntity($clip, $this->request->getData());
            if ($this->Clips->save($clip)) {
                $previous_image = null;
                $clip_image = $clip->clip_images ? $clip->clip_images[0] : $this->fetchTable('ClipImages')->newEmptyEntity();
                if($clip->clip_images){
                    $previous_image = $clip_image->filename;
                }
                $book_image_data = [
                    'clip_id' => $clip->id,
                ];
                $postImage = $this->request->getData('clip_image');
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
                            $clip_image = $this->fetchTable('ClipImages')->patchEntity($clip_image, $book_image_data);
                            if($this->fetchTable('ClipImages')->save($clip_image)){
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
                        $this->Flash->error(__('Error in clip image upload'));
                    }
                }

                $this->Flash->success(__('The clip has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clip could not be saved. Please, try again.'));
        }
        $this->set(compact('clip'));
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
        $clip = $this->Clips->get($id);
        if ($this->Clips->delete($clip)) {
            $this->Flash->success(__('The clip has been deleted.'));
        } else {
            $this->Flash->error(__('The clip could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

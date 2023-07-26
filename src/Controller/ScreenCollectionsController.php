<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ScreenCollections Controller
 *
 * @property \App\Model\Table\ScreenCollectionsTable $ScreenCollections
 * @method \App\Model\Entity\ScreenCollection[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ScreenCollectionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $screenCollections = $this->paginate($this->ScreenCollections);

        $this->set(compact('screenCollections'));
    }

    /**
     * View method
     *
     * @param string|null $id Lib Collection id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $screenCollection = $this->ScreenCollections->get($id, [
            'contain' => ['ClipCollections'],
        ]);

        $this->set(compact('screenCollection'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $screenCollection = $this->ScreenCollections->newEmptyEntity();
        if ($this->request->is('post')) {
            $screenCollection = $this->ScreenCollections->patchEntity($screenCollection, $this->request->getData());
            if ($this->ScreenCollections->save($screenCollection)) {
                $this->Flash->success(__('The screen collection has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The screen collection could not be saved. Please, try again.'));
        }
        $this->set(compact('screenCollection'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lib Collection id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $screenCollection = $this->ScreenCollections->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $screenCollection = $this->ScreenCollections->patchEntity($screenCollection, $this->request->getData());
            if ($this->ScreenCollections->save($screenCollection)) {
                $this->Flash->success(__('The screen collection has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The screen collection could not be saved. Please, try again.'));
        }
        $this->set(compact('screenCollection'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lib Collection id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $screenCollection = $this->ScreenCollections->get($id);
        if ($this->ScreenCollections->delete($screenCollection)) {
            $this->Flash->success(__('The screen collection has been deleted.'));
        } else {
            $this->Flash->error(__('The screen collection could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

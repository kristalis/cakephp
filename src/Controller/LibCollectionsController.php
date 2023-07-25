<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * LibCollections Controller
 *
 * @property \App\Model\Table\LibCollectionsTable $LibCollections
 * @method \App\Model\Entity\LibCollection[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LibCollectionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $libCollections = $this->paginate($this->LibCollections);

        $this->set(compact('libCollections'));
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
        $libCollection = $this->LibCollections->get($id, [
            'contain' => ['BookCollections'],
        ]);

        $this->set(compact('libCollection'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $libCollection = $this->LibCollections->newEmptyEntity();
        if ($this->request->is('post')) {
            $libCollection = $this->LibCollections->patchEntity($libCollection, $this->request->getData());
            if ($this->LibCollections->save($libCollection)) {
                $this->Flash->success(__('The lib collection has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lib collection could not be saved. Please, try again.'));
        }
        $this->set(compact('libCollection'));
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
        $libCollection = $this->LibCollections->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $libCollection = $this->LibCollections->patchEntity($libCollection, $this->request->getData());
            if ($this->LibCollections->save($libCollection)) {
                $this->Flash->success(__('The lib collection has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lib collection could not be saved. Please, try again.'));
        }
        $this->set(compact('libCollection'));
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
        $libCollection = $this->LibCollections->get($id);
        if ($this->LibCollections->delete($libCollection)) {
            $this->Flash->success(__('The lib collection has been deleted.'));
        } else {
            $this->Flash->error(__('The lib collection could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

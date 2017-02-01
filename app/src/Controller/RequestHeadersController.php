<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RequestHeaders Controller
 *
 * @property \App\Model\Table\RequestHeadersTable $RequestHeaders
 */
class RequestHeadersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $requestHeaders = $this->paginate($this->RequestHeaders);

        $this->set(compact('requestHeaders'));
        $this->set('_serialize', ['requestHeaders']);
    }

    /**
     * View method
     *
     * @param string|null $id Request Header id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $requestHeader = $this->RequestHeaders->get($id, [
            'contain' => ['UserShopAccounts']
        ]);

        $this->set('requestHeader', $requestHeader);
        $this->set('_serialize', ['requestHeader']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $requestHeader = $this->RequestHeaders->newEntity();
        if ($this->request->is('post')) {
            $requestHeader = $this->RequestHeaders->patchEntity($requestHeader, $this->request->data);
            if ($this->RequestHeaders->save($requestHeader)) {
                $this->Flash->success(__('The request header has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The request header could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('requestHeader'));
        $this->set('_serialize', ['requestHeader']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Request Header id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $requestHeader = $this->RequestHeaders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $requestHeader = $this->RequestHeaders->patchEntity($requestHeader, $this->request->data);
            if ($this->RequestHeaders->save($requestHeader)) {
                $this->Flash->success(__('The request header has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The request header could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('requestHeader'));
        $this->set('_serialize', ['requestHeader']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Request Header id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $requestHeader = $this->RequestHeaders->get($id);
        if ($this->RequestHeaders->delete($requestHeader)) {
            $this->Flash->success(__('The request header has been deleted.'));
        } else {
            $this->Flash->error(__('The request header could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

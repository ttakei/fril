<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserShopAccount Controller
 *
 * @property \App\Model\Table\UserShopAccountTable $UserShopAccount
 */
class UserShopAccountController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Shops', 'RequestHeaders']
        ];
        $userShopAccount = $this->paginate($this->UserShopAccount);

        $this->set(compact('userShopAccount'));
        $this->set('_serialize', ['userShopAccount']);
    }

    /**
     * View method
     *
     * @param string|null $id User Shop Account id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userShopAccount = $this->UserShopAccount->get($id, [
            'contain' => ['Users', 'Shops', 'RequestHeaders']
        ]);

        $this->set('userShopAccount', $userShopAccount);
        $this->set('_serialize', ['userShopAccount']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userShopAccount = $this->UserShopAccount->newEntity();
        if ($this->request->is('post')) {
            $userShopAccount = $this->UserShopAccount->patchEntity($userShopAccount, $this->request->data);
            if ($this->UserShopAccount->save($userShopAccount)) {
                $this->Flash->success(__('The user shop account has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user shop account could not be saved. Please, try again.'));
            }
        }
        $users = $this->UserShopAccount->Users->find('list', ['limit' => 200]);
        $shops = $this->UserShopAccount->Shops->find('list', ['limit' => 200]);
        $requestHeaders = $this->UserShopAccount->RequestHeaders->find('list', ['limit' => 200]);
        $this->set(compact('userShopAccount', 'users', 'shops', 'requestHeaders'));
        $this->set('_serialize', ['userShopAccount']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Shop Account id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userShopAccount = $this->UserShopAccount->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userShopAccount = $this->UserShopAccount->patchEntity($userShopAccount, $this->request->data);
            if ($this->UserShopAccount->save($userShopAccount)) {
                $this->Flash->success(__('The user shop account has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user shop account could not be saved. Please, try again.'));
            }
        }
        $users = $this->UserShopAccount->Users->find('list', ['limit' => 200]);
        $shops = $this->UserShopAccount->Shops->find('list', ['limit' => 200]);
        $requestHeaders = $this->UserShopAccount->RequestHeaders->find('list', ['limit' => 200]);
        $this->set(compact('userShopAccount', 'users', 'shops', 'requestHeaders'));
        $this->set('_serialize', ['userShopAccount']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Shop Account id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userShopAccount = $this->UserShopAccount->get($id);
        if ($this->UserShopAccount->delete($userShopAccount)) {
            $this->Flash->success(__('The user shop account has been deleted.'));
        } else {
            $this->Flash->error(__('The user shop account could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

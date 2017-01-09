<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserShopShipTmpl Controller
 *
 * @property \App\Model\Table\UserShopShipTmplTable $UserShopShipTmpl
 */
class UserShopShipTmplController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Shops']
        ];
        $userShopShipTmpl = $this->paginate($this->UserShopShipTmpl);

        $this->set(compact('userShopShipTmpl'));
        $this->set('_serialize', ['userShopShipTmpl']);
    }

    /**
     * View method
     *
     * @param string|null $id User Shop Ship Tmpl id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userShopShipTmpl = $this->UserShopShipTmpl->get($id, [
            'contain' => ['Users', 'Shops']
        ]);

        $this->set('userShopShipTmpl', $userShopShipTmpl);
        $this->set('_serialize', ['userShopShipTmpl']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userShopShipTmpl = $this->UserShopShipTmpl->newEntity();
        if ($this->request->is('post')) {
            $userShopShipTmpl = $this->UserShopShipTmpl->patchEntity($userShopShipTmpl, $this->request->data);
            if ($this->UserShopShipTmpl->save($userShopShipTmpl)) {
                $this->Flash->success(__('The user shop ship tmpl has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user shop ship tmpl could not be saved. Please, try again.'));
            }
        }
        $users = $this->UserShopShipTmpl->Users->find('list', ['limit' => 200]);
        $shops = $this->UserShopShipTmpl->Shops->find('list', ['limit' => 200]);
        $this->set(compact('userShopShipTmpl', 'users', 'shops'));
        $this->set('_serialize', ['userShopShipTmpl']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Shop Ship Tmpl id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userShopShipTmpl = $this->UserShopShipTmpl->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userShopShipTmpl = $this->UserShopShipTmpl->patchEntity($userShopShipTmpl, $this->request->data);
            if ($this->UserShopShipTmpl->save($userShopShipTmpl)) {
                $this->Flash->success(__('The user shop ship tmpl has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user shop ship tmpl could not be saved. Please, try again.'));
            }
        }
        $users = $this->UserShopShipTmpl->Users->find('list', ['limit' => 200]);
        $shops = $this->UserShopShipTmpl->Shops->find('list', ['limit' => 200]);
        $this->set(compact('userShopShipTmpl', 'users', 'shops'));
        $this->set('_serialize', ['userShopShipTmpl']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Shop Ship Tmpl id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userShopShipTmpl = $this->UserShopShipTmpl->get($id);
        if ($this->UserShopShipTmpl->delete($userShopShipTmpl)) {
            $this->Flash->success(__('The user shop ship tmpl has been deleted.'));
        } else {
            $this->Flash->error(__('The user shop ship tmpl could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

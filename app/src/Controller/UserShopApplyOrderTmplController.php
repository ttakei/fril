<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserShopApplyOrderTmpl Controller
 *
 * @property \App\Model\Table\UserShopApplyOrderTmplTable $UserShopApplyOrderTmpl
 */
class UserShopApplyOrderTmplController extends AppController
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
        $userShopApplyOrderTmpl = $this->paginate($this->UserShopApplyOrderTmpl);

        $this->set(compact('userShopApplyOrderTmpl'));
        $this->set('_serialize', ['userShopApplyOrderTmpl']);
    }

    /**
     * View method
     *
     * @param string|null $id User Shop Apply Order Tmpl id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userShopApplyOrderTmpl = $this->UserShopApplyOrderTmpl->get($id, [
            'contain' => ['Users', 'Shops']
        ]);

        $this->set('userShopApplyOrderTmpl', $userShopApplyOrderTmpl);
        $this->set('_serialize', ['userShopApplyOrderTmpl']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userShopApplyOrderTmpl = $this->UserShopApplyOrderTmpl->newEntity();
        if ($this->request->is('post')) {
            $userShopApplyOrderTmpl = $this->UserShopApplyOrderTmpl->patchEntity($userShopApplyOrderTmpl, $this->request->data);
            if ($this->UserShopApplyOrderTmpl->save($userShopApplyOrderTmpl)) {
                $this->Flash->success(__('The user shop apply order tmpl has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user shop apply order tmpl could not be saved. Please, try again.'));
            }
        }
        $users = $this->UserShopApplyOrderTmpl->Users->find('list', ['limit' => 200]);
        $shops = $this->UserShopApplyOrderTmpl->Shops->find('list', ['limit' => 200]);
        $this->set(compact('userShopApplyOrderTmpl', 'users', 'shops'));
        $this->set('_serialize', ['userShopApplyOrderTmpl']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Shop Apply Order Tmpl id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userShopApplyOrderTmpl = $this->UserShopApplyOrderTmpl->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userShopApplyOrderTmpl = $this->UserShopApplyOrderTmpl->patchEntity($userShopApplyOrderTmpl, $this->request->data);
            if ($this->UserShopApplyOrderTmpl->save($userShopApplyOrderTmpl)) {
                $this->Flash->success(__('The user shop apply order tmpl has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user shop apply order tmpl could not be saved. Please, try again.'));
            }
        }
        $users = $this->UserShopApplyOrderTmpl->Users->find('list', ['limit' => 200]);
        $shops = $this->UserShopApplyOrderTmpl->Shops->find('list', ['limit' => 200]);
        $this->set(compact('userShopApplyOrderTmpl', 'users', 'shops'));
        $this->set('_serialize', ['userShopApplyOrderTmpl']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Shop Apply Order Tmpl id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userShopApplyOrderTmpl = $this->UserShopApplyOrderTmpl->get($id);
        if ($this->UserShopApplyOrderTmpl->delete($userShopApplyOrderTmpl)) {
            $this->Flash->success(__('The user shop apply order tmpl has been deleted.'));
        } else {
            $this->Flash->error(__('The user shop apply order tmpl could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

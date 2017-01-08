<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserShopReceiveFeeTmpl Controller
 *
 * @property \App\Model\Table\UserShopReceiveFeeTmplTable $UserShopReceiveFeeTmpl
 */
class UserShopReceiveFeeTmplController extends AppController
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
        $userShopReceiveFeeTmpl = $this->paginate($this->UserShopReceiveFeeTmpl);

        $this->set(compact('userShopReceiveFeeTmpl'));
        $this->set('_serialize', ['userShopReceiveFeeTmpl']);
    }

    /**
     * View method
     *
     * @param string|null $id User Shop Receive Fee Tmpl id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userShopReceiveFeeTmpl = $this->UserShopReceiveFeeTmpl->get($id, [
            'contain' => ['Users', 'Shops']
        ]);

        $this->set('userShopReceiveFeeTmpl', $userShopReceiveFeeTmpl);
        $this->set('_serialize', ['userShopReceiveFeeTmpl']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userShopReceiveFeeTmpl = $this->UserShopReceiveFeeTmpl->newEntity();
        if ($this->request->is('post')) {
            $userShopReceiveFeeTmpl = $this->UserShopReceiveFeeTmpl->patchEntity($userShopReceiveFeeTmpl, $this->request->data);
            if ($this->UserShopReceiveFeeTmpl->save($userShopReceiveFeeTmpl)) {
                $this->Flash->success(__('The user shop receive fee tmpl has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user shop receive fee tmpl could not be saved. Please, try again.'));
            }
        }
        $users = $this->UserShopReceiveFeeTmpl->Users->find('list', ['limit' => 200]);
        $shops = $this->UserShopReceiveFeeTmpl->Shops->find('list', ['limit' => 200]);
        $this->set(compact('userShopReceiveFeeTmpl', 'users', 'shops'));
        $this->set('_serialize', ['userShopReceiveFeeTmpl']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Shop Receive Fee Tmpl id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userShopReceiveFeeTmpl = $this->UserShopReceiveFeeTmpl->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userShopReceiveFeeTmpl = $this->UserShopReceiveFeeTmpl->patchEntity($userShopReceiveFeeTmpl, $this->request->data);
            if ($this->UserShopReceiveFeeTmpl->save($userShopReceiveFeeTmpl)) {
                $this->Flash->success(__('The user shop receive fee tmpl has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user shop receive fee tmpl could not be saved. Please, try again.'));
            }
        }
        $users = $this->UserShopReceiveFeeTmpl->Users->find('list', ['limit' => 200]);
        $shops = $this->UserShopReceiveFeeTmpl->Shops->find('list', ['limit' => 200]);
        $this->set(compact('userShopReceiveFeeTmpl', 'users', 'shops'));
        $this->set('_serialize', ['userShopReceiveFeeTmpl']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Shop Receive Fee Tmpl id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userShopReceiveFeeTmpl = $this->UserShopReceiveFeeTmpl->get($id);
        if ($this->UserShopReceiveFeeTmpl->delete($userShopReceiveFeeTmpl)) {
            $this->Flash->success(__('The user shop receive fee tmpl has been deleted.'));
        } else {
            $this->Flash->error(__('The user shop receive fee tmpl could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

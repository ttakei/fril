<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserShopEvaluateTmpl Controller
 *
 * @property \App\Model\Table\UserShopEvaluateTmplTable $UserShopEvaluateTmpl
 */
class UserShopEvaluateTmplController extends AppController
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
        $userShopEvaluateTmpl = $this->paginate($this->UserShopEvaluateTmpl);

        $this->set(compact('userShopEvaluateTmpl'));
        $this->set('_serialize', ['userShopEvaluateTmpl']);
    }

    /**
     * View method
     *
     * @param string|null $id User Shop Evaluate Tmpl id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userShopEvaluateTmpl = $this->UserShopEvaluateTmpl->get($id, [
            'contain' => ['Users', 'Shops']
        ]);

        $this->set('userShopEvaluateTmpl', $userShopEvaluateTmpl);
        $this->set('_serialize', ['userShopEvaluateTmpl']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userShopEvaluateTmpl = $this->UserShopEvaluateTmpl->newEntity();
        if ($this->request->is('post')) {
            $userShopEvaluateTmpl = $this->UserShopEvaluateTmpl->patchEntity($userShopEvaluateTmpl, $this->request->data);
            if ($this->UserShopEvaluateTmpl->save($userShopEvaluateTmpl)) {
                $this->Flash->success(__('The user shop evaluate tmpl has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user shop evaluate tmpl could not be saved. Please, try again.'));
            }
        }
        $users = $this->UserShopEvaluateTmpl->Users->find('list', ['limit' => 200]);
        $shops = $this->UserShopEvaluateTmpl->Shops->find('list', ['limit' => 200]);
        $this->set(compact('userShopEvaluateTmpl', 'users', 'shops'));
        $this->set('_serialize', ['userShopEvaluateTmpl']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Shop Evaluate Tmpl id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userShopEvaluateTmpl = $this->UserShopEvaluateTmpl->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userShopEvaluateTmpl = $this->UserShopEvaluateTmpl->patchEntity($userShopEvaluateTmpl, $this->request->data);
            if ($this->UserShopEvaluateTmpl->save($userShopEvaluateTmpl)) {
                $this->Flash->success(__('The user shop evaluate tmpl has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user shop evaluate tmpl could not be saved. Please, try again.'));
            }
        }
        $users = $this->UserShopEvaluateTmpl->Users->find('list', ['limit' => 200]);
        $shops = $this->UserShopEvaluateTmpl->Shops->find('list', ['limit' => 200]);
        $this->set(compact('userShopEvaluateTmpl', 'users', 'shops'));
        $this->set('_serialize', ['userShopEvaluateTmpl']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Shop Evaluate Tmpl id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userShopEvaluateTmpl = $this->UserShopEvaluateTmpl->get($id);
        if ($this->UserShopEvaluateTmpl->delete($userShopEvaluateTmpl)) {
            $this->Flash->success(__('The user shop evaluate tmpl has been deleted.'));
        } else {
            $this->Flash->error(__('The user shop evaluate tmpl could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

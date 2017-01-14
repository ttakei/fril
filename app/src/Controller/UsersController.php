<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public $user_editable_key = ['username', 'password'];

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        if (!$this->is_admin) {
            return $this->redirect(['action'=>'edit']);
        }
        $this->paginate = [
            'contain' => ['Groups', 'Licenses']
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('current_user', $this->current_user);
        $this->set('current_user_shop_account', $this->current_user_shop_account);
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if (!empty($id)) {
            if (!$this->is_admin) {
                return $this->redirect(['action'=>'edit']);
            }
            $user = $this->Users->get($id, [
                'contain' => ['UserShopAccounts','Groups']
            ]);
        } else {
            $user = $this->current_user;
        }

        $this->set('current_user', $user);
        $this->set('current_user_shop_account', $this->current_user_shop_account);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if (!$this->is_admin) {
            return $this->redirect(['action'=>'edit']);
        }
        $user = $this->Users->newEntity();
        if ($this->request->is(['post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $groups = $this->Users->Groups->find('list', ['limit' => 200]);
        $licenses = $this->Users->Licenses->find('list', ['limit' => 200]);
        $this->set(compact('user', 'groups', 'licenses'));
        $this->set('current_user', $this->current_user);
        $this->set('current_user_shop_account', $this->current_user_shop_account);
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if (!empty($id)) {
            if (!$this->is_admin) {
                return $this->redirect(['action'=>'edit']);
            }
            $user = $this->Users->get($id);
        } else {
            $user = $this->current_user;
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            if (!$this->is_admin) {
                foreach ($this->request->data as $key => $val) {
                    if (!in_array($key, $this->user_editable_key)) {
                        unset($this->request->data[$key]);
                    }
                }
            }
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success('設定を保存しました。');

                if ($this->is_admin) {
                    return $this->redirect(['action' => 'index']);
                } else {
                    return $this->redirect(['action' => 'edit']);
                }
            } else {
                $this->Flash->error('設定の保存に失敗しました。');
            }
        }

        $groups = $this->Users->Groups->find('list', ['limit' => 200]);
        $licenses = $this->Users->Licenses->find('list', ['limit' => 200]);
        $this->set(compact('user', 'groups', 'licenses'));
        $this->set('is_admin', $this->is_admin);
        $this->set('current_user', $this->current_user);
        $this->set('current_user_shop_account', $this->current_user_shop_account);
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!$this->is_admin) {
            return $this->redirect(['action'=>'edit']);
        }
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['login']);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();

            if ($user) {
                $this->Auth->setUser($user);
                $user_shop_account_id = $this->Cookie->read('usai');
                $user_shop_accounts_tbl = TableRegistry::get('user_shop_accounts');
                if (empty($user_shop_account_id)) {
                    $this->current_user_shop_account = $user_shop_accounts_tbl->find()->where(['user_id'=> $user['id']])->first();
                    $this->Cookie->write('usai', $this->current_user_shop_account->id);
                } else {
                    $this->current_user_shop_account = $user_shop_accounts_tbl->get($user_shop_account_id);
                }
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('ログイン情報が間違っています');
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
}

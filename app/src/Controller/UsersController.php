<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public $me;
    public $is_admin = false;
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
        $this->set('user', $this->me);
        $this->set('user_shop_account',
            $this->get_user_shop_account_current($this->me->user_shop_account));
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
                'contain' => ['UserShopAccount','Groups']
            ]);
        } else {
            $user = $this->me;
        }

        $this->set('user', $user);
        $this->set('user_shop_account',
            $this->get_user_shop_account_current($user->user_shop_account));
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
        $this->set('user', $this->me);
        $this->set('user_shop_account',
            $this->get_user_shop_account_current($this->me->user_shop_account));
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
            $user = $this->Users->get($id, [
                'contain' => ['UserShopAccount','Groups']
            ]);
        } else {
            $user = $this->me;
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
                $this->Flash->success(__('The user has been saved.'));

                if ($this->is_admin) {
                    return $this->redirect(['action' => 'index']);
                } else {
                    return $this->redirect(['action' => 'edit']);
                }
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }

        $groups = $this->Users->Groups->find('list', ['limit' => 200]);
        $licenses = $this->Users->Licenses->find('list', ['limit' => 200]);
        $this->set(compact('user', 'groups', 'licenses'));
        $this->set('is_admin', $this->is_admin);
        $this->set('user_shop_account',
            $this->get_user_shop_account_current($user->user_shop_account));
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
        $request_user = $this->Auth->user();
        if (!empty($request_user['id'])) {
            $this->me = $this->Users->get($request_user['id'], [
                'contain' => ['UserShopAccount','Groups']
            ]);
            $this->is_admin = $this->is_admin($this->me->group);
        }
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();

            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('ログイン情報が間違っています');
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function get_user_shop_account_current($user_shop_accounts) {
        if (!empty($user_shop_accounts)) {
            if (empty($this->request->account)) {
                return $user_shop_accounts[0];
            } else {
                foreach ($user_shop_accounts as $account) {
                    if ($account->id == $this->request->account) {
                        return $account;
                    }
                }
            }
        }
        return null;
    }

    public function is_admin($group) {
        if (!empty($group) && $group->name == 'admin') {
            return true;
        } else {
            return false;
        }
    }
}

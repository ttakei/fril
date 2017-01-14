<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Network\Exception\BadRequestException;

/**
 * UserShopAccounts Controller
 *
 * @property \App\Model\Table\UserShopAccountsTable $UserShopAccounts
 */
class UserShopAccountsController extends AppController
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
        $userShopAccounts = $this->paginate($this->UserShopAccounts);

        $this->set(compact('userShopAccounts'));
        $this->set('_serialize', ['userShopAccounts']);
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
        $userShopAccounts = $this->UserShopAccounts->get($id, [
            'contain' => ['Users', 'Shops', 'RequestHeaders']
        ]);

        $this->set('userShopAccounts', $userShopAccounts);
        $this->set('_serialize', ['userShopAccounts']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userShopAccounts = $this->UserShopAccounts->newEntity();
        if ($this->request->is('post')) {
            $userShopAccounts = $this->UserShopAccounts->patchEntity($userShopAccounts, $this->request->data);
            if ($this->UserShopAccounts->save($userShopAccounts)) {
                $this->Flash->success(__('The user shop account has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user shop account could not be saved. Please, try again.'));
            }
        }
        $users = $this->UserShopAccounts->Users->find('list', ['limit' => 200]);
        $shops = $this->UserShopAccounts->Shops->find('list', ['limit' => 200]);
        $requestHeaders = $this->UserShopAccounts->RequestHeaders->find('list', ['limit' => 200]);
        $this->set(compact('userShopAccounts', 'users', 'shops', 'requestHeaders'));
        $this->set('_serialize', ['userShopAccounts']);
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
        $users_tbl = TableRegistry::get('users');
        if (!empty($id)) {
            if (!$this->is_admin) {
                return $this->redirect(['action'=>'edit']);
            }
            $user = $users_tbl->get($id, 
                ['contain' => ['UserShopAccounts', 'Licenses']]);
        } else {
            $user = $users_tbl->get($this->current_user->id,
                ['contain' => ['UserShopAccounts', 'Licenses']]);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            if (empty($this->request->data['shop_id'])) {
                throw new BadRequestException('入力が不正です');
            }
            $shop_id = $this->request->data['shop_id'][0];
            if (!isset($this->request->data['user_shop_accounts'][$shop_id]) ||
                !isset($this->request->data['user_shop_accounts'][$shop_id]['id']) ||
                !is_array($this->request->data['user_shop_accounts'][$shop_id]['id'])
            ) {
                throw new BadRequestException('入力が不正です');
            }
            $new_arr = $this->request->data['user_shop_accounts'][$shop_id];
            for ($i = 0; $i < count($new_arr['id']); $i++) {
                if (empty($new_arr['shop_username'][$i]) ||
                    empty($new_arr['shop_password'][$i])
                ) {
                    continue;
                }

                $user_shop_account_id = $new_arr['id'][$i];
                $new_shop_username = $new_arr['shop_username'][$i];
                $new_shop_password = $new_arr['shop_password'][$i];
                $user->user_shop_account = array();
                $user_shop_account = null;
                $cookie = null;
                if (!empty($user_shop_account_id)) {
                    foreach ($user->user_shop_accounts as $account) {
                        if ($account->id == $user_shop_account_id) {
                            $user_shop_account = $account;
                            $cookie = $user_shop_account->cookie;
                            break;
                        }
                    }
                }
                if (empty($user_shop_account)) {
                    $user_shop_account = $this->UserShopAccounts->newEntity();
                }
                $shop_nickname = '';
                if (!$this->FrilLogin->login($new_shop_username, $new_shop_password, $cookie, $shop_nickname)) {
                    $this->Flash->error(sprintf('%sのログインに失敗しました', $new_shop_username));
                } else {
                    $user_shop_account = $this->UserShopAccounts->patchEntity(
                        $user_shop_account,
                        [
                            'shop_username' => $new_shop_username,
                            'shop_password' => $new_shop_password,
                            'cookie' => $cookie,
                            'shop_nickname' => $shop_nickname,
                        ]
                    );
                    if (!$this->UserShopAccounts->save($user_shop_account)) {
                        $this->Flash->error(sprintf('%sの保存に失敗しました', $new_shop_username));
                    } else {
                        $this->Flash->success(sprintf('%sを保存しました', $new_shop_username));
                    }
                }
                $user->user_shop_account[] = $user_shop_account;
            }
        }
        $this->set('user', $user);
        $this->set('shop_id', 5);
        $this->set('is_admin', $this->is_admin);
        $this->set('current_user', $this->current_user);
        $this->set('current_user_shop_account', $this->current_user_shop_account);
        $this->set('_serialize');
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
        $userShopAccounts = $this->UserShopAccounts->get($id);
        if ($this->UserShopAccounts->delete($userShopAccounts)) {
            $this->Flash->success(__('The user shop account has been deleted.'));
        } else {
            $this->Flash->error(__('The user shop account could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

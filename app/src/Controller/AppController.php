<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Database\Type;
use Cake\I18n\Time;
use Acl\Controller\Component\AclComponent;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;
use App\Controller\Component\FrilLogin;
use App\Controller\Component\FrilItem;
use App\Controller\Component\Image;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public $current_user;
    public $current_user_shop_account;
    public $is_admin = false;

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        //set locale format date
        Type::build('datetime')->useLocaleParser()->setLocaleFormat('dd-mm-yyyy');
        Time::setToStringFormat('dd/MM/YYYY');
        //acl
        $this->loadComponent('Acl.Acl');
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authorize' => 'Controller',
            'unauthorizedRedirect' => false,
            'loginAction' => [
                'controller' => 'users', 'action' => 'login'
            ],
            'logoutRedirect' => [
                'controller' => 'users', 'action' => 'login'
            ],
            'loginRedirect' => [
                'controller' => 'users', 'action' => 'edit'
            ],
            'authError' => '',
            'authenticate' => [
                'Form' => [
                    'userModel' => 'users',
                    'fields' => ['username' => 'username', 'password' => 'password']
                ]
            ],
            'storage' => 'Session'
        ]);
        $this->loadComponent('Cookie');
        $this->loadComponent('FrilLogin');
        $this->loadComponent('FrilItem');
        $this->loadComponent('Image');
        $this->Cookie->config();
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    public function beforeFilter(Event $event)
    {
        // グループ、ユーザー登録後コメントアウトする
        //$this->Auth->allow();
        $this->Auth->allow(['login']);
        $current_user_arr = $this->Auth->user();
        if (!empty($current_user_arr)) {
            $users_tbl = TableRegistry::get('users');
            $this->current_user = $users_tbl->get($current_user_arr['id']);
            $groups_tbl = TableRegistry::get('groups');
            $group = $groups_tbl->get($this->current_user->group_id);
            $this->is_admin = $this->is_admin($group);
        }

        $user_shop_account_id = $this->Cookie->read('usai');
        if (!empty($user_shop_account_id)) {
            $user_shop_accounts_tbl = TableRegistry::get('user_shop_accounts');
            $this->current_user_shop_account = $user_shop_accounts_tbl->get($user_shop_account_id);
        } elseif (!empty($this->current_user)) {
            $user_shop_accounts_tbl = TableRegistry::get('user_shop_accounts');
            $user_shop_account = $user_shop_accounts_tbl->find()
                ->where(['user_id'=> $this->current_user->id])->first();
            if (!empty($user_shop_account)) {
                $this->Cookie->write('usai', $user_shop_account->id);
                $this->current_user_shop_account = $user_shop_account;
            }
        }
    }

    public function isAuthorized($user)
    {
        $acl = new AclComponent(new ComponentRegistry);
        $return = $acl->check(['Users' => ['id' => $user['id']]], $this->request->controller . '/' . $this->request->action);
        if ($return) {
            //$this->viewBuilder()->layout('admin'); // if you have admin template differ of default
            return true;
        } else {
            return false;
        }
    }

    public function is_admin($group) {
        if (!empty($group) && $group->name == 'admin') {
            return true;
        } else {
            return false;
        }
    }
}

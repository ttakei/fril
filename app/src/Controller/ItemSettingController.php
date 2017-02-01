<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Network\Exception\BadRequestException;

/**
 * ItemSetting Controller
 *
 * @property \App\Model\Table\UserShopAccountsTable $UserShopAccounts
 */
class ItemSettingController extends AppController
{

    public function index()
    {
        return $this->redirect(['action' => 'reexhibit']);
    }

    public function reexhibit($id = null)
    {
        $tbl = TableRegistry::get('user_shop_accounts');
        if (!empty($id)) {
            if (!$this->is_admin) {
                return $this->redirect(['action'=>'reexhibit']);
            }
            $account = $tbl->get($id);
        } else {
            if (empty($this->current_user_shop_account)) {
                return $this->redirect(['controller'=>'Users', 'action'=>'login']);
            }
            $account = $tbl->get($this->current_user_shop_account->id);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            if (empty($data['re_exhibit_type']) ||
                empty($data['re_exhibit_time'])
           ) {
            
                Log::debug(sprintf("bad request at %s(%s)", __FILE__, __LINE__));
                throw new BadRequestException('入力が不正です');
            }

            if ($data['re_exhibit_time'] < 30) {
                $this->Flash->error("再出品間隔は30分以上にしてください");
                return $this->redirect(['action'=>'reexhibit']);
            }

            $account = $tbl->patchEntity(
                $account,
                [
                    're_exhibit_type' => $data['re_exhibit_type'],
                    're_exhibit_time' => $data['re_exhibit_time'],
                ]
            );

            if (!$tbl->save($account)) {
                $this->Flash->error('設定の保存に失敗しました');
                return $this->redirect(['action'=>'reexhibit']);
            }
            $this->Flash->success('保存しました');
        }

        $this->set('account', $account);
        $this->set('is_admin', $this->is_admin);
        $this->set('current_user', $this->current_user);
        $this->set('current_user_shop_account', $this->current_user_shop_account);
    }
}

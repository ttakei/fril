<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property int $group_id
 * @property int $license_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $deleted
 * @property \Cake\I18n\Time $deleted_date
 *
 * @property \App\Model\Entity\Group $group
 * @property \App\Model\Entity\License $license
 * @property \App\Model\Entity\UserShopAccount[] $user_shop_accounts
 * @property \App\Model\Entity\UserShopApplyOrderTmpl[] $user_shop_apply_order_tmpl
 * @property \App\Model\Entity\UserShopEvaluateTmpl[] $user_shop_evaluate_tmpl
 * @property \App\Model\Entity\UserShopReceiveFeeTmpl[] $user_shop_receive_fee_tmpl
 * @property \App\Model\Entity\UserShopRelistCron[] $user_shop_relist_cron
 * @property \App\Model\Entity\UserShopShipTmpl[] $user_shop_ship_tmpl
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }

    public function parentNode()
    {
        if (!$this->id) {
            return null;
        }
        if (isset($this->group_id)) {
            $group_id = $this->group_id;
        } else {
            $users_table = TableRegistry::get('Users');                                     $user = $users_table->find('all', ['fields' => ['group_id']])->where(['id' => $this->id])->first();
            $group_id = $user->group_id;
        }
        if (!$group_id) {
            return null;
        }
    
        return ['Groups' => ['id' => $group_id]];
    }
}

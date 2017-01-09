<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Shop Entity
 *
 * @property int $id
 * @property string $name
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\License[] $licenses
 * @property \App\Model\Entity\UserShopAccount[] $user_shop_account
 * @property \App\Model\Entity\UserShopApplyOrderTmpl[] $user_shop_apply_order_tmpl
 * @property \App\Model\Entity\UserShopEvaluateTmpl[] $user_shop_evaluate_tmpl
 * @property \App\Model\Entity\UserShopReceiveFeeTmpl[] $user_shop_receive_fee_tmpl
 * @property \App\Model\Entity\UserShopRelistCron[] $user_shop_relist_cron
 * @property \App\Model\Entity\UserShopShipTmpl[] $user_shop_ship_tmpl
 */
class Shop extends Entity
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
}

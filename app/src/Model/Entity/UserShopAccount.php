<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserShopAccount Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $shop_id
 * @property string $shop_username
 * @property string $shop_password
 * @property string $cookie
 * @property int $request_header_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $deleted
 * @property \Cake\I18n\Time $deleted_date
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Shop $shop
 * @property \App\Model\Entity\RequestHeader $request_header
 */
class UserShopAccount extends Entity
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

<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Shops Model
 *
 * @property \Cake\ORM\Association\HasMany $Licenses
 * @property \Cake\ORM\Association\HasMany $UserShopAccount
 * @property \Cake\ORM\Association\HasMany $UserShopApplyOrderTmpl
 * @property \Cake\ORM\Association\HasMany $UserShopEvaluateTmpl
 * @property \Cake\ORM\Association\HasMany $UserShopReceiveFeeTmpl
 * @property \Cake\ORM\Association\HasMany $UserShopRelistCron
 * @property \Cake\ORM\Association\HasMany $UserShopShipTmpl
 *
 * @method \App\Model\Entity\Shop get($primaryKey, $options = [])
 * @method \App\Model\Entity\Shop newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Shop[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Shop|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Shop patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Shop[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Shop findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ShopsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('shops');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Licenses', [
            'foreignKey' => 'shop_id'
        ]);
        $this->hasMany('UserShopAccount', [
            'foreignKey' => 'shop_id'
        ]);
        $this->hasMany('UserShopApplyOrderTmpl', [
            'foreignKey' => 'shop_id'
        ]);
        $this->hasMany('UserShopEvaluateTmpl', [
            'foreignKey' => 'shop_id'
        ]);
        $this->hasMany('UserShopReceiveFeeTmpl', [
            'foreignKey' => 'shop_id'
        ]);
        $this->hasMany('UserShopRelistCron', [
            'foreignKey' => 'shop_id'
        ]);
        $this->hasMany('UserShopShipTmpl', [
            'foreignKey' => 'shop_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}

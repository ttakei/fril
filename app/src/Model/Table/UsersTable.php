<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Groups
 * @property \Cake\ORM\Association\BelongsTo $Licenses
 * @property \Cake\ORM\Association\HasMany $UserShopAccounts
 * @property \Cake\ORM\Association\HasMany $UserShopApplyOrderTmpl
 * @property \Cake\ORM\Association\HasMany $UserShopEvaluateTmpl
 * @property \Cake\ORM\Association\HasMany $UserShopReceiveFeeTmpl
 * @property \Cake\ORM\Association\HasMany $UserShopRelistCron
 * @property \Cake\ORM\Association\HasMany $UserShopShipTmpl
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->table('users');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Acl.Acl', ['type' => 'requester']);

        $this->belongsTo('Groups', [
            'foreignKey' => 'group_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Licenses', [
            'foreignKey' => 'license_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('UserShopAccounts', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('UserShopApplyOrderTmpl', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('UserShopEvaluateTmpl', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('UserShopReceiveFeeTmpl', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('UserShopRelistCron', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('UserShopShipTmpl', [
            'foreignKey' => 'user_id'
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
            ->requirePresence('username', 'create')
            ->notEmpty('username')
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->integer('deleted')
            ->allowEmpty('deleted');

        $validator
            ->dateTime('deleted_date')
            ->allowEmpty('deleted_date');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->existsIn(['group_id'], 'Groups'));
        $rules->add($rules->existsIn(['license_id'], 'Licenses'));

        return $rules;
    }
}

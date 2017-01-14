<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RequestHeaders Model
 *
 * @property \Cake\ORM\Association\HasMany $UserShopAccounts
 *
 * @method \App\Model\Entity\RequestHeader get($primaryKey, $options = [])
 * @method \App\Model\Entity\RequestHeader newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RequestHeader[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RequestHeader|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RequestHeader patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RequestHeader[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RequestHeader findOrCreate($search, callable $callback = null, $options = [])
 */
class RequestHeadersTable extends Table
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

        $this->table('request_headers');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('UserShopAccounts', [
            'foreignKey' => 'request_header_id'
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
            ->allowEmpty('useragent');

        return $validator;
    }
}

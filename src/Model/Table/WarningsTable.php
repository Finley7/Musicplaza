<?php
namespace App\Model\Table;

use App\Model\Entity\Warning;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Warnings Model
 *
 */
class WarningsTable extends Table
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

        $this->table('warnings');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Receivers', [
            'className' => 'Users',
            'foreignKey' => 'warned_user',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Authors', [
            'className' => 'Users',
            'foreignKey' => 'warned_by',
            'joinType' => 'INNER'
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
            ->requirePresence('reason', 'create')
            ->notEmpty('reason');

        $validator
            ->integer('percentage')
            ->requirePresence('percentage', 'create')
            ->notEmpty('percentage');

        $validator
            ->dateTime('created_at')
            ->requirePresence('created_at', 'create')
            ->notEmpty('created_at');

        $validator
            ->dateTime('expires')
            ->requirePresence('expires', 'create')
            ->notEmpty('expires');

        $validator
            ->integer('warned_user')
            ->requirePresence('warned_user', 'create')
            ->notEmpty('warned_user');

        $validator
            ->integer('warned_by')
            ->requirePresence('warned_by', 'create')
            ->notEmpty('warned_by');

        return $validator;
    }
}

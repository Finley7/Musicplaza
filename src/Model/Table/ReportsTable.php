<?php
namespace App\Model\Table;

use App\Model\Entity\Report;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Reports Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Threads
 * @property \Cake\ORM\Association\BelongsTo $Comments
 */
class ReportsTable extends Table
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

        $this->addBehavior('Timestamp',
            ['events' => [
                'Model.beforeSave' => [
                    'created_at' => 'new',
                ],
                'Report.handled' => [
                    'updated_at' => 'new'
                ]
            ]]);

        $this->table('reports');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Threads', [
            'foreignKey' => 'thread_id'
        ]);
        $this->belongsTo('Comments', [
            'foreignKey' => 'comment_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('Handler', [
            'className' => 'Users',
            'foreignKey' => 'handled_by',
            'joinType' => 'LEFT'
        ]);

        $this->belongsTo('Reporter', [
            'className' => 'Users',
            'foreignKey' => 'reported_by',
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
        $rules->add($rules->existsIn(['thread_id'], 'Threads'));
        $rules->add($rules->existsIn(['comment_id'], 'Comments'));
        return $rules;
    }
}

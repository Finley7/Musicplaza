<?php
namespace App\Model\Table;

use App\Model\Entity\Thread;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Threads Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Forums
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Subforums
 */
class ThreadsTable extends Table
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
                    'lastpost_date' => 'new',
                    'updated_at' => 'new'
                ],
                'Threads.edited' => [
                    'updated_at' => 'always'
                ],
                'Threads.replied' => [
                    'lastpost_date' => 'always'
                ]
            ]]);

        $this->table('threads');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->belongsTo('Forums', [
            'foreignKey' => 'forum_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'author_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Subforums', [
            'foreignKey' => 'subforum_id'
        ]);
        $this->hasMany('Comments', [
            'foreignKey' => 'thread_id'
        ]);
        $this->belongsTo('Lastposter', [
            'className' => 'Users',
            'foreignKey' => 'lastposter_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Editor', [
            'className' => 'Users',
            'foreignKey' => 'edit_by',
            'joinType' => 'LEFT'
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('body', 'create')
            ->notEmpty('body');


        $validator
            ->dateTime('updated_at')
            ->allowEmpty('updated_at');

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
        $rules->add($rules->existsIn(['forum_id'], 'Forums'));
        $rules->add($rules->existsIn(['author_id'], 'Users'));
        $rules->add($rules->existsIn(['subforum_id'], 'Subforums'));
        return $rules;
    }
}

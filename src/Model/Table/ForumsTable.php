<?php
namespace App\Model\Table;

use App\Model\Entity\Forum;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Forums Model
 *
 */
class ForumsTable extends Table
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
                    'updated_at' => 'new'
                ],
            ]]);

        $this->table('forums');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Sections', [
            'foreignKey' => 'section_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('Subforums', [
            'foreignKey' => 'parent_forum'
        ]);
        $this->hasMany('Threads');
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

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->requirePresence('min_permission', 'create')
            ->notEmpty('min_permission');

        $validator
            ->dateTime('created_at')
            ->allowEmpty('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmpty('updated_at');

        return $validator;
    }
}

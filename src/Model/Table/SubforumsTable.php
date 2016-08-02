<?php
namespace App\Model\Table;

use App\Model\Entity\Subforum;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Subforums Model
 *
 * @property \Cake\ORM\Association\HasMany $Threads
 */
class SubforumsTable extends Table
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

        $this->table('subforums');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->hasMany('Threads', [
            'foreignKey' => 'subforum_id'
        ]);
        $this->belongsTo('Forums', [
            'foreignKey' => 'id'
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
            ->integer('parent_forum')
            ->requirePresence('parent_forum', 'create')
            ->notEmpty('parent_forum');

        $validator
            ->requirePresence('min_permission', 'create')
            ->notEmpty('min_permission');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');


        return $validator;
    }
}

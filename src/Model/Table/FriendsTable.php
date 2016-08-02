<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Friends Model
 *
 * @method \App\Model\Entity\Friend get($primaryKey, $options = [])
 * @method \App\Model\Entity\Friend newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Friend[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Friend|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Friend patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Friend[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Friend findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FriendsTable extends Table
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

        $this->table('friends');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('FriendOne', [
            'className' => 'Users',
            'foreignKey' => 'user_one',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('FriendTwo', [
            'className' => 'Users',
            'foreignKey' => 'user_two',
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
            ->allowEmpty('id', 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->integer('user_one')
            ->requirePresence('user_one', 'create')
            ->notEmpty('user_one');

        $validator
            ->integer('user_two')
            ->allowEmpty('user_two');

        $validator
            ->requirePresence('status', 'create')
            ->notEmpty('status');

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
        $rules->add($rules->isUnique(['id']));

        return $rules;
    }


    /**
     * @param Query $query
     * @param array $options
     * @return Query
     */
    public function findFriends(Query $query, $options = [])
    {
        return $query->find('all')
            ->where(
                [
                    'OR' => [
                        [
                            'user_one' => $options['user_id']
                        ],
                        [
                            'user_two' => $options['user_id']
                        ]
                    ]
                ]
            )->limit(50);
    }
}

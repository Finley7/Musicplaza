<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\HasMany $UserPreferences
 * @property \Cake\ORM\Association\BelongsToMany $Roles
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

        $this->addBehavior('Timestamp',
            ['events' => [
                'Model.beforeSave' => [
                    'created_at' => 'new',
                ]
            ]]);

        $this->table('users');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('UserPreferences', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Warnings', [
            'foreignKey' => 'warned_user'
        ]);
        $this->belongsToMany('Roles', [
                'joinTable' => 'roles_users'
            ]
        );
        $this->hasOne('PrimaryRole', [
            'className' => 'Roles',
            'foreignKey' => 'id',
            'bindingKey' => 'primary_role',
            'propertyName' => 'primary_role'
        ]);
        $this->hasMany('Friends', [
            'foreignKey' => 'user_two'
        ]);
        $this->hasMany('Timeline',
            [
                'foreignKey' => 'user_id',
                'sort' => [
                    'Timeline.created' => 'DESC'
                ]
            ]
        );
        $this->hasMany('TimelineWows', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Notifications', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Threads', [
            'foreignKey' => 'author_id'
        ]);
        $this->hasMany('Comments', [
            'foreignKey' => 'author_id'
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
            ->notEmpty('username')
            ->alphaNumeric('username')
            ->maxLength('username', 15)
            ->minLength('username', 3)
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->email('email')
            ->notEmpty('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->notEmpty('password')
            ->minLength('password', 4)
            ->maxLength('password', 255);

        $validator
            ->add('password_verify', 'matches', [
                'rule' => ['compareWith', 'password'],
                'message' => __('The passwords do not match!')
            ]);

        $validator
            ->notEmpty('last_ip');

        $validator
            ->allowEmpty('avatar');

        $validator
            ->allowEmpty('last_action');

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
        $rules->add($rules->isUnique(['email']));
        return $rules;
    }
}

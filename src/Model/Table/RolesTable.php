<?php
namespace App\Model\Table;

use App\Model\Entity\Role;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Roles Model
 *
 * @property \Cake\ORM\Association\HasMany $RolePermission
 * @property \Cake\ORM\Association\HasMany $UserRole
 */
class RolesTable extends Table
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

        $this->table('roles');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsToMany('UserRole');

        $this->belongsToMany('Permissions');
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
            ->boolean('edit_protect')
            ->requirePresence('edit_protect', 'create')
            ->notEmpty('edit_protect');

        $validator
            ->boolean('delete_protect')
            ->requirePresence('delete_protect', 'create')
            ->notEmpty('delete_protect');

        $validator
            ->allowEmpty('description');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->boolean('banned')
            ->requirePresence('banned', 'create')
            ->notEmpty('banned');

        $validator
            ->integer('post_delay')
            ->requirePresence('post_delay', 'create')
            ->notEmpty('post_delay');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['id'], 'Roles'));
        return $rules;
    }

}

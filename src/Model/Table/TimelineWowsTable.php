<?php
namespace App\Model\Table;

use App\Model\Entity\TimelineWow;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * TimelineWows Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Timeline
 *
 * @method \App\Model\Entity\TimelineWow get($primaryKey, $options = [])
 * @method \App\Model\Entity\TimelineWow newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TimelineWow[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TimelineWow|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TimelineWow patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TimelineWow[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TimelineWow findOrCreate($search, callable $callback = null)
 */
class TimelineWowsTable extends Table
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

        $this->table('timeline_wows');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Timeline', [
            'foreignKey' => 'timeline_id',
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['timeline_id'], 'Timeline'));

        return $rules;
    }

    public function afterSave(Event $event, TimelineWow $entity)
    {
        $notificationRegistry = TableRegistry::get('Notifications');
        $timeline = TableRegistry::get('Timeline')->get($entity->timeline_id, ['contain' => 'Users']);

        $notification = $notificationRegistry->newEntity();

        $notification->user_id = $timeline->user_id;
        $notification->message = __("Je bericht is geWOW'd!");
        $notification->url = '/timeline/view/' . $timeline->id;

        $notificationRegistry->save($notification);
    }
}

<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * Forums Entity.
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $min_role
 * @property \Cake\I18n\Time $created_at
 * @property \Cake\I18n\Time $updated_at
 */
class Forum extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

    public function getLatestThreads($id) {

        $threadsRegistry = TableRegistry::get('Threads');

        $forum_threads = $threadsRegistry
            ->findBySubforumId($id)
            ->contain(['Lastposter' => ['PrimaryRole']])
            ->sortBy('lastpost_date')
            ->first();
        return $forum_threads;
    }

}

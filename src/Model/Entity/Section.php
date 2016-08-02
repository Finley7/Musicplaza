<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * Section Entity.
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $min_role
 * @property \App\Model\Entity\Forum[] $forums
 */
class Section extends Entity
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
            ->findByForumId($id)
            ->contain(['Lastposter' => ['PrimaryRole']])
            ->sortBy('lastpost_date')
            ->first();
        return $forum_threads;
    }
}

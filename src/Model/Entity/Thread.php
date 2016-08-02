<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Thread Entity.
 *
 * @property int $id
 * @property int $forum_id
 * @property \App\Model\Entity\Forum $forum
 * @property int $author_id
 * @property \App\Model\Entity\User $user
 * @property int $subforum_id
 * @property \App\Model\Entity\Subforum $subforum
 * @property string $title
 * @property string $body
 * @property \Cake\I18n\Time $created_at
 * @property \Cake\I18n\Time $updated_at
 */
class Thread extends Entity
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
}

<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Subforum Entity.
 *
 * @property int $id
 * @property int $parent_forum
 * @property int $min_role
 * @property string $title
 * @property string $description
 * @property \Cake\I18n\Time $created_at
 * @property \Cake\I18n\Time $updated_at
 * @property \App\Model\Entity\Thread[] $threads
 */
class Subforum extends Entity
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

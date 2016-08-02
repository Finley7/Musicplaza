<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Warning Entity.
 *
 * @property int $id
 * @property string $reason
 * @property int $percentage
 * @property \Cake\I18n\Time $created_at
 * @property \Cake\I18n\Time $expires
 * @property int $warned_user
 * @property int $warned_by
 */
class Warning extends Entity
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

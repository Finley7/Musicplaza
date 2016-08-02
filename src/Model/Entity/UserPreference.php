<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserPreference Entity.
 *
 * @property int $id
 * @property bool $show_email
 * @property \Cake\I18n\Time $dob
 * @property bool $receive_pms
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 */
class UserPreference extends Entity
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
        'user_id' => false,
    ];
}

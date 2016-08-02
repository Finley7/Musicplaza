<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\Query;

/**
 * Friend Entity
 *
 * @property int $id
 * @property int $user_one
 * @property int $user_two
 * @property int $created
 * @property string $status
 */
class Friend extends Entity
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
        'id' => false
    ];

}

<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Role Entity.
 *
 * @property int $id
 * @property string $name
 * @property bool $edit_protect
 * @property bool $delete_protect
 * @property string $description
 * @property string $title
 * @property bool $banned
 * @property int $post_delay
 * @property \App\Model\Entity\RolePermission[] $role_permission
 * @property \App\Model\Entity\UserRole[] $user_role
 */
class Role extends Entity
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

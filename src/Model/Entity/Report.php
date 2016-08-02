<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Report Entity.
 *
 * @property int $id
 * @property string $reason
 * @property bool $handled
 * @property int $handled_by
 * @property int $thread_id
 * @property \App\Model\Entity\Thread $thread
 * @property int $comment_id
 * @property \App\Model\Entity\Comment $comment
 * @property \Cake\I18n\Time $created_at
 * @property \Cake\I18n\Time $updated_at
 */
class Report extends Entity
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

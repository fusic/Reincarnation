<?php
namespace Reincarnation\Test\App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Address Entity.
 *
 * @property int $id
 * @property string $name
 * @property int $member_id
 * @property \Reincarnation\Model\Entity\Member $member
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Address extends Entity
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
    protected array $_accessible = [
        '*' => true,
        'id' => false,
    ];
}

<?php
namespace Reincarnation\Test\App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Member Entity.
 *
 * @property int $id
 * @property string $name
 * @property int $blood_type_id
 * @property \Reincarnation\Model\Entity\BloodType $blood_type
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \Reincarnation\Model\Entity\Address[] $addresses
 * @property \Reincarnation\Model\Entity\Tel[] $tels
 * @property \Reincarnation\Model\Entity\Hobby[] $hobbies
 */
class Member extends Entity
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

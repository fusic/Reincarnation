<?php
namespace Reincarnation\Test\App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User01 Entity.
 */
class User01 extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'delete_flg' => true,
        'deleted' => true,
    ];

}

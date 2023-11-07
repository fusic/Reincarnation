<?php
namespace Reincarnation\Test\App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Account Entity.
 */
class Account extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected array $_accessible = [
        'name' => true,
        'deleted' => true,
        'deleted_date' => true,
    ];
}

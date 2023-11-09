<?php
declare(strict_types=1);

namespace Reincarnation\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * HobbiesMembersFixture
 * habtm
 */
class HobbiesMembersFixture extends TestFixture
{
    /**
     * Records
     *
     * @var array
     */
    public array $records = [
        [
            'id' => 1,
            'hobby_id' => 1,
            'member_id' => 1,
            'deleted' => false,
            'deleted_date' => null,
            'created' => 1455621347,
            'modified' => 1455621347,
        ],
        [
            'id' => 2,
            'hobby_id' => 2,
            'member_id' => 1,
            'deleted' => false,
            'deleted_date' => null,
            'created' => 1455621347,
            'modified' => 1455621347,
        ],
        [
            'id' => 3,
            'hobby_id' => 2,
            'member_id' => 3,
            'deleted' => false,
            'deleted_date' => null,
            'created' => 1455621347,
            'modified' => 1455621347,
        ],
    ];
}

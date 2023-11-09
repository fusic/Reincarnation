<?php
declare(strict_types=1);

namespace Reincarnation\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * HobbiesFixture
 * habtm
 */
class HobbiesFixture extends TestFixture
{
    /**
     * Records
     *
     * @var array
     */
    public array $records = [
        [
            'id' => 1,
            'name' => 'baseball',
            'deleted' => false,
            'deleted_date' => null,
            'created' => 1455621611,
            'modified' => 1455621611,
        ],
        [
            'id' => 2,
            'name' => 'soccer',
            'deleted' => false,
            'deleted_date' => null,
            'created' => 1455621611,
            'modified' => 1455621611,
        ],
        [
            'id' => 3,
            'name' => 'tennis',
            'deleted' => false,
            'deleted_date' => null,
            'created' => 1455621611,
            'modified' => 1455621611,
        ],
    ];
}

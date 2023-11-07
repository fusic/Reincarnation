<?php
namespace Reincarnation\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TelsFixture
 * hasmany
 */
class TelsFixture extends TestFixture
{
    /**
     * Records
     *
     * @var array
     */
    public array $records = [
        [
            'id' => 1,
            'tel' => '092-000-1111',
            'member_id' => 1,
            'deleted' => false,
            'deleted_date' => null,
            'created' => 1455621359,
            'modified' => 1455621359
        ],
        [
            'id' => 2,
            'tel' => '090-1111-2222',
            'member_id' => 1,
            'deleted' => false,
            'deleted_date' => null,
            'created' => 1455621359,
            'modified' => 1455621359
        ],
        [
            'id' => 3,
            'tel' => '092-001-1111',
            'member_id' => 2,
            'deleted' => false,
            'deleted_date' => null,
            'created' => 1455621359,
            'modified' => 1455621359
        ],
    ];
}

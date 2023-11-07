<?php
namespace Reincarnation\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AddressesFixture
 * hasone用
 */
class AddressesFixture extends TestFixture
{
    /**
     * Records
     *
     * @var array
     */
    public array $records = [
        [
            'id' => 1,
            'name' => 'fukuoka tenjin',
            'member_id' => 1,
            'deleted' => false,
            'deleted_date' => null,
            'created' => 1455621317,
            'modified' => 1455621317
        ],
        [
            'id' => 2,
            'name' => 'tokyo chiyoda',
            'member_id' => 2,
            'deleted' => false,
            'deleted_date' => null,
            'created' => 1455621317,
            'modified' => 1455621317
        ],
        [
            'id' => 3,
            'name' => 'osaka namba',
            'member_id' => 3,
            'deleted' => false,
            'deleted_date' => null,
            'created' => 1455621317,
            'modified' => 1455621317
        ],
    ];
}

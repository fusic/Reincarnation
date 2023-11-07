<?php
namespace Reincarnation\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * HobbiesMembersFixture
 * habtm
 */
class HobbiesMembersFixture extends TestFixture
{
    // /**
    //  * Fields
    //  *
    //  * @var array
    //  */
    // // @codingStandardsIgnoreStart
    // public $fields = [
    //     'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
    //     'hobby_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
    //     'member_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
    //     'deleted' => ['type' => 'boolean', 'length' => null, 'default' => 0, 'null' => false, 'comment' => 'deleted', 'precision' => null],
    //     'deleted_date' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => 'deleted_date', 'precision' => null],
    //     'created' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => 'created', 'precision' => null],
    //     'modified' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => 'modified', 'precision' => null],
    //     '_constraints' => [
    //         'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
    //     ],
    // ];
    // // @codingStandardsIgnoreEnd

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
            'modified' => 1455621347
        ],
        [
            'id' => 2,
            'hobby_id' => 2,
            'member_id' => 1,
            'deleted' => false,
            'deleted_date' => null,
            'created' => 1455621347,
            'modified' => 1455621347
        ],
        [
            'id' => 3,
            'hobby_id' => 2,
            'member_id' => 3,
            'deleted' => false,
            'deleted_date' => null,
            'created' => 1455621347,
            'modified' => 1455621347
        ],
    ];
}

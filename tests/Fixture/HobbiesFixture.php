<?php
namespace Reincarnation\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * HobbiesFixture
 * habtm
 */
class HobbiesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'name' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'fixed' => null],
        'deleted' => ['type' => 'boolean', 'length' => null, 'default' => 0, 'null' => false, 'comment' => 'deleted', 'precision' => null],
        'deleted_date' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => 'deleted_date', 'precision' => null],
        'created' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'modified' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'name' => 'baseball',
            'deleted' => false,
            'deleted_date' => null,
            'created' => 1455621611,
            'modified' => 1455621611
        ],
        [
            'id' => 2,
            'name' => 'soccer',
            'deleted' => false,
            'deleted_date' => null,
            'created' => 1455621611,
            'modified' => 1455621611
        ],
        [
            'id' => 3,
            'name' => 'tennis',
            'deleted' => false,
            'deleted_date' => null,
            'created' => 1455621611,
            'modified' => 1455621611
        ],
    ];
}

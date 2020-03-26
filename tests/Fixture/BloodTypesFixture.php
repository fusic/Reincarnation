<?php
namespace Reincarnation\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BloodTypesFixture
 * belongsto
 */
class BloodTypesFixture extends TestFixture
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
        'created' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => 'created', 'precision' => null],
        'modified' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => 'modified', 'precision' => null],
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
            'name' => 'A',
            'deleted' => false,
            'deleted_date' => null,
            'created' => 1455621327,
            'modified' => 1455621327
        ],
        [
            'id' => 2,
            'name' => 'B',
            'deleted' => false,
            'deleted_date' => null,
            'created' => 1455621327,
            'modified' => 1455621327
        ],
        [
            'id' => 3,
            'name' => 'O',
            'deleted' => false,
            'deleted_date' => null,
            'created' => 1455621327,
            'modified' => 1455621327
        ],
        [
            'id' => 4,
            'name' => 'AB',
            'deleted' => false,
            'deleted_date' => null,
            'created' => 1455621327,
            'modified' => 1455621327
        ],
    ];
}

<?php
namespace Reincarnation\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * User04sFixture
 *
 */
class User04sFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => 'id', 'precision' => null, 'unsigned' => null],
        'name' => ['type' => 'text', 'length' => null, 'default' => null, 'null' => true, 'comment' => 'name', 'precision' => null],
        // 'delete_flg' => ['type' => 'boolean', 'length' => null, 'default' => 0, 'null' => false, 'comment' => 'delete_flg', 'precision' => null],
        'deleted' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => 'deleted', 'precision' => null],
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
            'name' => 'test',
            // 'delete_flg' => false,
            'deleted' => null,
            'created' => 1430991176,
            'modified' => 1430991176
        ],
        [
            'name' => 'test2',
            // 'delete_flg' => true,
            'deleted' => 1430991176,
            'created' => 1430991176,
            'modified' => 1430991176
        ],
    ];
}

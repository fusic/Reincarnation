<?php
namespace Reincarnation\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MembersFixture
 * relationのベース
 */
class MembersFixture extends TestFixture
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
        'blood_type_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
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
            'name' => 'satoru hagiwara',
            'blood_type_id' => 1,
            'deleted' => false,
            'deleted_date' => null,
            'created' => 1455621354,
            'modified' => 1455621354
        ],
        [
            'id' => 2,
            'name' => 'tato yamada',
            'blood_type_id' => 2,
            'deleted' => false,
            'deleted_date' => null,
            'created' => 1455621354,
            'modified' => 1455621354
        ],
        [
            'id' => 3,
            'name' => 'jiro tanaka',
            'blood_type_id' => 3,
            'deleted' => false,
            'deleted_date' => null,
            'created' => 1455621354,
            'modified' => 1455621354
        ],
    ];
}

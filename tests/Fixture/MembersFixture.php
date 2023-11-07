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
     * Records
     *
     * @var array
     */
    public array $records = [
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

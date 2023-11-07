<?php
namespace Reincarnation\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * User01sFixture
 *
 */
class User01sFixture extends TestFixture
{
    /**
     * Records
     *
     * @var array
     */
    public array $records = [
        [
            'name' => 'test',
            'delete_flg' => false,
            'deleted' => null,
            'created' => 1430991176,
            'modified' => 1430991176
        ],
        [
            'name' => 'test2',
            'delete_flg' => true,
            'deleted' => null,
            'created' => 1430991176,
            'modified' => 1430991176
        ],
    ];
}

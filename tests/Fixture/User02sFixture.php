<?php
declare(strict_types=1);

namespace Reincarnation\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * User02sFixture
 */
class User02sFixture extends TestFixture
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
            // 'deleted' => null,
            'created' => 1430991176,
            'modified' => 1430991176,
        ],
        [
            'name' => 'test2',
            'delete_flg' => true,
            // 'deleted' => null,
            'created' => 1430991176,
            'modified' => 1430991176,
        ],
    ];
}

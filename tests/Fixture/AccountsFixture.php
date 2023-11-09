<?php
declare(strict_types=1);

namespace Reincarnation\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AccountsFixture
 */
class AccountsFixture extends TestFixture
{
    /**
     * Records
     *
     * @var array
     */
    public array $records = [
        [
            'name' => 'test',
            'deleted' => false,
            'deleted_date' => null,
            'created' => 1430991176,
            'modified' => 1430991176,
        ],
        [
            'name' => 'test2',
            'deleted' => true,
            'deleted_date' => null,
            'created' => 1430991176,
            'modified' => 1430991176,
        ],
    ];
}

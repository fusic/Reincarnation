<?php
declare(strict_types=1);

namespace Reincarnation\Test\App\Model\Table;

use Cake\ORM\Table;

/**
 * App Model
 */
class AppTable extends Table
{
    public static function defaultConnectionName(): string
    {
        return 'test';
    }
}

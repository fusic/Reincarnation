<?php
declare(strict_types=1);

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Database\Connection;
use Cake\Datasource\ConnectionManager;
use Cake\Utility\Filesystem;
use Migrations\TestSuite\Migrator;
use function Cake\Core\env;

function find_root()
{
    $root = dirname(__DIR__);
    if (is_dir($root . '/vendor/cakephp/cakephp')) {
        return $root;
    }

    $root = dirname(dirname(__DIR__));
    if (is_dir($root . '/vendor/cakephp/cakephp')) {
        return $root;
    }

    $root = dirname(dirname(dirname(__DIR__)));
    if (is_dir($root . '/vendor/cakephp/cakephp')) {
        return $root;
    }
}

function find_app()
{
    if (is_dir(ROOT . '/App')) {
        return 'App';
    }

    if (is_dir(ROOT . '/vendor/cakephp/app/App')) {
        return 'vendor/cakephp/app/App';
    }
}

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
define('ROOT', find_root());
define('APP_DIR', find_app());
define('WEBROOT_DIR', 'webroot');
define('CONFIG', ROOT . DS . 'config' . DS);
define('APP', ROOT . DS . APP_DIR . DS);
define('WWW_ROOT', ROOT . DS . WEBROOT_DIR . DS);
define('TESTS', ROOT . DS . 'Test' . DS);
define('TMP', ROOT . DS . 'tmp' . DS);
define('LOGS', TMP . 'logs' . DS);
define('CACHE', TMP . 'cache' . DS);
define('CAKE_CORE_INCLUDE_PATH', ROOT . '/vendor/cakephp/cakephp');
define('CORE_PATH', CAKE_CORE_INCLUDE_PATH . DS);
define('CAKE', CORE_PATH . 'src' . DS);

require ROOT . '/vendor/autoload.php';
require CORE_PATH . 'config/bootstrap.php';
require CAKE . 'functions.php';

$dotenv = new \josegonzalez\Dotenv\Loader([CONFIG . '.env']);
$dotenv->parse()
    ->putenv()
    ->toEnv()
    ->toServer();

Configure::write('App', ['namespace' => 'App']);
Configure::write('debug', 2);

$tmp = new Filesystem();
$tmp->mkdir(TMP . 'cache/models', 0777);
$tmp->mkdir(TMP . 'cache/persistent', 0777);
$tmp->mkdir(TMP . 'cache/views', 0777);

$cache = [
    'default' => [
        'engine' => 'File',
        'path' => CACHE,
    ],
    '_cake_core_' => [
        'className' => 'File',
        'prefix' => 'search_myapp_cake_core_',
        'path' => CACHE . 'persistent/',
        'serialize' => true,
        'duration' => '+10 seconds',
    ],
    '_cake_model_' => [
        'className' => 'File',
        'prefix' => 'search_my_app_cake_model_',
        'path' => CACHE . 'models/',
        'serialize' => 'File',
        'duration' => '+10 seconds',
    ],
];
Cache::setConfig($cache);

ConnectionManager::setConfig('test', [
    'className' => Connection::class,
    'driver' => '\\Cake\\Database\\Driver\\' . env('TEST_DRIVIER'),
    'host' => env('TEST_HOST'),
    'database' => env('TEST_DB_NAME'),
    'username' => env('TEST_USER_NAME'),
    'password' => env('TEST_USER_PW'),
    'timezone' => 'UTC',
]);

(new Migrator())->run();

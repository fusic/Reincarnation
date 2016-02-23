<?php
namespace Reincarnation\Test\TestCase\Model\Table;

use Reincarnation\Test\App\Model\Table\UsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Datasource\ConnectionManager;
use Cake\TestSuite\Fixture\FixtureManager;

/**
 * App\Model\Table\UsersTable Test Case
 */
class UsersTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.reincarnation.users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->connection = ConnectionManager::get('test');
        $this->Users = new UsersTable([
            'alias' => 'Users',
            'table' => 'users',
            'connection' => $this->connection
        ]);

        //fixtureManagerを呼び出し、fixtureを実行する
        $this->fixtureManager = new FixtureManager();
        $this->fixtureManager->fixturize($this);
        $this->fixtureManager->loadSingle('Users');

    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Users);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function test_find()
    {
        //ID1はfind可能
        $user_info = $this->Users->find('all')
            ->where(['Users.id' => 1])
            ->first();
        $this->assertTrue(!empty($user_info));

        //ID2はfind不可
        $user_info = $this->Users->find('all')
            ->where(['Users.id' => 2])
            ->first();
        $this->assertFalse(!empty($user_info));

        //削除済みのデータをfindする
        $user_info = $this->Users->find('all',['enableSoftDelete' => false])
            ->where(['Users.id' => 1])
            ->first();
        $this->assertTrue(!empty($user_info));
    }


    /**
     * Test initialize method
     *
     * @return void
     */
    public function test_save_delete()
    {
        //データ保存後、findでデータを閲覧可能
        $data = [
            'name' => 'hoge',
        ];
        $entity = $this->Users->newEntity($data);
        $save_result = $this->Users->save($entity);
        $this->assertTrue((bool) $save_result);

        $last_id = $save_result->id;
        $user_info = $this->Users->find('all')
            ->where(['Users.id' => $last_id])
            ->first();
        $this->assertTrue(!empty($user_info));

        //削除する
        $this->assertTrue($this->Users->softDelete($user_info));

        //削除したデータは見つからない
        $user_info = $this->Users->find('all')
            ->where(['Users.id' => $last_id])
            ->first();
        $this->assertFalse(!empty($user_info));
    }


}

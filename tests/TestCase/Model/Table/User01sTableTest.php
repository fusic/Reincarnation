<?php
namespace Reincarnation\Test\TestCase\Model\Table;

use Reincarnation\Test\App\Model\Table\User01sTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Datasource\ConnectionManager;
use Cake\TestSuite\Fixture\FixtureManager;

/**
 * App\Model\Table\User01sTable Test Case
 */
class User01sTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.reincarnation.user01s',
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
        $this->User01s = new User01sTable([
            'alias' => 'User01s',
            'table' => 'user01s',
            'connection' => $this->connection
        ]);

        //fixtureManagerを呼び出し、fixtureを実行する
        $this->fixtureManager = new FixtureManager();
        $this->fixtureManager->fixturize($this);
        $this->fixtureManager->loadSingle('User01s');

    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->User01s);

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
        $user_info = $this->User01s->find('all')
            ->where(['User01s.id' => 1])
            ->first();
        $this->assertTrue(!empty($user_info));

        //ID2はfind不可
        $user_info = $this->User01s->find('all')
            ->where(['User01s.id' => 2])
            ->first();
        $this->assertFalse(!empty($user_info));

        //削除済みのデータをfindする
        $user_info = $this->User01s->find('all',['enableSoftDelete' => false])
            ->where(['User01s.id' => 2])
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
        $entity = $this->User01s->newEntity($data);
        $save_result = $this->User01s->save($entity);
        $this->assertTrue((bool) $save_result);

        $last_id = $save_result->id;
        $user_info = $this->User01s->find('all')
            ->where(['User01s.id' => $last_id])
            ->first();
        $this->assertTrue(!empty($user_info));

        //削除する
        $this->assertTrue($this->User01s->softDelete($user_info));

        //削除したデータは見つからない
        $user_info = $this->User01s->find('all')
            ->where(['User01s.id' => $last_id])
            ->first();
        $this->assertFalse(!empty($user_info));
    }


}

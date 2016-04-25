<?php
namespace Reincarnation\Test\TestCase\Model\Table;

use Reincarnation\Test\App\Model\Table\User02sTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Datasource\ConnectionManager;
use Cake\TestSuite\Fixture\FixtureManager;

/**
 * App\Model\Table\User02sTable Test Case
 */
class User02sTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.reincarnation.user02s',
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
        $this->User02s = new User02sTable([
            'alias' => 'User02s',
            'table' => 'user02s',
            'connection' => $this->connection
        ]);

        //fixtureManagerを呼び出し、fixtureを実行する
        $this->fixtureManager = new FixtureManager();
        $this->fixtureManager->fixturize($this);
        $this->fixtureManager->loadSingle('User02s');

    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->User02s);

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
        $user_info = $this->User02s->find('all')
            ->where(['User02s.id' => 1])
            ->first();
        $this->assertTrue(!empty($user_info));

        //ID2はfind不可
        $user_info = $this->User02s->find('all')
            ->where(['User02s.id' => 2])
            ->first();
        $this->assertFalse(!empty($user_info));

        //削除済みのデータをfindする
        $user_info = $this->User02s->find('all',['enableSoftDelete' => false])
            ->where(['User02s.id' => 2])
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
        $entity = $this->User02s->newEntity($data);
        $save_result = $this->User02s->save($entity);
        $this->assertTrue((bool) $save_result);

        $last_id = $save_result->id;
        $user_info = $this->User02s->find('all')
            ->where(['User02s.id' => $last_id])
            ->first();
        $this->assertTrue(!empty($user_info));

        //削除する
        $this->assertTrue($this->User02s->softDelete($user_info));

        //削除したデータは見つからない
        $user_info = $this->User02s->find('all')
            ->where(['User02s.id' => $last_id])
            ->first();
        $this->assertFalse(!empty($user_info));
        
        //削除済みのデータをfindする
        $delete_info = $this->User02s->find('all',['enableSoftDelete' => false])
            ->where(['User02s.id' => $last_id])
            ->first();
        //削除データが問題なく入っているかの確認
        $this->assertTrue($delete_info->delete_flg);
    }


}

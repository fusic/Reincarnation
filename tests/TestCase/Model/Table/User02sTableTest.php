<?php

namespace Reincarnation\Test\TestCase\Model\Table;

use Reincarnation\Test\App\Model\Table\User02sTable;
use Cake\TestSuite\TestCase;
use Cake\Datasource\ConnectionManager;

/**
 * App\Model\Table\User02sTable Test Case
 */
class User02sTableTest extends TestCase
{
    protected $connection;
    protected $user02s;

    /**
     * @return array
     */
    public function getFixtures(): array
    {
        return [
            'plugin.Reincarnation.User02s',
        ];
    }

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->connection = ConnectionManager::get('test');
        $this->user02s = new User02sTable([
            'alias' => 'User02s',
            'table' => 'user02s',
            'connection' => $this->connection
        ]);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->connection);
        unset($this->user02s);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function test_find(): void
    {
        //ID1はfind可能
        $userInfo = $this->user02s->find('all')
            ->where(['User02s.id' => 1])
            ->first();
        $this->assertTrue(!empty($userInfo));

        //ID2はfind不可
        $userInfo = $this->user02s->find('all')
            ->where(['User02s.id' => 2])
            ->first();
        $this->assertFalse(!empty($userInfo));

        //削除済みのデータをfindする
        $userInfo = $this->user02s->find('all', enableSoftDelete: false)
            ->where(['User02s.id' => 2])
            ->first();
        $this->assertTrue(!empty($userInfo));
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function test_save_delete(): void
    {
        //データ保存後、findでデータを閲覧可能
        $data = [
            'name' => 'hoge',
        ];
        $entity = $this->user02s->newEntity($data);
        $saveResult = $this->user02s->save($entity);
        $this->assertTrue((bool) $saveResult);

        $last_id = $saveResult->id;
        $userInfo = $this->user02s->find('all')
            ->where(['User02s.id' => $last_id])
            ->first();
        $this->assertTrue(!empty($userInfo));

        //削除する
        $this->assertTrue($this->user02s->softDelete($userInfo));

        //削除したデータは見つからない
        $userInfo = $this->user02s->find('all')
            ->where(['User02s.id' => $last_id])
            ->first();
        $this->assertFalse(!empty($userInfo));

        //削除済みのデータをfindする
        $delete_info = $this->user02s->find('all', enableSoftDelete: false)
            ->where(['User02s.id' => $last_id])
            ->first();
        //削除データが問題なく入っているかの確認
        $this->assertTrue($delete_info->delete_flg);
    }
}

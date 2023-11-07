<?php

namespace Reincarnation\Test\TestCase\Model\Table;

use Reincarnation\Test\App\Model\Table\User01sTable;
use Cake\TestSuite\TestCase;
use Cake\Datasource\ConnectionManager;

/**
 * App\Model\Table\User01sTable Test Case
 */
class User01sTableTest extends TestCase
{
    protected $connection;
    protected $user01s;

    /**
     * @return array
     */
    public function getFixtures(): array
    {
        return [
            'plugin.Reincarnation.User01s',
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
        $this->user01s = new User01sTable([
            'alias' => 'User01s',
            'table' => 'user01s',
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
        unset($this->user01s);

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
        $userInfo = $this->user01s->find('all')
            ->where(['User01s.id' => 1])
            ->first();
        $this->assertTrue(!empty($userInfo));

        //ID2はfind不可
        $userInfo = $this->user01s->find('all')
            ->where(['User01s.id' => 2])
            ->first();
        $this->assertFalse(!empty($userInfo));

        //削除済みのデータをfindする
        $userInfo = $this->user01s->find('all', enableSoftDelete: false)
            ->where(['User01s.id' => 2])
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
        $entity = $this->user01s->newEntity($data);
        $saveResult = $this->user01s->save($entity);
        $this->assertTrue((bool) $saveResult);

        $lastId = $saveResult->id;
        $userInfo = $this->user01s->find('all')
            ->where(['User01s.id' => $lastId])
            ->first();
        $this->assertTrue(!empty($userInfo));

        //削除する
        $this->assertTrue($this->user01s->softDelete($userInfo));

        //削除したデータは見つからない
        $userInfo = $this->user01s->find('all')
            ->where(['User01s.id' => $lastId])
            ->first();
        $this->assertFalse(!empty($userInfo));

        //削除済みのデータをfindする
        $deleteInfo = $this->user01s->find('all', enableSoftDelete: false)
            ->where(['User01s.id' => $lastId])
            ->first();
        //削除データが問題なく入っているかの確認
        $this->assertTrue($deleteInfo->delete_flg);
        $this->assertTrue(!empty($deleteInfo->deleted));
    }
}

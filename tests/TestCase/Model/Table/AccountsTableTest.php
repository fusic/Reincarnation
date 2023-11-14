<?php
declare(strict_types=1);

namespace Reincarnation\Test\TestCase\Model\Table;

use Cake\Datasource\ConnectionManager;
use Cake\TestSuite\TestCase;
use Reincarnation\Test\App\Model\Table\AccountsTable;

/**
 * App\Model\Table\AccountsTable Test Case
 */
class AccountsTableTest extends TestCase
{
    protected $connection;
    protected $accounts;

    /**
     * @return array
     */
    public function getFixtures(): array
    {
        return [
            'plugin.Reincarnation.Accounts',
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
        $this->accounts = new AccountsTable([
            'alias' => 'Accounts',
            'table' => 'accounts',
            'connection' => $this->connection,
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
        unset($this->accounts);

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
        $accountInfo = $this->accounts->find('all')
            ->where(['Accounts.id' => 1])
            ->first();
        $this->assertTrue(!empty($accountInfo));

        // ID2はfind不可
        $accountInfo = $this->accounts->find('all')
            ->where(['Accounts.id' => 2])
            ->first();
        $this->assertFalse(!empty($accountInfo));

        //削除済みのデータをfindする
        $accountInfo = $this->accounts->find('all', enableSoftDelete: false)
            ->where(['Accounts.id' => 2])
            ->first();
        $this->assertTrue(!empty($accountInfo));
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
        $entity = $this->accounts->newEntity($data);
        $saveResult = $this->accounts->save($entity);
        $this->assertTrue((bool)$saveResult);

        $lastId = $saveResult->id;
        $accountInfo = $this->accounts->find('all')
            ->where(['Accounts.id' => $lastId])
            ->first();
        $this->assertTrue(!empty($accountInfo));

        //削除する
        $this->assertTrue($this->accounts->softDelete($accountInfo));

        //削除したデータは見つからない
        $accountInfo = $this->accounts->find('all')
            ->where(['Accounts.id' => $lastId])
            ->first();
        $this->assertFalse(!empty($accountInfo));

        //削除済みのデータをfindする
        $deleteInfo = $this->accounts->find('all', enableSoftDelete: false)
            ->where(['Accounts.id' => $lastId])
            ->first();
        //削除データが問題なく入っているかの確認
        $this->assertTrue($deleteInfo->deleted);
        $this->assertTrue(!empty($deleteInfo->deleted_date));
    }
}

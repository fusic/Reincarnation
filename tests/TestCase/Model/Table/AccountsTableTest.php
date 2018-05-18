<?php
namespace Reincarnation\Test\TestCase\Model\Table;

use Reincarnation\Test\App\Model\Table\AccountsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Datasource\ConnectionManager;
use Cake\TestSuite\Fixture\FixtureManager;

/**
 * App\Model\Table\AccountsTable Test Case
 */
class AccountsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.reincarnation.accounts',
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
        $this->Accounts = new AccountsTable([
            'alias' => 'Accounts',
            'table' => 'accounts',
            'connection' => $this->connection
        ]);

        //fixtureManagerを呼び出し、fixtureを実行する
        $this->fixtureManager = new FixtureManager();
        $this->fixtureManager->fixturize($this);
        $this->fixtureManager->loadSingle('Accounts');

    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Accounts);

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
        $account_info = $this->Accounts->find('all')
            ->where(['Accounts.id' => 1])
            ->first();
        $this->assertTrue(!empty($account_info));

        //ID2はfind不可
        $account_info = $this->Accounts->find('all')
            ->where(['Accounts.id' => 2])
            ->first();
        $this->assertFalse(!empty($account_info));

        //削除済みのデータをfindする
        $account_info = $this->Accounts->find('all',['enableSoftDelete' => false])
            ->where(['Accounts.id' => 2])
            ->first();
        $this->assertTrue(!empty($account_info));
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
        $entity = $this->Accounts->newEntity($data);
        $save_result = $this->Accounts->save($entity);
        $this->assertTrue((bool) $save_result);

        $last_id = $save_result->id;
        $account_info = $this->Accounts->find('all')
            ->where(['Accounts.id' => $last_id])
            ->first();
        $this->assertTrue(!empty($account_info));

        //削除する
        $this->assertTrue($this->Accounts->softDelete($account_info));

        //削除したデータは見つからない
        $account_info = $this->Accounts->find('all')
            ->where(['Accounts.id' => $last_id])
            ->first();
        $this->assertFalse(!empty($account_info));
        
        //削除済みのデータをfindする
        $delete_info = $this->Accounts->find('all',['enableSoftDelete' => false])
            ->where(['Accounts.id' => $last_id])
            ->first();
        //削除データが問題なく入っているかの確認
        $this->assertTrue($delete_info->deleted);
        $this->assertTrue(!empty($delete_info->deleted_date));
    }


}

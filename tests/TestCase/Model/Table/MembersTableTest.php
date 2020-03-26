<?php
namespace Reincarnation\Test\TestCase\Model\Table;

use Reincarnation\Test\App\Model\Table\AddressesTable;
use Reincarnation\Test\App\Model\Table\BloodTypesTable;
use Reincarnation\Test\App\Model\Table\HobbiesTable;
use Reincarnation\Test\App\Model\Table\HobbiesMembersTable;
use Reincarnation\Test\App\Model\Table\MembersTable;
use Reincarnation\Test\App\Model\Table\TelsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Datasource\ConnectionManager;
use Cake\TestSuite\Fixture\FixtureManager;
use Cake\Utility\Inflector;

/**
 * App\Model\Table\MembersTable Test Case
 */
class MembersTableTest extends TestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.Reincarnation.Addresses',
        'plugin.Reincarnation.BloodTypes',
        'plugin.Reincarnation.Hobbies',
        'plugin.Reincarnation.HobbiesMembers',
        'plugin.Reincarnation.Members',
        'plugin.Reincarnation.Tels',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->connection = ConnectionManager::get('test');

        //table_lists
        $table_lists = [
            'Addresses',
            'BloodTypes',
            'Hobbies',
            'HobbiesMembers',
            'Members',
            'Tels',
        ];

        //fixtureManagerを呼び出し、fixtureを実行する
        foreach ($table_lists as $table_list) {
            $tableClass = 'Reincarnation\\Test\\App\\Model\\Table\\' . $table_list . 'Table';
            $this->{$table_list} = new $tableClass([
                'alias' => $table_list,
                'table' => Inflector::underscore($table_list),
                'connection' => $this->connection
            ]);
            $this->fixtureManager = new FixtureManager();
            $this->fixtureManager->fixturize($this);
            $this->fixtureManager->loadSingle($table_list);
        }

    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Members);

        parent::tearDown();
    }

    /**
     * test_save_delete_hasone
     * hasoneの削除テスト　
     *
     * @return void
     */
    public function test_save_delete_hasone(): void
    {
        //memberとaddressのデータがあることを確認
        $memberCheck = $this->Members->find('all')
            ->where(['Members.id' => 1])
            ->count('Members.id');
        $bloodTypeCheck = $this->BloodTypes->find('all')
            ->where(['BloodTypes.id' => 1])
            ->count('BloodTypes.id');
        $this->assertEquals($memberCheck, 1);
        $this->assertEquals($bloodTypeCheck, 1);

        //データ保存後、findでデータを閲覧可能
        $entity = $this->Members->find('all')
            ->where(['Members.id' => 1])
            ->contain('BloodTypes')
            ->first();
        // debug($entity);
        $this->assertTrue($this->Members->softDelete($entity, true));

        $memberCheck = $this->Members->find('all')
            ->where(['Members.id' => 1])
            ->count('Members.id');
        $bloodTypeCheck = $this->BloodTypes->find('all')
            ->where(['BloodTypes.id' => 1])
            ->count('BloodTypes.id');

        $this->assertEquals($memberCheck, 0);
        $this->assertEquals($bloodTypeCheck, 0);
    }

    /**
     * test_save_delete_belongsto
     * belongstoの削除テスト　
     *
     * @return void
     */
    public function test_save_delete_belongsto(): void
    {
        //memberとaddressのデータがあることを確認
        $memberCheck = $this->Members->find('all')
            ->where(['Members.id' => 1])
            ->count('Members.id');
        $addressCheck = $this->Addresses->find('all')
            ->where(['Addresses.member_id' => 1])
            ->count('Addresses.id');
        $this->assertEquals($memberCheck, 1);
        $this->assertEquals($addressCheck, 1);

        //データ保存後、findでデータを閲覧可能
        $entity = $this->Members->find('all')
            ->where(['Members.id' => 1])
            ->contain('Addresses')
            ->first();
        $this->assertTrue($this->Members->softDelete($entity, true));

        $memberCheck = $this->Members->find('all')
            ->where(['Members.id' => 1])
            ->count('Members.id');
        $addressCheck = $this->Addresses->find('all')
            ->where(['Addresses.member_id' => 1])
            ->count('Addresses.id');

        $this->assertEquals($memberCheck, 0);
        $this->assertEquals($addressCheck, 0);
    }

    /**
     * test_save_delete_hasmany
     * hasmanyの削除テスト　
     *
     * @return void
     */
    public function test_save_delete_hasmany(): void
    {
        //memberとaddressのデータがあることを確認
        $memberCheck = $this->Members->find('all')
            ->where(['Members.id' => 1])
            ->count('Members.id');
        $telCheck = $this->Tels->find('all')
            ->where(['Tels.member_id' => 1])
            ->count('Tels.id');
        $this->assertEquals($memberCheck, 1);
        $this->assertEquals($telCheck, 2);

        //データ保存後、findでデータを閲覧可能
        $entity = $this->Members->find('all')
            ->where(['Members.id' => 1])
            ->contain('Tels')
            ->first();
        $this->assertTrue($this->Members->softDelete($entity, true));

        $memberCheck = $this->Members->find('all')
            ->where(['Members.id' => 1])
            ->count('Members.id');
        $telCheck = $this->Tels->find('all')
            ->where(['Tels.member_id' => 1])
            ->count('Tels.id');

        $this->assertEquals($memberCheck, 0);
        $this->assertEquals($telCheck, 0);
    }

    /**
     * test_save_delete_habtm
     * habtmの削除テスト　
     *
     * @return void
     */
    public function test_save_delete_habtm(): void
    {
        //memberとaddressのデータがあることを確認
        $memberCheck = $this->Members->find('all')
            ->where(['Members.id' => 1])
            ->count('Members.id');
        $hobbiesMembersCheck = $this->HobbiesMembers->find('all')
            ->where(['HobbiesMembers.member_id' => 1])
            ->count('HobbiesMembers.id');
        $hobbiesCheck1 = $this->Hobbies->find('all')
            ->where(['Hobbies.id' => 1])
            ->count('Hobbies.id');
        $hobbiesCheck2 = $this->Hobbies->find('all')
            ->where(['Hobbies.id' => 2])
            ->count('Hobbies.id');
        $this->assertEquals($memberCheck, 1);
        $this->assertEquals($hobbiesMembersCheck, 2);
        $this->assertEquals($hobbiesCheck1, 1);
        $this->assertEquals($hobbiesCheck2, 1);

        //データ保存後、findでデータを閲覧可能
        $entity = $this->Members->find('all')
            ->where(['Members.id' => 1])
            ->contain('Hobbies')
            ->first();
        //この削除のテストを通すためにautoload-devに"App\\Model\\Table\\": "tests/test_app/DummyApp/Model/Table/"を記載
        $this->assertTrue($this->Members->softDelete($entity, true));

        $memberCheck = $this->Members->find('all')
            ->where(['Members.id' => 1])
            ->count('Members.id');
        $hobbiesMembersCheck = $this->HobbiesMembers->find('all')
            ->where(['HobbiesMembers.member_id' => 1])
            ->count('HobbiesMembers.id');
        $hobbiesCheck1 = $this->Hobbies->find('all')
            ->where(['Hobbies.id' => 1])
            ->count('Hobbies.id');
        $hobbiesCheck2 = $this->Hobbies->find('all')
            ->where(['Hobbies.id' => 2])
            ->count('Hobbies.id');

        $this->assertEquals($memberCheck, 0);
        $this->assertEquals($hobbiesMembersCheck, 0);
        $this->assertEquals($hobbiesCheck1, 0);
        $this->assertEquals($hobbiesCheck2, 0);
    }
}

<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateDataBase extends AbstractMigration
{
    /**
     * up
     *
     * @return void
     */
    public function up(): void
    {
        $this->table('accounts')
            ->addColumn('name', 'text', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'name', 'precision' => null])
            ->addColumn('deleted', 'boolean', ['length' => null, 'default' => 0, 'null' => false, 'comment' => 'deleted', 'precision' => null])
            ->addColumn('deleted_date', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'deleted_date', 'precision' => null])
            ->addColumn('created', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'created', 'precision' => null])
            ->addColumn('modified', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'modified', 'precision' => null])
            ->create();

        $this->table('addresses')
            ->addColumn('name', 'text', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'name', 'precision' => null])
            ->addColumn('member_id', 'integer', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'name', 'precision' => null])
            ->addColumn('deleted', 'boolean', ['length' => null, 'default' => 0, 'null' => false, 'comment' => 'deleted', 'precision' => null])
            ->addColumn('deleted_date', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'deleted_date', 'precision' => null])
            ->addColumn('created', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'created', 'precision' => null])
            ->addColumn('modified', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'modified', 'precision' => null])
            ->create();

        $this->table('blood_types')
            ->addColumn('name', 'text', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'name', 'precision' => null])
            ->addColumn('deleted', 'boolean', ['length' => null, 'default' => 0, 'null' => false, 'comment' => 'deleted', 'precision' => null])
            ->addColumn('deleted_date', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'deleted_date', 'precision' => null])
            ->addColumn('created', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'created', 'precision' => null])
            ->addColumn('modified', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'modified', 'precision' => null])
            ->create();

        $this->table('hobbies')
            ->addColumn('name', 'text', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'name', 'precision' => null])
            ->addColumn('deleted', 'boolean', ['length' => null, 'default' => 0, 'null' => false, 'comment' => 'deleted', 'precision' => null])
            ->addColumn('deleted_date', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'deleted_date', 'precision' => null])
            ->addColumn('created', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'created', 'precision' => null])
            ->addColumn('modified', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'modified', 'precision' => null])
            ->create();

        $this->table('hobbies_members')
            ->addColumn('name', 'text', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'name', 'precision' => null])
            ->addColumn('hobby_id', 'integer', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'name', 'precision' => null])
            ->addColumn('member_id', 'integer', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'name', 'precision' => null])
            ->addColumn('deleted', 'boolean', ['length' => null, 'default' => 0, 'null' => false, 'comment' => 'deleted', 'precision' => null])
            ->addColumn('deleted_date', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'deleted_date', 'precision' => null])
            ->addColumn('created', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'created', 'precision' => null])
            ->addColumn('modified', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'modified', 'precision' => null])
            ->create();

        $this->table('members')
            ->addColumn('name', 'text', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'name', 'precision' => null])
            ->addColumn('blood_type_id', 'integer', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'name', 'precision' => null])
            ->addColumn('deleted', 'boolean', ['length' => null, 'default' => 0, 'null' => false, 'comment' => 'deleted', 'precision' => null])
            ->addColumn('deleted_date', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'deleted_date', 'precision' => null])
            ->addColumn('created', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'created', 'precision' => null])
            ->addColumn('modified', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'modified', 'precision' => null])
            ->create();

        $this->table('tels')
            ->addColumn('name', 'text', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'name', 'precision' => null])
            ->addColumn('tel', 'text', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'name', 'precision' => null])
            ->addColumn('member_id', 'integer', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'name', 'precision' => null])
            ->addColumn('deleted', 'boolean', ['length' => null, 'default' => 0, 'null' => false, 'comment' => 'deleted', 'precision' => null])
            ->addColumn('deleted_date', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'deleted_date', 'precision' => null])
            ->addColumn('created', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'created', 'precision' => null])
            ->addColumn('modified', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'modified', 'precision' => null])
            ->create();

        $this->table('user01s')
            ->addColumn('name', 'text', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'name', 'precision' => null])
            ->addColumn('delete_flg', 'boolean', ['length' => null, 'default' => 0, 'null' => false, 'comment' => 'delete_flg', 'precision' => null])
            ->addColumn('deleted', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'deleted', 'precision' => null])
            ->addColumn('created', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'created', 'precision' => null])
            ->addColumn('modified', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'modified', 'precision' => null])
            ->create();

        $this->table('user02s')
            ->addColumn('name', 'text', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'name', 'precision' => null])
            ->addColumn('delete_flg', 'boolean', ['length' => null, 'default' => 0, 'null' => false, 'comment' => 'delete_flg', 'precision' => null])
            // ->addColumn('deleted', 'boolean', ['length' => null, 'default' => 0, 'null' => false, 'comment' => 'deleted', 'precision' => null])
            ->addColumn('created', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'created', 'precision' => null])
            ->addColumn('modified', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'modified', 'precision' => null])
            ->create();

        $this->table('user03s')
            ->addColumn('name', 'text', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'name', 'precision' => null])
            // ->addColumn('delete_flg', 'boolean', ['length' => null, 'default' => 0, 'null' => false, 'comment' => 'deleted', 'precision' => null])
            ->addColumn('deleted', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'deleted', 'precision' => null])
            ->addColumn('created', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'created', 'precision' => null])
            ->addColumn('modified', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'modified', 'precision' => null])
            ->create();

        $this->table('user04s')
            ->addColumn('name', 'text', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'name', 'precision' => null])
            // ->addColumn('delete_flg', 'boolean', ['length' => null, 'default' => 0, 'null' => false, 'comment' => 'deleted', 'precision' => null])
            ->addColumn('deleted', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'deleted', 'precision' => null])
            ->addColumn('created', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'created', 'precision' => null])
            ->addColumn('modified', 'timestamp', ['length' => null, 'default' => null, 'null' => true, 'comment' => 'modified', 'precision' => null])
            ->create();
    }

    /**
     * down
     *
     * @return void
     */
    public function down(): void
    {
        $this->table('accounts')
            ->drop()
            ->update();

        $this->table('addresses')
            ->drop()
            ->update();

        $this->table('blood_types')
            ->drop()
            ->update();

        $this->table('hobbies')
            ->drop()
            ->update();

        $this->table('hobbies_members')
            ->drop()
            ->update();

        $this->table('members')
            ->drop()
            ->update();

        $this->table('tels')
            ->drop()
            ->update();

        $this->table('user01s')
            ->drop()
            ->update();

        $this->table('user02s')
            ->drop()
            ->update();

        $this->table('user03s')
            ->drop()
            ->update();

        $this->table('user04s')
            ->drop()
            ->update();
    }
}

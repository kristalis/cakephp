<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateBookCollections extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('book_collections');
        $table->addPrimaryKey('id');
        $table->addColumn('name', 'string', ['length' => 255]);
        $table->addColumn('lib_collection_id', 'integer', ['null' => true]);
        $table->addForeignKey('lib_collection_id', 'lib_collections', ['id'], ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION']);
        $table->addColumn('start_date', 'date');
        $table->addColumn('end_date', 'date');
        $table->addTimestamps();
        $table->create();
    }
}

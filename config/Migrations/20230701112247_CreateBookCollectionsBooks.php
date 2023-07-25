<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateBookCollectionsBooks extends AbstractMigration
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
        $table = $this->table('book_collections_books');
        $table->addPrimaryKey('id');
        $table->addColumn('book_collection_id', 'integer', ['null' => true]);
        $table->addForeignKey('book_collection_id', 'book_collections', ['id'], ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION']);
        $table->addColumn('book_id', 'integer', ['null' => true]);
        $table->addForeignKey('book_id', 'books', ['id'], ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION']);
        $table->addTimestamps();
        $table->create();
    }
}

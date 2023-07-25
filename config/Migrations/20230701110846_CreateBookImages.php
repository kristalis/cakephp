<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateBookImages extends AbstractMigration
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
        $table = $this->table('book_images');
        $table->addPrimaryKey('id');
        $table->addColumn('book_id', 'integer', ['null' => true]);
        $table->addForeignKey('book_id', 'books', ['id'], ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION']);
        $table->addColumn('filename', 'string', ['length' => 255]);
        $table->addTimestamps();
        $table->create();
    }
}

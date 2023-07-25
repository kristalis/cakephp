<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateBooks extends AbstractMigration
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
        $table = $this->table('books');
        $table->addPrimaryKey('id');
        $table->addColumn('name', 'string', ['length' => 255]);
        $table->addTimestamps();
        $table->create();
    }
}

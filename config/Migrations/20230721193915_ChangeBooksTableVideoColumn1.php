<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class ChangeBooksTableVideoColumn1 extends AbstractMigration
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
        $table->changeColumn('video', 'string', ['length' => 255, 'null' => true, 'default' => null]);
        $table->update();
    }
}

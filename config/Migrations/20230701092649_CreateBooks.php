<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateClips extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://clip.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('clips');
        $table->addPrimaryKey('id');
        $table->addColumn('name', 'string', ['length' => 255]);
        $table->addTimestamps();
        $table->create();
    }
}

<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateClipCollections extends AbstractMigration
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
        $table = $this->table('clip_collections');
        $table->addPrimaryKey('id');
        $table->addColumn('name', 'string', ['length' => 255]);
        $table->addColumn('screen_collection_id', 'integer', ['null' => true]);
        $table->addForeignKey('screen_collection_id', 'screen_collections', ['id'], ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION']);
        $table->addColumn('start_date', 'date');
        $table->addColumn('end_date', 'date');
        $table->addTimestamps();
        $table->create();
    }
}

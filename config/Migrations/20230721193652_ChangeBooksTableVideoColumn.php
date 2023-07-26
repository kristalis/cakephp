<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class ChangeClipsTableVideoColumn extends AbstractMigration
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
        $table->changeColumn('video', 'string', ['length' => 255, 'default' => '']);
        $table->update();
    }
}

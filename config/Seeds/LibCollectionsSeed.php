<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * LibCollections seed.
 */
class LibCollectionsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $current_time = \Cake\I18n\FrozenTime::now()->format('Y-m-d H:i:s');
        $data = [
            [
                'id' => 1,
                'name' => 'Lib',
                'lib_count' => 1,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 2,
                'name' => 'Lib',
                'lib_count' => 2,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 3,
                'name' => 'Lib',
                'lib_count' => 3,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 4,
                'name' => 'Lib',
                'lib_count' => 4,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
        ];

        $table = $this->table('lib_collections');
        $table->insert($data)->save();
    }
}

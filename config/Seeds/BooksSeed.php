<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Books seed.
 */
class BooksSeed extends AbstractSeed
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
                'name' => 'Cakephp',
                'created_at' => $current_time,
                'updated_at' => $current_time,
                'video' => '',
            ],
            [
                'id' => 2,
                'name' => 'Java',
                'created_at' => $current_time,
                'updated_at' => $current_time,
                'video' => '',
            ],
            [
                'id' => 3,
                'name' => 'Java Script',
                'created_at' => $current_time,
                'updated_at' => $current_time,
                'video' => '',
            ],
            [
                'id' => 4,
                'name' => 'Laravel',
                'created_at' => $current_time,
                'updated_at' => $current_time,
                'video' => '',
            ],
        ];

        $table = $this->table('books');
        $table->insert($data)->save();
    }
}

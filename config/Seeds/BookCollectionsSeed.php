<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * BookCollections seed.
 */
class BookCollectionsSeed extends AbstractSeed
{
    public function getDependencies(): array
    {
        return [
            'LibCollectionsSeed',
        ];
    }

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
                'lib_collection_id' => 1,
                'start_date' => '2023-06-30',
                'end_date' => '2023-07-07',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 2,
                'name' => 'Laravel',
                'lib_collection_id' => 2,
                'start_date' => '2023-06-29',
                'end_date' => '2023-07-17',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 3,
                'name' => 'PHP',
                'lib_collection_id' => 3,
                'start_date' => '2023-06-29',
                'end_date' => '2023-07-17',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 4,
                'name' => 'Yii',
                'lib_collection_id' => 4,
                'start_date' => '2023-06-29',
                'end_date' => '2023-07-17',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
        ];

        $table = $this->table('book_collections');
        $table->insert($data)->save();
    }
}

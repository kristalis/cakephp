<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * BookCollectionsBooks seed.
 */
class BookCollectionsBooksSeed extends AbstractSeed
{
    public function getDependencies(): array
    {
        return [
            'BooksSeed',
            'BookCollectionsSeed',
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
                'book_id' => 1,
                'book_collection_id' => 1,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 2,
                'book_id' => 2,
                'book_collection_id' => 2,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 3,
                'book_id' => 3,
                'book_collection_id' => 2,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 4,
                'book_id' => 3,
                'book_collection_id' => 3,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 5,
                'book_id' => 2,
                'book_collection_id' => 3,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 6,
                'book_id' => 4,
                'book_collection_id' => 3,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 7,
                'book_id' => 3,
                'book_collection_id' => 4,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 8,
                'book_id' => 1,
                'book_collection_id' => 4,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 9,
                'book_id' => 2,
                'book_collection_id' => 4,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 10,
                'book_id' => 4,
                'book_collection_id' => 4,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
        ];

        $table = $this->table('book_collections_books');
        $table->insert($data)->save();
    }
}

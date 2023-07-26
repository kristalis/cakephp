<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * ClipCollectionsItems seed.
 */
class ClipCollectionsItemsSeed extends AbstractSeed
{
    public function getDependencies(): array
    {
        return [
            'ClipsSeed',
            'ClipCollectionsSeed',
        ];
    }
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://clip.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $current_time = \Cake\I18n\FrozenTime::now()->format('Y-m-d H:i:s');

        $data = [
            [
                'id' => 1,
                'clip_id' => 1,
                'clip_collection_id' => 1,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 2,
                'clip_id' => 2,
                'clip_collection_id' => 2,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 3,
                'clip_id' => 3,
                'clip_collection_id' => 2,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 4,
                'clip_id' => 3,
                'clip_collection_id' => 3,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 5,
                'clip_id' => 2,
                'clip_collection_id' => 3,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 6,
                'clip_id' => 4,
                'clip_collection_id' => 3,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 7,
                'clip_id' => 3,
                'clip_collection_id' => 4,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 8,
                'clip_id' => 1,
                'clip_collection_id' => 4,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 9,
                'clip_id' => 2,
                'clip_collection_id' => 4,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 10,
                'clip_id' => 4,
                'clip_collection_id' => 4,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
        ];

        $table = $this->table('clip_collections_items');
        $table->insert($data)->save();
    }
}

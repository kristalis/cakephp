<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * BookImages seed.
 */
class BookImagesSeed extends AbstractSeed
{
    public function getDependencies(): array
    {
        return [
            'BooksSeed',
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
                'filename' => 'ckae_image.jpg',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 2,
                'book_id' => 2,
                'filename' => 'java.jpg',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 3,
                'book_id' => 3,
                'filename' => 'java_script.jpg',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 4,
                'book_id' => 4,
                'filename' => 'laravel.jpg',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
        ];

        $table = $this->table('book_images');
        $table->insert($data)->save();
    }
}

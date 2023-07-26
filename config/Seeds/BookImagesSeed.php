<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * ClipImages seed.
 */
class ClipImagesSeed extends AbstractSeed
{
    public function getDependencies(): array
    {
        return [
            'ClipsSeed',
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
                'filename' => 'ckae_image.jpg',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 2,
                'clip_id' => 2,
                'filename' => 'java.jpg',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 3,
                'clip_id' => 3,
                'filename' => 'java_script.jpg',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            [
                'id' => 4,
                'clip_id' => 4,
                'filename' => 'laravel.jpg',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
        ];

        $table = $this->table('clip_images');
        $table->insert($data)->save();
    }
}

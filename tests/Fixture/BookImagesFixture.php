<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ClipImagesFixture
 */
class ClipImagesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'clip_id' => 1,
                'filename' => 'Lorem ipsum dolor sit amet',
                'created_at' => 1688211290,
                'updated_at' => 1688211290,
            ],
        ];
        parent::init();
    }
}

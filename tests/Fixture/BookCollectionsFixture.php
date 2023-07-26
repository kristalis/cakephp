<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ClipCollectionsFixture
 */
class ClipCollectionsFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'screen_collection_id' => 1,
                'start_date' => '2023-07-01',
                'end_date' => '2023-07-01',
                'created_at' => 1688211240,
                'updated_at' => 1688211240,
            ],
        ];
        parent::init();
    }
}

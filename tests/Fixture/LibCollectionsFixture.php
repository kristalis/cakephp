<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LibCollectionsFixture
 */
class LibCollectionsFixture extends TestFixture
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
                'lib_count' => 1,
                'created_at' => 1688210991,
                'updated_at' => 1688210991,
            ],
        ];
        parent::init();
    }
}

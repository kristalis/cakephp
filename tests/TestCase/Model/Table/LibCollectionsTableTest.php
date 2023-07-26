<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ScreenCollectionsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ScreenCollectionsTable Test Case
 */
class ScreenCollectionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ScreenCollectionsTable
     */
    protected $ScreenCollections;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ScreenCollections',
        'app.ClipCollections',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ScreenCollections') ? [] : ['className' => ScreenCollectionsTable::class];
        $this->ScreenCollections = $this->getTableLocator()->get('ScreenCollections', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ScreenCollections);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ScreenCollectionsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

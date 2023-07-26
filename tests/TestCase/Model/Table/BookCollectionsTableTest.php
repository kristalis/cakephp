<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClipCollectionsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClipCollectionsTable Test Case
 */
class ClipCollectionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ClipCollectionsTable
     */
    protected $ClipCollections;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ClipCollections',
        'app.ScreenCollections',
        'app.Clips',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ClipCollections') ? [] : ['className' => ClipCollectionsTable::class];
        $this->ClipCollections = $this->getTableLocator()->get('ClipCollections', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ClipCollections);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ClipCollectionsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ClipCollectionsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

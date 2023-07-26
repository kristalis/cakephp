<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClipCollectionsItemsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClipCollectionsItemsTable Test Case
 */
class ClipCollectionsItemsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ClipCollectionsItemsTable
     */
    protected $ClipCollectionsItems;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ClipCollectionsItems',
        'app.ClipCollections',
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
        $config = $this->getTableLocator()->exists('ClipCollectionsItems') ? [] : ['className' => ClipCollectionsItemsTable::class];
        $this->ClipCollectionsItems = $this->getTableLocator()->get('ClipCollectionsItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ClipCollectionsItems);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ClipCollectionsItemsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ClipCollectionsItemsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

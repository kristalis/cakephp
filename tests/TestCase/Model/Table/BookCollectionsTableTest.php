<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BookCollectionsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BookCollectionsTable Test Case
 */
class BookCollectionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BookCollectionsTable
     */
    protected $BookCollections;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.BookCollections',
        'app.LibCollections',
        'app.Books',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('BookCollections') ? [] : ['className' => BookCollectionsTable::class];
        $this->BookCollections = $this->getTableLocator()->get('BookCollections', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->BookCollections);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\BookCollectionsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\BookCollectionsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

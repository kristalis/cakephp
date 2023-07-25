<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BookCollectionsBooksTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BookCollectionsBooksTable Test Case
 */
class BookCollectionsBooksTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BookCollectionsBooksTable
     */
    protected $BookCollectionsBooks;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.BookCollectionsBooks',
        'app.BookCollections',
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
        $config = $this->getTableLocator()->exists('BookCollectionsBooks') ? [] : ['className' => BookCollectionsBooksTable::class];
        $this->BookCollectionsBooks = $this->getTableLocator()->get('BookCollectionsBooks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->BookCollectionsBooks);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\BookCollectionsBooksTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\BookCollectionsBooksTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

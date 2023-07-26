<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClipImagesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClipImagesTable Test Case
 */
class ClipImagesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ClipImagesTable
     */
    protected $ClipImages;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ClipImages',
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
        $config = $this->getTableLocator()->exists('ClipImages') ? [] : ['className' => ClipImagesTable::class];
        $this->ClipImages = $this->getTableLocator()->get('ClipImages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ClipImages);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ClipImagesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ClipImagesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

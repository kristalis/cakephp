<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClipsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClipsTable Test Case
 */
class ClipsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ClipsTable
     */
    protected $Clips;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
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
        $config = $this->getTableLocator()->exists('Clips') ? [] : ['className' => ClipsTable::class];
        $this->Clips = $this->getTableLocator()->get('Clips', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Clips);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ClipsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

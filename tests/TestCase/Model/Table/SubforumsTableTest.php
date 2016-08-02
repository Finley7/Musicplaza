<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SubforumsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SubforumsTable Test Case
 */
class SubforumsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SubforumsTable
     */
    public $Subforums;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.subforums',
        'app.threads'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Subforums') ? [] : ['className' => 'App\Model\Table\SubforumsTable'];
        $this->Subforums = TableRegistry::get('Subforums', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Subforums);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

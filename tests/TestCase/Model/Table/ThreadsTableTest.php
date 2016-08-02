<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ThreadsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ThreadsTable Test Case
 */
class ThreadsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ThreadsTable
     */
    public $Threads;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.threads',
        'app.forums',
        'app.sections',
        'app.users',
        'app.user_preferences',
        'app.roles',
        'app.user_role',
        'app.roles_roles_users',
        'app.permissions',
        'app.permissions_roles',
        'app.roles_users',
        'app.primary_role',
        'app.subforums'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Threads') ? [] : ['className' => 'App\Model\Table\ThreadsTable'];
        $this->Threads = TableRegistry::get('Threads', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Threads);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

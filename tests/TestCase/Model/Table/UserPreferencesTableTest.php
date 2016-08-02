<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserPreferencesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserPreferencesTable Test Case
 */
class UserPreferencesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UserPreferencesTable
     */
    public $UserPreferences;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.user_preferences',
        'app.users',
        'app.roles',
        'app.user_role',
        'app.roles_roles_users',
        'app.permissions',
        'app.permissions_roles',
        'app.roles_users',
        'app.primary_role'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UserPreferences') ? [] : ['className' => 'App\Model\Table\UserPreferencesTable'];
        $this->UserPreferences = TableRegistry::get('UserPreferences', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserPreferences);

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

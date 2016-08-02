<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ThreadsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ThreadsController Test Case
 */
class ThreadsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.threads',
        'app.forums',
        'app.sections',
        'app.subforums',
        'app.users',
        'app.user_preferences',
        'app.roles',
        'app.user_role',
        'app.roles_roles_users',
        'app.permissions',
        'app.permissions_roles',
        'app.roles_users',
        'app.primary_role',
        'app.comments'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

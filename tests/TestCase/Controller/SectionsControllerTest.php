<?php
namespace App\Test\TestCase\Controller;

use App\Controller\SectionsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\SectionsController Test Case
 */
class SectionsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sections',
        'app.forums',
        'app.subforums',
        'app.threads',
        'app.users',
        'app.user_preferences',
        'app.warnings',
        'app.receivers',
        'app.roles',
        'app.user_role',
        'app.roles_roles_users',
        'app.permissions',
        'app.permissions_roles',
        'app.roles_users',
        'app.primary_role',
        'app.authors',
        'app.comments',
        'app.editor',
        'app.lastposter'
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

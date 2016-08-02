<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\BolComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\BolComponent Test Case
 */
class BolComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\BolComponent
     */
    public $Bol;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Bol = new BolComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Bol);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

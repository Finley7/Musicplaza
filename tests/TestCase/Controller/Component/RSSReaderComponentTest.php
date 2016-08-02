<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\RSSReaderComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\RSSReaderComponent Test Case
 */
class RSSReaderComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\RSSReaderComponent
     */
    public $RSSReader;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->RSSReader = new RSSReaderComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RSSReader);

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

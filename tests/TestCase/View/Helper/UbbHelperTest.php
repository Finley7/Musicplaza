<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\UbbHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\UbbHelper Test Case
 */
class UbbHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\View\Helper\UbbHelper
     */
    public $Ubb;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Ubb = new UbbHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Ubb);

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

<?php

namespace Test\SahiDriver;

use Everzet\SahiDriver\Browser;
require_once 'AbstractConnectionTest.php';

class BrowserTest extends AbstractConnectionTest
{
    private $api;

    public function setUp()
    {
        $connection = $this->getConnectionMock();
        $this->api  = new Browser($connection);
    }

    public function testNavigateTo()
    {
        $this->assertActionStep(
            sprintf('_sahi._navigateTo("%s")', 'http://sahi.co.in'),
            array($this->api, 'navigateTo'),
            array('http://sahi.co.in')
        );

        $this->assertActionStep(
            sprintf('_sahi._navigateTo("%s", true)', 'http://sahi.co.in'),
            array($this->api, 'navigateTo'),
            array('http://sahi.co.in', true)
        );

        $this->assertActionStep(
            sprintf('_sahi._navigateTo("%s", false)', 'http://sahi.co.in'),
            array($this->api, 'navigateTo'),
            array('http://sahi.co.in', false)
        );
    }

    public function testSetSpeed()
    {
        $this->assertActionCommand(
            'setSpeed', array('speed' => 12),
            array($this->api, 'setSpeed'),
            array(12)
        );
    }

    public function testFindByClassName()
    {
        $accessor = $this->api->findByClassName('', '');

        $this->assertInstanceOf('Everzet\SahiDriver\Accessor\ByClassNameAccessor', $accessor);
    }
}

<?php

namespace Site\UtilityBundle\Tests\Unit\Listener;

use Site\UtilityBundle\Listener\DeviceListener;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class DeviceListenerTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        // $this->listener = new DeviceListener();
        // $this->request = $this->createRequest();
    }

    public function testThis()
    {
        $this->assertTrue(true);
    }
}

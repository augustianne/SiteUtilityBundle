<?php

namespace Site\UtilityBundle\Listener;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\FilterRequestEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

use Site\UtilityBundle\Detector\DeviceDetector;

class DeviceListener
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        $request = $event->getRequest();

        $treatTabletAsMobile = $this->container->getParameter('site_utility.device_detector.tablet_as_mobile');
        
        $detector = new DeviceDetector($request, $treatTabletAsMobile);

        if ($detector->isMobile()) {

            $_route = $request->get('_route');
            $_controller = $request->get('_controller');

            $mobileControllerPath = $this->container->getParameter('site_utility.device_detector.mobile.path');
            if ($this->isMobileRoute($_route) && !is_null($_route)) {
                $action = $this->getControllerAction($_controller);
                $controller = sprintf('%s::%s', $path, $action);

                if ($controller != $request->get('_controller')) {
                    $controllerTokens = explode('::', $controller);

                    $controllerObj = new $path();
                    $controllerObj->setContainer($this->container);
                    $event->setController(array($controllerObj, $action));
                }
            }
        }
    }

    private function isMobileRoute($route)
    {
        $mobileRoutes = $this->container->getParameter('site_utility.device_detector.mobile.routes');

        return in_array($route, $mobileRoutes);
    }

    private function getControllerAction($controller)
    {
        $parts = explode('::', $controller);

        return end($parts);
    }
}
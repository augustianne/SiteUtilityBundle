<?php

namespace Site\UtilityBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class SiteUtilityExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('site_utility.device_detection', $config['device_detection']);
        $container->setParameter('site_utility.device_detection.tablet_as_mobile', $config['device_detection']['tablet_as_mobile']);
        $container->setParameter('site_utility.device_detection.mobile', $config['device_detection']['mobile']);
        $container->setParameter('site_utility.device_detection.mobile.path', $config['device_detection']['mobile']['path']);
        $container->setParameter('site_utility.device_detection.mobile.routes', $config['device_detection']['mobile']['routes']);
        $container->setParameter('site_utility.device_detection.tablet', $config['device_detection']['tablet']);
        $container->setParameter('site_utility.device_detection.tablet.path', $config['device_detection']['tablet']['path']);
        $container->setParameter('site_utility.device_detection.tablet.routes', $config['device_detection']['tablet']['routes']);
    }
}

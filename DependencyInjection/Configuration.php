<?php

namespace Site\UtilityBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('site_utility');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        $rootNode
            ->children()
                ->arrayNode('device_detection')
                    ->info('Device detection configuration')
                    ->canBeEnabled()
                    ->children()
                        ->booleanNode('tablet_as_mobile')->defaultTrue()->end()
                        ->arrayNode('mobile')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->performNoDeepMerging()
                            ->children()
                                ->scalarNode('path')
                                    ->info('path to mobile controllers')
                                ->end()
                                ->arrayNode('routes')
                                    ->beforeNormalization()->ifString()->then(function ($v) { return array($v); })->end()
                                    ->prototype('scalar')->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('tablet')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->performNoDeepMerging()
                            ->children()
                                ->scalarNode('path')
                                    ->info('path to tablet controllers')
                                    ->defaultValue('')
                                ->end()
                                ->arrayNode('routes')
                                    ->beforeNormalization()->ifString()->then(function ($v) { return array($v); })->end()
                                    ->prototype('scalar')->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}

<?php

namespace AutoMapper\Bundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

readonly class Configuration implements ConfigurationInterface
{
    /**
     * @param bool $debug Whether debugging is enabled or not
     */
    public function __construct(
        private bool $debug,
    ) {
    }

    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('automapper');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->booleanNode('normalizer')->defaultFalse()->end()
                ->scalarNode('name_converter')->defaultNull()->end()
                ->scalarNode('cache_dir')->defaultValue('%kernel.cache_dir%/automapper')->end()
                ->scalarNode('date_time_format')->defaultValue(\DateTimeInterface::RFC3339)->end()
                ->booleanNode('hot_reload')->defaultValue($this->debug)->end()
                ->booleanNode('map_private_properties')->defaultTrue()->end()
                ->booleanNode('allow_readonly_target_to_populate')->defaultFalse()->end()
                ->arrayNode('warmup')
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('source')->defaultValue('array')->end()
                            ->scalarNode('target')->defaultValue('array')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}

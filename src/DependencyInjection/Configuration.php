<?php

namespace Tenolo\Bundle\DoctrineDiscriminatorMapBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @package Tenolo\Bundle\DoctrineDiscriminatorMapBundle\DependencyInjection
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class Configuration implements ConfigurationInterface
{

    /**
     * @inheritDoc
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('tenolo_doctrine_discriminator_map');

        $rootNode
            ->children()
            ->scalarNode('naming_strategy')->defaultValue("hash")->end()
            ->arrayNode('discriminator_map')->requiresAtLeastOneElement()->prototype('array')
            ->children()
            ->scalarNode('entity')->end()
            ->variableNode('discriminator')->defaultValue("discriminator")->end()
            ->variableNode('inheritance_type')->defaultValue(2)->end()
            ->arrayNode('children')->prototype('scalar')->end()
            ->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}

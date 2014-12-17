<?php

namespace Tenolo\DoctrineDiscriminatorMapBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package Tenolo\DoctrineDiscriminatorMapBundle\DependencyInjection
 * @author Nikita Loges
 * @company tenolo GbR
 */
class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('tenolo_doctrine_discriminator_map');

        $rootNode
            ->children()
            ->arrayNode('discriminator_map')->requiresAtLeastOneElement()->useAttributeAsKey('name')->prototype('array')
            ->children()
            ->scalarNode('entity')->end()
            ->variableNode('discriminator')->defaultValue("discriminator")->end()
            ->variableNode('inheritance_type')->defaultValue(3)->end()
            ->arrayNode('children')->useAttributeAsKey('name')->prototype('scalar')->end()
            ->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}

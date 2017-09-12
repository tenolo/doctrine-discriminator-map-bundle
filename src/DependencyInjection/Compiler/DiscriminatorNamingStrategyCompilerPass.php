<?php

namespace Tenolo\Bundle\DoctrineDiscriminatorMapBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class DiscriminatorNamingStrategyCompilerPass
 *
 * @package Tenolo\Bundle\DoctrineDiscriminatorMapBundle\DependencyInjection\Compiler
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class DiscriminatorNamingStrategyCompilerPass implements CompilerPassInterface
{

    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        $delegator = $container->getDefinition('tenolo_discriminator_map.naming_strategy.delegator');

        $strategyName = $container->getParameter('tenolo_doctrine_discriminator_map.naming_strategy');
        $strategy = $container->getDefinition('tenolo_discriminator_map.naming_strategy.' . $strategyName);

        $delegator->replaceArgument(0, $strategy);
    }

}

<?php

namespace Tenolo\Bundle\DoctrineDiscriminatorMapBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Tenolo\Bundle\DoctrineDiscriminatorMapBundle\DependencyInjection\Compiler\DiscriminatorNamingStrategyCompilerPass;

/**
 * Class TenoloDoctrineDiscriminatorMapBundle
 *
 * @package Tenolo\Bundle\DoctrineDiscriminatorMapBundle
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class TenoloDoctrineDiscriminatorMapBundle extends Bundle
{

    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new DiscriminatorNamingStrategyCompilerPass());
    }

}

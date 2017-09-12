<?php

namespace Tenolo\Bundle\DoctrineDiscriminatorMapBundle;

use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Mmoreram\SymfonyBundleDependencies\DependentBundleInterface;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\KernelInterface;
use Tenolo\Bundle\DoctrineDiscriminatorMapBundle\DependencyInjection\Compiler\DiscriminatorNamingStrategyCompilerPass;

/**
 * Class TenoloDoctrineDiscriminatorMapBundle
 *
 * @package Tenolo\Bundle\DoctrineDiscriminatorMapBundle
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class TenoloDoctrineDiscriminatorMapBundle extends Bundle implements DependentBundleInterface
{

    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new DiscriminatorNamingStrategyCompilerPass());
    }

    /**
     * @inheritDoc
     */
    public static function getBundleDependencies(KernelInterface $kernel)
    {
        return [
            FrameworkBundle::class,
            DoctrineBundle::class,
        ];
    }

}

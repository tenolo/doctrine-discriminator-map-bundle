<?php

namespace Tenolo\Bundle\DoctrineDiscriminatorMapBundle;

use Mmoreram\SymfonyBundleDependencies\DependentBundleInterface;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\KernelInterface;
use Tenolo\Bundle\CoreBundle\TenoloCoreBundle;

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
     * @inheritdoc
     */
    public static function getBundleDependencies(KernelInterface $kernel)
    {
        return [
            FrameworkBundle::class,
            TenoloCoreBundle::class,
        ];
    }
}

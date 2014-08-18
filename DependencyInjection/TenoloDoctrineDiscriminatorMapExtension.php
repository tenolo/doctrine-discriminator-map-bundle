<?php

namespace Tenolo\DoctrineDiscriminatorMapBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class TenoloDoctrineDiscriminatorMapExtension
 * @package Tenolo\DoctrineDiscriminatorMapBundle\DependencyInjection
 * @author Nikita Loges
 * @company tenolo GbR
 * @date ${DATE}
 */
class TenoloDoctrineDiscriminatorMapExtension extends Extension
{

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter("tenolo_doctrine_discriminator_map.discriminator_map", $config['discriminator_map']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
    }
}

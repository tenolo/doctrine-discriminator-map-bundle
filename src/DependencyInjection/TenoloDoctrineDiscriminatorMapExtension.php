<?php

namespace Tenolo\Bundle\DoctrineDiscriminatorMapBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Tenolo\Bundle\DoctrineDiscriminatorMapBundle\Doctrine\ORM\Mapping\ClassMetadataFactory;

/**
 * Class TenoloDoctrineDiscriminatorMapExtension
 *
 * @package Tenolo\Bundle\DoctrineDiscriminatorMapBundle\DependencyInjection
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class TenoloDoctrineDiscriminatorMapExtension extends ConfigurableExtension implements PrependExtensionInterface
{

    /**
     * @inheritDoc
     */
    public function loadInternal(array $configs, ContainerBuilder $container)
    {
        $container->setParameter("tenolo_doctrine_discriminator_map.discriminator_map", $configs['discriminator_map']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
    }

    /**
     * @inheritdoc
     */
    public function prepend(ContainerBuilder $container)
    {
        $doctrine = [
            'orm' => [
                'class_metadata_factory_name' => ClassMetadataFactory::class,
            ]
        ];

        foreach ($container->getExtensions() as $name => $extension) {
            switch ($name) {
                case 'doctrine':
                    $container->prependExtensionConfig($name, $doctrine);
                    break;
            }
        }
    }
}

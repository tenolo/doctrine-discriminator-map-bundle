<?php

namespace Tenolo\Bundle\DoctrineDiscriminatorMapBundle\Discriminator\Naming;

/**
 * Class NamespaceStrategy
 *
 * @package Tenolo\Bundle\DoctrineDiscriminatorMapBundle\Discriminator\Naming
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class NamespaceStrategy implements StrategyInterface
{

    /**
     * @inheritDoc
     */
    public function getName($className)
    {
        return $className;
    }

}

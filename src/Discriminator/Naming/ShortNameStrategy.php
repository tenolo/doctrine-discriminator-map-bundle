<?php

namespace Tenolo\Bundle\DoctrineDiscriminatorMapBundle\Discriminator\Naming;

/**
 * Class ShortNameStrategy
 *
 * @package Tenolo\Bundle\DoctrineDiscriminatorMapBundle\Discriminator\Naming
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class ShortNameStrategy implements StrategyInterface
{

    /**
     * @inheritDoc
     */
    public function getName($className)
    {
        return (new \ReflectionClass($className))->getShortName();
    }

}

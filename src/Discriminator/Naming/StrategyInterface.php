<?php

namespace Tenolo\Bundle\DoctrineDiscriminatorMapBundle\Discriminator\Naming;

/**
 * Interface StrategyInterface
 *
 * @package Tenolo\Bundle\DoctrineDiscriminatorMapBundle\Discriminator\Naming
 * @author  Nikita Loges
 * @company tenolo GbR
 */
interface StrategyInterface
{

    /**
     * @param string $className
     *
     * @return string
     */
    public function getName($className);
}

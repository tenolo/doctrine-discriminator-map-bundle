<?php

namespace Tenolo\Bundle\DoctrineDiscriminatorMapBundle\Doctrine\ORM\Mapping;

use Tenolo\Bundle\DoctrineDiscriminatorMapBundle\Discriminator\Naming\StrategyInterface;

/**
 * Class StrategyContainer
 *
 * @package Tenolo\Bundle\DoctrineDiscriminatorMapBundle\Doctrine\ORM\Mapping
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class StrategyContainer
{

    /** @var StrategyInterface */
    protected static $strategy;

    /**
     * @return StrategyInterface
     */
    public static function getStrategy()
    {
        return static::$strategy;
    }

    /**
     * @param StrategyInterface $strategy
     */
    public static function setStrategy($strategy)
    {
        static::$strategy = $strategy;
    }
}

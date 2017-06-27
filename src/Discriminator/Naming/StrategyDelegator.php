<?php

namespace Tenolo\Bundle\DoctrineDiscriminatorMapBundle\Discriminator\Naming;

use Tenolo\Bundle\DoctrineDiscriminatorMapBundle\Doctrine\ORM\Mapping\StrategyContainer;

/**
 * Class StrategyDelegator
 *
 * @package Tenolo\Bundle\DoctrineDiscriminatorMapBundle\Discriminator\Naming
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class StrategyDelegator implements StrategyInterface
{

    /** @var  StrategyInterface */
    protected $strategy;

    /**
     * @param StrategyInterface $strategy
     */
    public function __construct(StrategyInterface $strategy)
    {
        $this->strategy = $strategy;

        StrategyContainer::setStrategy($strategy);
    }

    /**
     * @inheritDoc
     */
    public function getName($className)
    {
        return $this->strategy->getName($className);
    }

}

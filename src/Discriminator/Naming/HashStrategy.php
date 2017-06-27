<?php

namespace Tenolo\Bundle\DoctrineDiscriminatorMapBundle\Discriminator\Naming;

use JBZoo\Utils\Str;

/**
 * Class HashStrategy
 *
 * @package Tenolo\Bundle\DoctrineDiscriminatorMapBundle\Discriminator\Naming
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class HashStrategy implements StrategyInterface
{

    /**
     * @inheritDoc
     */
    public function getName($className)
    {
        return Str::limitChars(hash('sha1', $className), $limit = 8, $append = null);
    }

}

<?php

namespace Tenolo\Bundle\DoctrineDiscriminatorMapBundle\Util;

use Tenolo\Bundle\CoreBundle\Util\Base;
use Tenolo\Bundle\CoreBundle\Util\Crypt;
use Tenolo\Bundle\CoreBundle\Util\String;

/**
 * Class DiscriminatorMap
 * @package Tenolo\Bundle\DoctrineDiscriminatorMapBundle\Util
 * @author Nikita Loges
 * @company tenolo GbR
 * @date 28.04.2015
 */
class DiscriminatorMap extends Base
{

    /**
     * @param $value
     * @return string
     */
    public static function hash($value)
    {
        return String::getFirstNChars(Crypt::sha1($value), 8);
    }
}
<?php

namespace Tenolo\Bundle\DoctrineDiscriminatorMapBundle\Util;

use Tenolo\Bundle\CoreBundle\Util\BaseUtil;
use Tenolo\Bundle\CoreBundle\Util\CryptUtil;
use Tenolo\Bundle\CoreBundle\Util\StringUtil;

/**
 * Class DiscriminatorMap
 * @package Tenolo\Bundle\DoctrineDiscriminatorMapBundle\Util
 * @author Nikita Loges
 * @company tenolo GbR
 * @date 28.04.2015
 */
class DiscriminatorMapUtil extends BaseUtil
{

    /**
     * @param $value
     * @return string
     */
    public static function hash($value)
    {
        return StringUtil::getFirstNChars(CryptUtil::sha1($value), 8);
    }
}
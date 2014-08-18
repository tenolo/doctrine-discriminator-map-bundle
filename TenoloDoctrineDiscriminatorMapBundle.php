<?php

namespace Tenolo\DoctrineDiscriminatorMapBundle;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class TenoloDoctrineDiscriminatorMapBundle
 * @package Tenolo\DoctrineDiscriminatorMapBundle
 * @author Nikita Loges
 * @company tenolo GbR
 */
class TenoloDoctrineDiscriminatorMapBundle extends Bundle
{

    /**
     * @{@inheritdoc}
     */
    public function boot()
    {
        // register doctrine annotation
        AnnotationRegistry::registerAutoloadNamespace('Tenolo\DoctrineTablePrefixBundle\Doctrine\Annotations', __DIR__.'/../..');
    }
}

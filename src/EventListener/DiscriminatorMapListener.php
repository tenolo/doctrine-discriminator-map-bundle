<?php

namespace Tenolo\Bundle\DoctrineDiscriminatorMapBundle\EventListener;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\DiscriminatorMap as AnnoDiscriminatorMap;
use Tenolo\Bundle\DoctrineDiscriminatorMapBundle\Discriminator\Naming\StrategyInterface;

/**
 * Class DiscriminatorMapListener
 *
 * @package Tenolo\Bundle\DoctrineDiscriminatorMapBundle\EventListener
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class DiscriminatorMapListener
{

    /** @var array */
    protected $discriminatorMap;

    /** @var StrategyInterface */
    protected $discriminatorNaming;

    /**
     * @param StrategyInterface $strategy
     * @param                   $discriminatorMap
     */
    public function __construct(StrategyInterface $strategy, $discriminatorMap)
    {
        $this->discriminatorNaming = $strategy;
        $this->discriminatorMap = $discriminatorMap;
    }

    /**
     * @param LoadClassMetadataEventArgs $eventArgs
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        // break
        if (!count($this->discriminatorMap)) {
            return;
        }

        /** @var ClassMetadata $metadata */
        $metadata = $eventArgs->getClassMetadata();

        /** @var \ReflectionClass $class */
        // create reflection manual if not exist
        if (($class = $metadata->getReflectionClass()) === null) {
            $class = new \ReflectionClass($metadata->getName());
        }

        foreach ($this->discriminatorMap as $config) {
            if ($class->getName() == $config['entity']) {
                $reader = new AnnotationReader();

                // try to get DiscriminatorMap
                if ($discriminatorMapAnnotation = $reader->getClassAnnotation($class, AnnoDiscriminatorMap::class)) {
                    $discriminatorMap = $discriminatorMapAnnotation->value;
                } // generate map by myself
                else {
                    $hash = $this->discriminatorNaming->getName($class->getName());
                    $discriminatorMap = [$hash => $class->getName()];
                }

                $children = [];
                foreach ($config['children'] as $value) {
                    $hash = $this->discriminatorNaming->getName($value);
                    $children[$hash] = $value;
                }

                // merge map
                $discriminatorMap = array_replace($discriminatorMap, $children);

                // set inheritance type if not set
                if ($metadata->isInheritanceTypeNone()) {
                    // set inheritance type to single table
                    $metadata->setInheritanceType($config['inheritance_type']);
                    $metadata->setDiscriminatorColumn([
                        'name'   => $config['discriminator'],
                        'type'   => 'string',
                        'length' => '255'
                    ]);
                }

                // set map to meta data
                $metadata->setDiscriminatorMap($discriminatorMap);
            }
        }
    }
}
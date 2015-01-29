<?php

namespace Tenolo\Bundle\DoctrineDiscriminatorMapBundle\EventListener;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Mapping\ClassMetadata;
use Tenolo\Bundle\CoreBundle\Util\String;

/**
 * Class DiscriminatorMapListener
 * @package Tenolo\Bundle\DoctrineDiscriminatorMapBundle\EventListener
 * @author Nikita Loges
 * @company tenolo GbR
 * @date 05.06.14
 */
class DiscriminatorMapListener
{

    /**
     * @var array
     */
    private $discriminatorMap;

    /**
     * Constructor
     *
     * @param array $discriminatorMap
     */
    public function __construct($discriminatorMap)
    {
        $this->discriminatorMap = $discriminatorMap;
    }

    /**
     * Sets the discriminator map according to the config
     *
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

        foreach ($this->discriminatorMap as $table => $config) {
            if ($class->getName() == $config['entity']) {
                $reader = new AnnotationReader();

                // try to get DiscriminatorMap
                if ($discriminatorMapAnnotation = $reader->getClassAnnotation($class, 'Doctrine\ORM\Mapping\DiscriminatorMap')) {
                    $discriminatorMap = $discriminatorMapAnnotation->value;
                } // generate map by myself
                else {
                    $discriminatorMap = array(
                        String::toLowerCase($class->getShortName()) => $class->getName()
                    );
                }

                // merge map
                $discriminatorMap = array_replace($discriminatorMap, $config['children']);

                // set inheritance type if not set
                if ($metadata->isInheritanceTypeNone()) {
                    // set inheritance type to single table
                    $metadata->setInheritanceType($config['inheritance_type']);
                    $metadata->setDiscriminatorColumn(array(
                        'name' => $config['discriminator'],
                        'type' => 'string',
                        'length' => '255'
                    ));
                }

                // set map to meta data
                $metadata->setDiscriminatorMap($discriminatorMap);
            }
        }
    }
}
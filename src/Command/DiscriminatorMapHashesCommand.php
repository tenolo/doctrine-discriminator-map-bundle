<?php

namespace Tenolo\Bundle\DoctrineDiscriminatorMapBundle\Command;

use Doctrine\ORM\Mapping\ClassMetadata;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Tenolo\Bundle\DoctrineDiscriminatorMapBundle\Discriminator\Naming\StrategyInterface;

/**
 * Class DiscriminatorMapHashesCommand
 *
 * @package Tenolo\Bundle\DoctrineDiscriminatorMapBundle\Command
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class DiscriminatorMapHashesCommand extends Command
{

    /** @var StrategyInterface */
    protected $strategy;

    /** @var RegistryInterface */
    protected $registry;

    /**
     * @param StrategyInterface $strategy
     * @param RegistryInterface $registry
     */
    public function __construct(StrategyInterface $strategy, RegistryInterface $registry)
    {
        parent::__construct();

        $this->strategy = $strategy;
        $this->registry = $registry;
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('tenolo:discriminator-map:hashes');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $strategy = $this->strategy;

        foreach ($this->registry->getManagers() as $em) {

            /** @var ClassMetadata[] $metadatas */
            $metadatas = $em->getMetadataFactory()->getAllMetadata();

            $rows = [];

            foreach ($metadatas as $metadata) {
                $rows[] = [$metadata->getName(), $strategy->getName($metadata->getName())];
            }
        }

        $table = $this->getHelper('table');

        $table->setHeaders(['Klasse', 'Hash']);
        $table->setRows($rows);

        $table->render($output);
    }
}
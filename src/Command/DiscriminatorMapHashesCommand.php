<?php

namespace Tenolo\Bundle\DoctrineDiscriminatorMapBundle\Command;

use Doctrine\ORM\Mapping\ClassMetadata;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Tenolo\Bundle\CoreBundle\Component\DependencyInjection\Container\ContainerShortcuts;

/**
 * Class DiscriminatorMapHashesCommand
 *
 * @package Tenolo\Bundle\CoreBundle\Command
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class DiscriminatorMapHashesCommand extends ContainerAwareCommand
{

    use ContainerShortcuts;

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
        $strategy = $this->getContainer()->get('discriminator_naming_strategy');

        /** @var ClassMetadata[] $metadatas */
        $metadatas = $this->getEntityManager()->getMetadataFactory()->getAllMetadata();

        $rows = [];

        foreach ($metadatas as $metadata) {
            $rows[] = [$metadata->getName(), $strategy->getName($metadata->getName())];
        }

        $table = $this->getHelper('table');

        $table->setHeaders(['Klasse', 'Hash']);
        $table->setRows($rows);

        $table->render($output);
    }
}
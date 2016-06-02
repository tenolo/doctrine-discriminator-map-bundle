<?php

namespace Tenolo\Bundle\DoctrineDiscriminatorMapBundle\Command;

use Doctrine\ORM\Mapping\ClassMetadata;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Tenolo\Bundle\CoreBundle\Command\BaseCommand;
use Tenolo\Bundle\DoctrineDiscriminatorMapBundle\Util\DiscriminatorMapUtil;

/**
 * Class DiscriminatorMapHashesCommand
 *
 * @package Tenolo\Bundle\CoreBundle\Command
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class DiscriminatorMapHashesCommand extends BaseCommand
{

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var ClassMetadata[] $metadatas */
        $metadatas = $this->getEntityManager()->getMetadataFactory()->getAllMetadata();

        $rows = array();

        foreach ($metadatas as $metadata) {
            $rows[] = array($metadata->getName(), DiscriminatorMapUtil::hash($metadata->getName()));
        }

        $table = new Table($output);
        $table->setHeaders(array('Klasse', 'Hash'));
        $table->setRows($rows);
        $table->render();
    }

}
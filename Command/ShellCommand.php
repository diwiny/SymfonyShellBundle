<?php

namespace Diwiny\SymfonyShellBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ShellCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('shell:run')
            ->setDescription('Fire up a PsySH shell');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $shell = $this->getContainer()->get('symfony_shell.shell');
        $shell->run();
    }
}

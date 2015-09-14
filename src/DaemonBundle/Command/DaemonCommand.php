<?php

namespace Etki\Projects\Hamburgrouble\DaemonBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Daemon launching command.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Projects\Hamburgrouble\DaemonBundle\Command
 * @author  Etki <etki@etki.name>
 */
class DaemonCommand extends ContainerAwareCommand
{
    /**
     * Configuration.
     *
     * @return void
     * @since 0.1.0
     */
    public function configure()
    {
        $this
            ->setName('hamburgrouble:daemon')
            ->setDescription('Launches daemon');
    }

    /**
     * Runs daemon.
     *
     * @param InputInterface  $input  Input.
     * @param OutputInterface $output Output.
     *
     * @return void
     * @since 0.1.0
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $scheduler =
            $this->getContainer()->get('etki.hamburgrouble.daemon.scheduler');
        $scheduler->run();
    }
}

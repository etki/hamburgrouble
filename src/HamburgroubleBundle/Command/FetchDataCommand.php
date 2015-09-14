<?php

namespace Etki\Projects\Hamburgrouble\HamburgroubleBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Fetches data.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Projects\Hamburgrouble\HamburgroubleBundle\Command
 * @author  Etki <etki@etki.name>
 */
class FetchDataCommand extends ContainerAwareCommand
{
    /**
     * Configures command.
     *
     * @return void
     * @since 0.1.0
     */
    public function configure()
    {
        $this
            ->setName('hamburgrouble:fetch-data')
            ->setDescription('Fetches fresh data');
    }

    /**
     * Launches command.
     *
     * @param InputInterface  $input  Input.
     * @param OutputInterface $output Output.
     *
     * @return void
     * @since 0.1.0
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();
        $fetcher = $container->get('etki.hamburgrouble.data_fetcher');
        $fetcher->loadData();
    }
}

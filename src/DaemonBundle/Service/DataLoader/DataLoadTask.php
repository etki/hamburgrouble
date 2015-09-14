<?php

namespace Etki\Projects\Hamburgrouble\DaemonBundle\Service\DataLoader;

use Etki\Projects\Hamburgrouble\DaemonBundle\Service\Scheduler\TaskInterface;
use Psr\Log\LoggerInterface;

/**
 * Futurely implemented data load task.
 *
 * @version 0.1.0
 * @since
 * @package Etki\Projects\Hamburgrouble\DaemonBundle\Service\DataLoader
 * @author  Etki <etki@etki.name>
 */
class DataLoadTask implements TaskInterface
{
    /**
     * Data loader service.
     *
     * @type DataLoader
     * @since 0.1.0
     */
    private $dataLoader;
    /**
     * Logger instance.
     *
     * @type LoggerInterface
     * @since 0.1.0
     */
    private $logger;

    /**
     * Initializer.
     *
     * @param DataLoader      $dataLoader Data loader.
     * @param LoggerInterface $logger     Logger instance.
     *
     * @since 0.1.0
     */
    public function __construct(DataLoader $dataLoader, LoggerInterface $logger)
    {
        $this->dataLoader = $dataLoader;
        $this->logger = $logger;
    }

    /**
     * Executes task.
     *
     * @return void
     * @since 0.1.0
     */
    public function execute()
    {
        $this->logger->info('Dummy data loading execution');
    }
}

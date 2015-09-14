<?php

namespace Etki\Projects\Hamburgrouble\HamburgroubleBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Monolog\Logger;

/**
 * This service is responsible for loading external data into database.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Projects\Hamburgrouble\HamburgroubleBundle\Service
 * @author  Etki <etki@etki.name>
 */
class DataFetchService
{
    /**
     * Logger instance.
     *
     * @type Logger
     * @since 0.1.0
     */
    private $logger;

    /**
     * Initializer.
     *
     * @param EntityManagerInterface $entityManager Entity manager instance.
     * @param Logger                 $logger        Logger instance.
     *
     * @since 0.1.0
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        Logger $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * Fetches data.
     *
     * @return void
     * @since 0.1.0
     */
    public function loadData()
    {

    }
}

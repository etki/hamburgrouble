<?php

namespace Etki\Projects\Hamburgrouble\DaemonBundle\Service\Scheduler;

/**
 *
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Projects\Hamburgrouble\DaemonBundle\Service\Scheduler
 * @author  Etki <etki@etki.name>
 */
interface TaskInterface
{
    /**
     * Executes task.
     *
     * @return void
     * @since 0.1.0
     */
    public function execute();
}

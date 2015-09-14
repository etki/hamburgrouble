<?php

namespace Etki\Projects\Hamburgrouble\DaemonBundle\Service\Scheduler;

/**
 *
 *
 * @version 0.1.0
 * @since
 * @package Etki\Projects\Hamburgrouble\DaemonBundle\Service\Scheduler
 * @author  Etki <etki@etki.name>
 */
interface ExecutionTimeProvidingTaskInterface extends TaskInterface
{
    /**
     * Returns timestamp of next execution.
     *
     * @return int
     * @since 0.1.0
     */
    public function getExecutionTime();
}

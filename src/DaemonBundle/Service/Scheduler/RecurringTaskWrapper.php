<?php

namespace Etki\Projects\Hamburgrouble\DaemonBundle\Service\Scheduler;

/**
 * Simple wrapper that adds recurring capability to tasks.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Projects\Hamburgrouble\DaemonBundle\Service\Scheduler
 * @author  Etki <etki@etki.name>
 */
class RecurringTaskWrapper implements
    RecurringExecutionTimeProvidingTaskInterface
{
    /**
     * Task instance.
     *
     * @type TaskInterface
     * @since 0.1.0
     */
    private $task;
    /**
     * Execution interval.
     *
     * @type integer
     * @since 0.1.0
     */
    private $interval;
    /**
     * Next execution time,
     *
     * @type integer
     * @since 0.1.0
     */
    private $nextExecution;

    /**
     * RecurringTaskWrapper constructor.
     *
     * @param TaskInterface $task          Wrapped task.
     * @param int           $interval      Recurrency interval.
     * @param int           $nextExecution Next execution timestamp.
     *
     * @since 0.1.0
     */
    public function __construct(
        TaskInterface $task,
        $interval,
        $nextExecution = null
    ) {
        $this->task = $task;
        $this->interval = $interval;
        $this->nextExecution = $nextExecution ?: time();
    }

    /**
     * Returns next execution time.
     *
     * @return int
     * @since 0.1.0
     */
    public function getExecutionTime()
    {
        return $this->nextExecution;
    }

    /**
     * Executes task.
     *
     * @return void
     * @since 0.1.0
     */
    public function execute()
    {
        $this->task->execute();
        while ($this->nextExecution <= floor(time())) {
            $this->nextExecution += $this->interval;
        }
    }

    /**
     * Creates string representation of instance.
     *
     * @return string
     * @since 0.1.0
     */
    public function __toString()
    {
        if (method_exists($this->task, '__toString')) {
            // safe by design
            /** @noinspection ImplicitMagicMethodCallInspection */
            $taskDefinition = $this->task->__toString();
        } else {
            $taskDefinition = get_class($this->task);
        }
        return sprintf('RecurringTaskWrapper [%s]', $taskDefinition);
    }
}

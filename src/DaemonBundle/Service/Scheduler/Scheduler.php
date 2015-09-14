<?php

namespace Etki\Projects\Hamburgrouble\DaemonBundle\Service\Scheduler;

use DateInterval;
use DateTime;
use Psr\Log\LoggerInterface;

/**
 * Scheduler service.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Projects\Hamburgrouble\DaemonBundle\Service
 * @author  Etki <etki@etki.name>
 */
class Scheduler
{
    const PRECISION = 0.5;
    /**
     * Tasks.
     *
     * @type ExecutionTimeProvidingTaskInterface[]
     * @since 0.1.0
     */
    private $tasks = [];
    /**
     * Simple and unreliable task queue.
     *
     * @type ExecutionTimeProvidingTaskInterface[][]
     * @since 0.1.0
     */
    private $queue = [];
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
     * @param LoggerInterface $logger Logger instance.
     *
     * @since 0.1.0
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Starts scheduler.
     *
     * @return void
     * @since 0.1.0
     */
    public function run()
    {
        $this->logger->info('Running scheduler');
        $this->buildQueue();
        if (!count($this->queue)) {
            $this->logger->warning(
                'Scheduler doesn\'t have any tasks in queue, halting'
            );
            return;
        }
        $nextExecution = min(array_keys($this->queue));
        if ($nextExecution > time()) {
            $this->logger->info(
                'Waiting for next execution on `{timestamp}`...',
                ['timestamp' => $nextExecution,]
            );
            $this->waitUntil($nextExecution);
        } else {
            $this->logger->info('Starting run immediately');
        }
        $this->loop();
        $this->logger->info('Scheduler has finished it\'s run');
    }

    /**
     * Adds new recurrent task.
     *
     * @param TaskInterface $task         Task to execute.
     * @param DateInterval  $dateInterval Interval to recurrently execute task.
     *
     * @return void
     * @since 0.1.0
     */
    public function addRecurrentTask(
        TaskInterface $task,
        DateInterval $dateInterval
    ) {
        // OH PLEASE PHP FOR FUCKS SAKE
        $interval = (new DateTime)
            ->setTimestamp(0)
            ->add($dateInterval)
            ->getTimestamp();
        $this->tasks[] = new RecurringTaskWrapper($task, $interval);
    }

    /**
     * Performs loop.
     *
     * @return void
     * @since 0.1.0
     */
    private function loop()
    {
        while (count($this->queue)) {
            $this->executeQueue();
            $this->buildQueue();
            // yes, i don't believe it's sorted!
            $nextExecution = min(array_keys($this->queue));
            if ($nextExecution > time()) {
                $this->waitUntil($nextExecution);
            }
        }
    }

    /**
     * Executes queue of commands.
     *
     * @return void
     * @since 0.1.0
     */
    private function executeQueue()
    {
        $this->logger->info(
            'Processing queue, {count} tasks waiting',
            ['count' => count($this->queue),]
        );
        foreach ($this->queue as $timestamp => $tasks) {
            $this->logger->info(
                'Analyzing tasks for timestamp {timestamp}',
                ['timestamp' => $timestamp,]
            );
            if ($timestamp > time()) {
                $this->logger->info(
                    'Timestamp {timestamp} is bigger than current time, ' .
                    'halting',
                    ['timestamp' => $timestamp,]
                );
                break;
            }
            foreach ($tasks as $task) {
                $context = ['task' => $task,];
                $this->logger->info('Executing task {task}', $context);
                $task->execute();
                $this->logger->info('Done executing task {task}', $context);
            }
            unset($this->queue[$timestamp]);
            $this->logger->info('Processed queue');
        }
    }

    /**
     * Builds execution queue. Theoretically may grow incredibly big queue.
     * Behold.
     *
     * @return void
     * @since 0.1.0
     */
    private function buildQueue()
    {
        foreach ($this->tasks as $task) {
            $timestamp = $task->getExecutionTime();
            if (!array_key_exists($timestamp, $this->queue)) {
                $this->queue[$timestamp] = [];
            }
            $this->queue[$timestamp][] = $task;
        }
        ksort($this->queue);
    }

    /**
     * Delays execution until specified timestamp.
     *
     * @param int $timestamp Timestamp to wake at.
     *
     * @return void
     * @since 0.1.0
     */
    private function waitUntil($timestamp)
    {
        $this->logger->info(
            'Received request for sleep until `{timestamp}` (current: ' .
            '`{current}`)',
            ['timestamp' => $timestamp, 'current' => microtime(true),]
        );
        $difference = $timestamp - microtime(true);
        if ($difference < 0) {
            $this->logger->error(
                '{class}::waitUntil() called with a timestamp already in ' .
                'the past ({timestamp}), halting',
                [
                    'class' => get_class(),
                    'timestamp' => $timestamp
                ]
            );
            return;
        }
        $this->logger->info(
            'Sleeping for {difference} seconds',
            ['difference' => $difference,]
        );
        usleep($difference * 1000 * 1000);
        $this->logger->info(
            'Done sleeping, expected wake time: `{expected}`, real wake ' .
            'time: `{real}`',
            [
                'expected' => $timestamp,
                'real' => microtime(true) / (1000 * 1000),
            ]
        );
    }
}

<?php
/**
 * Scheduled Events
 *
 * @package SlzBot
 * @subpackage IRC
 * @author Eric Salerno
 *
 */
namespace SlzBot\IRC\Events;

class ScheduledEvent
{
    /**
     * @var integer
     */
    private $delay = 0;

    /**
     * @var integer
     */
    private $timeout = 1000;

    /**
     * @var EventInterface
     */
    private $event = null;

    /**
     * @var integer
     */
    private $lastOccurred = 0;

    /**
     * @var array
     */
    private $parameters = [];

    /**
     * ScheduledEvent constructor.
     * @param $timeout
     * @param EventInterface $event
     * @param int $delay
     */
    public function __construct($timeout, EventInterface $event, $delay = 0, $parameters = [])
    {
        $this->timeout = $timeout;

        $this->event = $event;

        $this->delay = $delay;

        $this->parameters = $parameters;
    }

    /**
     * Tick and get the event if it's ready to go
     *
     * @return null|EventInterface
     */
    public function tickAndGetEventIfReady()
    {
        if (!empty($this->delay))
        {
            $this->lastOccurred = microtime(true) + $this->delay;
            $this->delay = false;
            return null;
        }

        if (empty($this->lastOccurred))
        {
            $this->lastOccurred = microtime(true);
            return $this->event;
        }

        $timeSince = (microtime(true) - $this->lastOccurred) * 1000;

        if ($timeSince >= $this->timeout)
        {
            $this->lastOccurred = microtime(true);
            return $this->event;
        }

        return null;
    }

    /**
     * Get parameters
     *
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }
}
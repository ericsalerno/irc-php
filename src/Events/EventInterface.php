<?php
/**
 * Interface for adding an event to the system
 *
 * @package SlzBot
 * @subpackage IRC
 * @author Eric Salerno
 */
namespace SlzBot\IRC\Events;

interface EventInterface
{
    /**
     * Execute the event
     *
     * @param \SlzBot\IRC\Bot $bot
     * @param array $parameters
     * @return mixed
     */
    public function execute(\SlzBot\IRC\Bot $bot, $parameters = []);
}
<?php
/**
 * Interface for adding an event to the system
 *
 * @package EricSalerno
 * @subpackage IRC
 * @author Eric Salerno
 */
namespace EricSalerno\IRC\Events;

interface EventInterface
{
    /**
     * Execute the event
     *
     * @param \EricSalerno\IRC\Bot $bot
     * @param array $parameters
     * @return mixed
     */
    public function execute(\EricSalerno\IRC\Bot $bot, $parameters = []);
}
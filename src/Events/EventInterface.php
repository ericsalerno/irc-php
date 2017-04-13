<?php
/**
 * Interface for adding an event to the system
 *
 * @package SalernoLabs
 * @subpackage IRC
 * @author Eric Salerno
 */
namespace SalernoLabs\IRC\Events;

interface EventInterface
{
    /**
     * Execute the event
     *
     * @param \SalernoLabs\IRC\Bot $bot
     * @param array $parameters
     * @return mixed
     */
    public function execute(\SalernoLabs\IRC\Bot $bot, $parameters = []);
}
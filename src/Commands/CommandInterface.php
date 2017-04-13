<?php
/**
 * Command Interface for Adding Commands to the Bot
 *
 * @package SalernoLabs
 * @subpackage IRC
 * @author Eric Salerno
 */
namespace SalernoLabs\IRC\Commands;

interface CommandInterface
{
    /**
     * Execute the command
     *
     * @param \SalernoLabs\IRC\Bot $bot
     * @param \SalernoLabs\IRC\User $user
     * @param $channel
     * @param $parameters
     * @return mixed
     */
    public function execute(\SalernoLabs\IRC\Bot $bot, \SalernoLabs\IRC\User $user, $channel, $parameters);
}
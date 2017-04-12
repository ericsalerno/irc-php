<?php
/**
 * Command Interface for Adding Commands to the Bot
 *
 * @package EricSalerno
 * @subpackage IRC
 * @author Eric Salerno
 */
namespace EricSalerno\IRC\Commands;

interface CommandInterface
{
    /**
     * Execute the command
     *
     * @param \EricSalerno\IRC\Bot $bot
     * @param \EricSalerno\IRC\User $user
     * @param $channel
     * @param $parameters
     * @return mixed
     */
    public function execute(\EricSalerno\IRC\Bot $bot, \EricSalerno\IRC\User $user, $channel, $parameters);
}
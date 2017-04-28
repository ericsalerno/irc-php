<?php
/**
 * Command Interface for Adding Commands to the Bot
 *
 * @package SlzBot
 * @subpackage IRC
 * @author Eric Salerno
 */
namespace SlzBot\IRC\Commands;

interface CommandInterface
{
    /**
     * Execute the command
     *
     * @param \SlzBot\IRC\Bot $bot
     * @param \SlzBot\IRC\User $user
     * @param $channel
     * @param $parameters
     * @return mixed
     */
    public function execute(\SlzBot\IRC\Bot $bot, \SlzBot\IRC\User $user, $channel, $parameters);
}
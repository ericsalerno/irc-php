<?php
/**
 * Perform the Uptime Command
 *
 * @package EricSalerno
 * @subpackage IRC
 * @author Eric
 */
namespace EricSalerno\IRC\Commands;

class Join implements CommandInterface
{
    /**
     * Perform the command
     *
     * @param \EricSalerno\IRC\Bot $bot
     * @param \EricSalerno\IRC\User $user
     * @param $channel
     * @param $parameters
     */
    public function execute(\EricSalerno\IRC\Bot $bot, \EricSalerno\IRC\User $user, $channel, $parameters)
    {
        $bot->joinChannel($parameters[0]);
    }
}
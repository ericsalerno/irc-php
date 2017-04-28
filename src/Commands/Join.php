<?php
/**
 * Perform the Uptime Command
 *
 * @package SlzBot
 * @subpackage IRC
 * @author Eric
 */
namespace SlzBot\IRC\Commands;

class Join implements CommandInterface
{
    /**
     * Perform the command
     *
     * @param \SlzBot\IRC\Bot $bot
     * @param \SlzBot\IRC\User $user
     * @param $channel
     * @param $parameters
     */
    public function execute(\SlzBot\IRC\Bot $bot, \SlzBot\IRC\User $user, $channel, $parameters)
    {
        $bot->joinChannel($parameters[0]);
    }
}
<?php
/**
 * Perform the Uptime Command
 *
 * @package SalernoLabs
 * @subpackage IRC
 * @author Eric
 */
namespace SalernoLabs\IRC\Commands;

class Join implements CommandInterface
{
    /**
     * Perform the command
     *
     * @param \SalernoLabs\IRC\Bot $bot
     * @param \SalernoLabs\IRC\User $user
     * @param $channel
     * @param $parameters
     */
    public function execute(\SalernoLabs\IRC\Bot $bot, \SalernoLabs\IRC\User $user, $channel, $parameters)
    {
        $bot->joinChannel($parameters[0]);
    }
}
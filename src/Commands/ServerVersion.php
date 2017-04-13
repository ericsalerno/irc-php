<?php
/**
 * Perform the Server Version Command. It occurs to me that !sv probably doesn't mean "ServerVersion" but whatevs.
 *
 * @package SalernoLabs
 * @subpackage IRC
 * @author Eric
 */
namespace SalernoLabs\IRC\Commands;

class ServerVersion implements CommandInterface
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
        $bot->sendMessage("I'm an instance of salernolabs/slzbot-irc, fork me on github https://github.com/ericsalerno/slzbot-irc", $channel);
    }
}
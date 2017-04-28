<?php
/**
 * Perform the Server Version Command. It occurs to me that !sv probably doesn't mean "ServerVersion" but whatevs.
 *
 * @package SlzBot
 * @subpackage IRC
 * @author Eric
 */
namespace SlzBot\IRC\Commands;

class ServerVersion implements CommandInterface
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
        $bot->sendMessage("I'm an instance of salernolabs/slzbot-irc, fork me on github https://github.com/ericsalerno/slzbot-irc", $channel);
    }
}
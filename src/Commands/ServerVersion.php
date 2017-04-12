<?php
/**
 * Perform the Server Version Command
 *
 * @package EricSalerno
 * @subpackage IRC
 * @author Eric
 */
namespace EricSalerno\IRC\Commands;

class ServerVersion implements CommandInterface
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
        $bot->sendMessage("I'm running version IDUNNO.WUT of ericsalerno/irc-php!", $channel);
    }
}
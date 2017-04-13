<?php
/**
 * Perform the Server Version Command
 *
 * @package EricSalerno
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
        $bot->sendMessage("I'm running version IDUNNO.WUT of ericsalerno/irc-php!", $channel);
    }
}
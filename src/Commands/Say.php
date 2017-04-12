<?php
/**
 * Perform the Uptime Command
 *
 * @package EricSalerno
 * @subpackage IRC
 * @author Eric
 */
namespace EricSalerno\IRC\Commands;

class Say implements CommandInterface
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
        if ($parameters[0][0] == '#')
        {
            $channel = $parameters[0];

            unset($parameters[0]);
        }

        $bot->sendMessage(implode(' ', $parameters), $channel);
    }
}
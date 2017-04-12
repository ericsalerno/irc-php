<?php
/**
 * Perform the Uptime Command
 *
 * @package EricSalerno
 * @subpackage IRC
 * @author Eric
 */
namespace EricSalerno\IRC\Commands;

class Quit implements CommandInterface
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
        $bot->quit(implode(' ', $parameters));
    }
}
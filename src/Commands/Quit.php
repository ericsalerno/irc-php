<?php
/**
 * Perform the Uptime Command
 *
 * @package EricSalerno
 * @subpackage IRC
 * @author Eric
 */
namespace SalernoLabs\IRC\Commands;

class Quit implements CommandInterface
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
        $bot->quit(implode(' ', $parameters));
    }
}
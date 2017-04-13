<?php
/**
 * Perform the Uptime Command
 *
 * @package SalernoLabs
 * @subpackage IRC
 * @author Eric
 */
namespace SalernoLabs\IRC\Commands;

class Uptime implements CommandInterface
{
    /**
     * @var float
     */
    private $startTime;

    /**
     * Uptime constructor.
     */
    public function __construct()
    {
        $this->startTime = microtime(true);
    }

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
        $bot->sendMessage(
            $user->nickName . ", I've been online for " . (microtime(true) - $this->startTime) . " seconds.",
            $channel
        );
    }
}
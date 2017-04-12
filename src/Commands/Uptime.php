<?php
/**
 * Perform the Uptime Command
 *
 * @package EricSalerno
 * @subpackage IRC
 * @author Eric
 */
namespace EricSalerno\IRC\Commands;

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
     * @param \EricSalerno\IRC\Bot $bot
     * @param \EricSalerno\IRC\User $user
     * @param $channel
     * @param $parameters
     */
    public function execute(\EricSalerno\IRC\Bot $bot, \EricSalerno\IRC\User $user, $channel, $parameters)
    {
        $bot->sendMessage(
            $user->nickName . ", I've been online for " . (microtime(true) - $this->startTime) . " seconds.",
            $channel
        );
    }
}
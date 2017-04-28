<?php
/**
 * Perform the Uptime Command
 *
 * @package SlzBot
 * @subpackage IRC
 * @author Eric
 */
namespace SlzBot\IRC\Commands;

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
     * @param \SlzBot\IRC\Bot $bot
     * @param \SlzBot\IRC\User $user
     * @param $channel
     * @param $parameters
     */
    public function execute(\SlzBot\IRC\Bot $bot, \SlzBot\IRC\User $user, $channel, $parameters)
    {
        $bot->sendMessage(
            $user->nickName . ", I've been online for " . (microtime(true) - $this->startTime) . " seconds.",
            $channel
        );
    }
}
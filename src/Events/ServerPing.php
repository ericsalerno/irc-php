<?php
/**
 * Server Ping Event
 *
 * @package SlzBot
 * @subpackage IRC
 * @author Eric Salerno
 */
namespace SlzBot\IRC\Events;

class ServerPing implements EventInterface
{
    /**
     * @param \SlzBot\IRC\Bot $bot
     * @param array $parameters
     */
    public function execute(\SlzBot\IRC\Bot $bot, $parameters = [])
    {
        $bot->sendRawCommand('PONG', $parameters);
    }
}
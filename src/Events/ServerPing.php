<?php
/**
 * Server Ping Event
 *
 * @package EricSalerno
 * @subpackage IRC
 * @author Eric Salerno
 */
namespace EricSalerno\IRC\Events;

class ServerPing implements EventInterface
{
    /**
     * @param \EricSalerno\IRC\Bot $bot
     * @param array $parameters
     */
    public function execute(\EricSalerno\IRC\Bot $bot, $parameters = [])
    {
        $bot->sendRawCommand('PONG', $parameters);
    }
}
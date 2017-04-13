<?php
/**
 * Server Ping Event
 *
 * @package EricSalerno
 * @subpackage IRC
 * @author Eric Salerno
 */
namespace SalernoLabs\IRC\Events;

class ServerPing implements EventInterface
{
    /**
     * @param \SalernoLabs\IRC\Bot $bot
     * @param array $parameters
     */
    public function execute(\SalernoLabs\IRC\Bot $bot, $parameters = [])
    {
        $bot->sendRawCommand('PONG', $parameters);
    }
}
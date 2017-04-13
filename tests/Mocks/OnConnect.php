<?php
/**
 * On Join Event
 */
namespace SalernoLabs\Tests\IRC\Mocks;

class OnConnect implements \SalernoLabs\IRC\Events\EventInterface
{
    /**
     * Send a test message
     *
     * @param \SalernoLabs\IRC\Bot $bot
     * @param array $parameters
     */
    public function execute(\SalernoLabs\IRC\Bot $bot, $parameters = [])
    {
        $bot->sendMessage('Super Test Message', '#phpirc');
    }
}
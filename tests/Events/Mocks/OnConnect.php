<?php
/**
 * On Join Event
 *
 * @package SalernoLabs
 * @subpackage Tests
 * @author Eric Salerno
 */
namespace SalernoLabs\Tests\IRC\Events\Mocks;

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
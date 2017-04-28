<?php
/**
 * On Join Event
 *
 * @package SlzBot
 * @subpackage Tests
 * @author Eric Salerno
 */
namespace SlzBot\Tests\IRC\Events\Mocks;

class OnConnect implements \SlzBot\IRC\Events\EventInterface
{
    /**
     * Send a test message
     *
     * @param \SlzBot\IRC\Bot $bot
     * @param array $parameters
     */
    public function execute(\SlzBot\IRC\Bot $bot, $parameters = [])
    {
        $bot->sendMessage('Super Test Message', '#phpirc');
    }
}
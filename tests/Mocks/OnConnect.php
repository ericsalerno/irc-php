<?php
/**
 * On Join Event
 */
namespace SalernoLabs\Tests\IRC\Mocks;

class OnConnect implements \SalernoLabs\IRC\Events\EventInterface
{
    public function execute(\SalernoLabs\IRC\Bot $bot, $parameters = [])
    {
        $bot->sendMessage('Super Test Message', '#phpirc');
    }
}
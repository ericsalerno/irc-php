<?php
/**
 * Test Command
 *
 * @package SalernoLabs
 * @subpackage Tests
 * @author Eric Salerno
 */
namespace SalernoLabs\Tests\IRC\Mocks;

class TestCommand implements \SalernoLabs\IRC\Commands\CommandInterface
{
    /**
     * Send a test message
     *
     * @param \SalernoLabs\IRC\Bot $bot
     * @param array $parameters
     */
    public function execute(\SalernoLabs\IRC\Bot $bot, \SalernoLabs\IRC\User $user, $channel, $parameters)
    {
        $bot->sendMessage('Hello ' . $user->nickName . ' this is a test message!', '#phpirc');
    }
}
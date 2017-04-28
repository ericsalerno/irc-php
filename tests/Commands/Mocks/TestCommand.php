<?php
/**
 * Test Command
 *
 * @package SlzBot
 * @subpackage Tests
 * @author Eric Salerno
 */
namespace SlzBot\Tests\IRC\Commands\Mocks;

class TestCommand implements \SlzBot\IRC\Commands\CommandInterface
{
    /**
     * Send a test message
     *
     * @param \SlzBot\IRC\Bot $bot
     * @param array $parameters
     */
    public function execute(\SlzBot\IRC\Bot $bot, \SlzBot\IRC\User $user, $channel, $parameters)
    {
        $bot->sendMessage('Hello ' . $user->nickName . ' this is a test message!', '#phpirc');
    }
}
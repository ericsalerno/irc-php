<?php
/**
 * Server Ping Tests
 *
 * @package SlzBot
 * @subpackage Tests
 * @author Eric Salerno
 */
namespace SlzBot\Tests\IRC\Events;

class ServerPingTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws \Exception
     * @covers \SlzBot\IRC\Bot::addOpCodeEvent
     * @covers \SlzBot\IRC\Events\AutoJoin::execute
     * @covers \SlzBot\IRC\Bot::executeEvent
     */
    public function testBotAutojoin()
    {
        $bot = new \SlzBot\IRC\Bot();
        $bot
            ->setUser('testUser', 'sausage')
            ->setServer('file://' . __DIR__ . '/../../tests/data/test-server-ping.txt', 6667)
            ->setDebug(true);

        $this->expectOutputRegex('#PONG :localhost#');

        $bot->connect();
    }

}
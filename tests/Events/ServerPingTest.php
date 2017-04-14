<?php
/**
 * Server Ping Tests
 *
 * @package SalernoLabs
 * @subpackage Tests
 * @author Eric Salerno
 */
namespace SalernoLabs\Tests\IRC\Events;

class ServerPingTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws \Exception
     * @covers \SalernoLabs\IRC\Bot::addOpCodeEvent
     * @covers \SalernoLabs\IRC\Events\AutoJoin::execute
     * @covers \SalernoLabs\IRC\Bot::executeEvent
     */
    public function testBotAutojoin()
    {
        $bot = new \SalernoLabs\IRC\Bot();
        $bot
            ->setUser('testUser', 'sausage')
            ->setServer('file://' . __DIR__ . '/../../tests/data/test-server-ping.txt', 6667)
            ->setDebug(true);

        $this->expectOutputRegex('#PONG :localhost#');

        $bot->connect();
    }

}
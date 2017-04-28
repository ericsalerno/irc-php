<?php
/**
 * MOTD Tests
 *
 * @package SlzBot
 * @subpackage Tests
 * @author Eric Salerno
 */
namespace SlzBot\Tests\IRC\Events;

class MOTDTest extends \PHPUnit\Framework\TestCase
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
            ->setServer('file://' . __DIR__ . '/../../tests/data/test-server.txt', 6667)
            ->addOpCodeEvent(\SlzBot\IRC\OpCodes::IRC_END_OF_MOTD, new \SlzBot\Tests\IRC\Events\Mocks\OnConnect())
            ->setDebug(true);

        $this->expectOutputRegex('#PRIVMSG \#phpirc :Super Test Message#');

        $bot->connect();
    }

}
<?php
/**
 * MOTD Tests
 *
 * @package SalernoLabs
 * @subpackage Tests
 * @author Eric Salerno
 */
namespace SalernoLabs\Tests\IRC\Events;

class MOTDTest extends \PHPUnit\Framework\TestCase
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
            ->setServer('file://' . __DIR__ . '/../../tests/data/test-server.txt', 6667)
            ->addOpCodeEvent(\SalernoLabs\IRC\OpCodes::IRC_END_OF_MOTD, new \SalernoLabs\Tests\IRC\Events\Mocks\OnConnect())
            ->setDebug(true);

        $this->expectOutputRegex('#PRIVMSG \#phpirc :Super Test Message#');

        $bot->connect();
    }

}
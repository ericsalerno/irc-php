<?php
/**
 * Uptime Test
 *
 * @package SlzBot
 * @subpackage Tests
 * @author Eric
 */
namespace SlzBot\Tests\IRC\Commands;

class SayTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param $nickName
     * @param $realName
     * @throws \Exception
     * @covers \SlzBot\IRC\Bot::addOpCodeEvent
     * @covers \SlzBot\IRC\Events\AutoJoin::execute
     * @covers \SlzBot\IRC\Bot::executeEvent
     */
    public function testBotCommands()
    {
        $bot = new \SlzBot\IRC\Bot();
        $bot
            ->setUser('testUser', 'sausage')
            ->setServer('file://' . __DIR__ . '/../../tests/data/commands/say.txt', 6667)
            ->addCommand('say', new \SlzBot\IRC\Commands\Say())
            ->setDebug(true);

        $this->expectOutputRegex('/PRIVMSG superman :hello world/');

        $bot->connect();
    }
}
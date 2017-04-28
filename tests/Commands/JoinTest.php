<?php
/**
 * Uptime Test
 *
 * @package SlzBot
 * @subpackage Tests
 * @author Eric
 */
namespace SlzBot\Tests\IRC\Commands;

class JoinTest extends \PHPUnit\Framework\TestCase
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
            ->setServer('file://' . __DIR__ . '/../../tests/data/commands/join.txt', 6667)
            ->addCommand('join', new \SlzBot\IRC\Commands\Join())
            ->setDebug(true);

        $this->expectOutputRegex('/JOIN #test-channel/');

        $bot->connect();
    }
}
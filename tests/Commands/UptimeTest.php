<?php
/**
 * Uptime Test
 *
 * @package SlzBot
 * @subpackage Tests
 * @author Eric
 */
namespace SlzBot\Tests\IRC\Commands;

class UptimeTest extends \PHPUnit\Framework\TestCase
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
            ->setServer('file://' . __DIR__ . '/../../tests/data/commands/uptime.txt', 6667)
            ->addCommand('uptime', new \SlzBot\IRC\Commands\Uptime())
            ->setDebug(true);

        $this->expectOutputRegex("/I've been online for [0-9.]+ seconds./");

        $bot->connect();
    }
}
<?php
/**
 * Uptime Test
 *
 * @package SalernoLabs
 * @subpackage Tests
 * @author Eric
 */
namespace SalernoLabs\Tests\IRC\Commands;

class UptimeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param $nickName
     * @param $realName
     * @throws \Exception
     * @covers \SalernoLabs\IRC\Bot::addOpCodeEvent
     * @covers \SalernoLabs\IRC\Events\AutoJoin::execute
     * @covers \SalernoLabs\IRC\Bot::executeEvent
     */
    public function testBotCommands()
    {
        $bot = new \SalernoLabs\IRC\Bot();
        $bot
            ->setUser('testUser', 'sausage')
            ->setServer('file://' . __DIR__ . '/../../tests/data/commands/uptime.txt', 6667)
            ->addCommand('uptime', new \SalernoLabs\IRC\Commands\Uptime())
            ->setDebug(true);

        $this->expectOutputRegex("/I've been online for [0-9.]+ seconds./");

        $bot->connect();
    }
}
<?php
/**
 * Uptime Test
 *
 * @package SalernoLabs
 * @subpackage Tests
 * @author Eric
 */
namespace SalernoLabs\Tests\IRC\Commands;

class SayTest extends \PHPUnit\Framework\TestCase
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
            ->setServer('file://' . __DIR__ . '/../../tests/data/commands/say.txt', 6667)
            ->addCommand('say', new \SalernoLabs\IRC\Commands\Say())
            ->setDebug(true);

        $this->expectOutputRegex('/PRIVMSG superman :hello world/');

        $bot->connect();
    }
}
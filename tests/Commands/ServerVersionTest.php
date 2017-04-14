<?php
/**
 * Uptime Test
 *
 * @package SalernoLabs
 * @subpackage Tests
 * @author Eric
 */
namespace SalernoLabs\Tests\IRC\Commands;

class ServerVersionTest extends \PHPUnit\Framework\TestCase
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
            ->setServer('file://' . __DIR__ . '/../../tests/data/commands/server-version.txt', 6667)
            ->addCommand('sv', new \SalernoLabs\IRC\Commands\ServerVersion())
            ->setDebug(true);

        $this->expectOutputRegex('/fork me on github/');

        $bot->connect();
    }
}
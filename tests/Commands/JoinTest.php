<?php
/**
 * Uptime Test
 *
 * @package SalernoLabs
 * @subpackage Tests
 * @author Eric
 */
namespace SalernoLabs\Tests\IRC\Commands;

class JoinTest extends \PHPUnit\Framework\TestCase
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
            ->setServer('file://' . __DIR__ . '/../../tests/data/commands/join.txt', 6667)
            ->addCommand('join', new \SalernoLabs\IRC\Commands\Join())
            ->setDebug(true);

        $this->expectOutputRegex('/JOIN #test-channel/');

        $bot->connect();
    }
}
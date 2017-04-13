<?php
/**
 * Bot Tests
 *
 * @package SalernoLabs
 * @subpackage Tests
 * @author Eric Salerno
 */
namespace SalernoLabs\Tests\IRC;

class BotTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test the creation of a bot, connection to a server (local text file), and the commands being run against it
     *
     * @throws \Exception
     * @covers \SalernoLabs\IRC\Bot::setServer
     * @covers \SalernoLabs\IRC\Bot::setDebug
     * @covers \SalernoLabs\IRC\Bot::connect
     */
    public function testBotConnect()
    {
        $bot = new \SalernoLabs\IRC\Bot();
        $bot
            ->setUser('testUser', 'sausage')
            ->setServer('file://' . __DIR__ . '/../tests/data/test-server.txt', 6667)
            ->setDebug(true);

        $this->expectOutputRegex('#Connected!#');
        $this->expectOutputRegex('#Disconnected!#');

        $bot->connect();
    }

    /**
     * @param $nickName
     * @param $realName
     * @throws \Exception
     * @dataProvider dataProviderTestBotUser
     * @covers \SalernoLabs\IRC\Bot::setUser
     */
    public function testBotUser($nickName, $realName)
    {
        $bot = new \SalernoLabs\IRC\Bot();
        $bot
            ->setUser($nickName, $realName)
            ->setServer('file://' . __DIR__ . '/../tests/data/test-server.txt', 6667)
            ->setDebug(true);

        $this->expectOutputRegex('#USER ' . $nickName . ' PHPIRCBot ' . $nickName . ' :' . $realName . '#');
        $this->expectOutputRegex('#NICK ' . $nickName . '#');

        $bot->connect();
    }

    /**
     * Data provider for test bot user
     *
     * @return array
     */
    public function dataProviderTestBotUser()
    {
        $output = [];

        for($i=0;$i<10;++$i)
        {
            $testCase = ['user'.$i, 'Real Name ' . $i];
            $output[] = $testCase;
        }

        return $output;
    }


    /**
     * @param $nickName
     * @param $realName
     * @throws \Exception
     * @covers \SalernoLabs\IRC\Bot::addOpCodeEvent
     * @covers \SalernoLabs\IRC\Events\AutoJoin::execute
     * @covers \SalernoLabs\IRC\Bot::executeEvent
     * @dataProvider dataProviderTestBotAutojoin
     */
    public function testBotAutojoin($channel)
    {
        $autoJoins = new \SalernoLabs\IRC\Events\AutoJoin();
        $autoJoins->setAutoJoins($channel);

        $bot = new \SalernoLabs\IRC\Bot();
        $bot
            ->setUser('testUser', 'sausage')
            ->setServer('file://' . __DIR__ . '/../tests/data/test-server.txt', 6667)
            ->addOpCodeEvent(\SalernoLabs\IRC\OpCodes::EVENT_READY, $autoJoins)
            ->setDebug(true);

        $this->expectOutputRegex('/JOIN ' . $channel . '/');

        $bot->connect();
    }

    /**
     * Data provider for test bot user
     *
     * @return array
     */
    public function dataProviderTestBotAutojoin()
    {
        $output = [];

        for($i=0;$i<10;++$i)
        {
            $testCase = ['#Some ChannELL! ' . $i];
            $output[] = $testCase;
        }

        return $output;
    }
}
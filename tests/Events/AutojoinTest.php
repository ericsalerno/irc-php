<?php
/**
 * Autojoin Tests
 *
 * @package SlzBot
 * @subpackage Tests
 * @author Eric Salerno
 */
namespace SlzBot\Tests\IRC\Events;

class AutojoinTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param $channels
     * @throws \Exception
     * @covers \SlzBot\IRC\Bot::addOpCodeEvent
     * @covers \SlzBot\IRC\Events\AutoJoin::execute
     * @covers \SlzBot\IRC\Bot::executeEvent
     * @dataProvider dataProviderTestBotAutojoin
     */
    public function testBotAutojoin($channels)
    {
        $autoJoins = new \SlzBot\IRC\Events\AutoJoin();
        $autoJoins->setAutoJoins($channels);

        $bot = new \SlzBot\IRC\Bot();
        $bot
            ->setUser('testUser', 'sausage')
            ->setServer('file://' . __DIR__ . '/../../tests/data/test-server.txt', 6667)
            ->addOpCodeEvent(\SlzBot\IRC\OpCodes::EVENT_READY, $autoJoins)
            ->setDebug(true);

        foreach ($channels as $testChannel)
        {
            $this->expectOutputRegex('/JOIN ' . $testChannel . '/');
        }

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
            $testCase = [];
            $testCase[0] = [];

            for ($j=0;$j<$i+1;++$j)
            {
                $testCase[0][] = '#channel-' . $j;
            }

            $output[] = $testCase;
        }

        return $output;
    }
}
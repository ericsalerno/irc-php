<?php
/**
 * Autojoin Tests
 *
 * @package SalernoLabs
 * @subpackage Tests
 * @author Eric Salerno
 */
namespace SalernoLabs\Tests\IRC\Events;

class AutojoinTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param $channels
     * @throws \Exception
     * @covers \SalernoLabs\IRC\Bot::addOpCodeEvent
     * @covers \SalernoLabs\IRC\Events\AutoJoin::execute
     * @covers \SalernoLabs\IRC\Bot::executeEvent
     * @dataProvider dataProviderTestBotAutojoin
     */
    public function testBotAutojoin($channels)
    {
        $autoJoins = new \SalernoLabs\IRC\Events\AutoJoin();
        $autoJoins->setAutoJoins($channels);

        $bot = new \SalernoLabs\IRC\Bot();
        $bot
            ->setUser('testUser', 'sausage')
            ->setServer('file://' . __DIR__ . '/../../tests/data/test-server.txt', 6667)
            ->addOpCodeEvent(\SalernoLabs\IRC\OpCodes::EVENT_READY, $autoJoins)
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
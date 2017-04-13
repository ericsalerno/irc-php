<?php
/**
 * Tests for User Class
 *
 * @package SalernoLabs
 * @subpackage Tests
 * @author Eric Salerno
 */
namespace SalernoLabs\Tests\IRC;

class UserTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test user parsing
     *
     * @param $input
     * @param $expected
     * @covers \SalernoLabs\IRC\User::__construct
     * @covers \SalernoLabs\IRC\User::__toString
     * @dataProvider dataProviderTestUserParsing
     */
    public function testUserParsing($input, $expectedNickName, $expectedUserName, $expectedHost, $expectedIdent)
    {
        $user = new \SalernoLabs\IRC\User($input);

        //Test individual pieces
        $this->assertEquals($expectedNickName, $user->nickName);
        $this->assertEquals($expectedUserName, $user->name);
        $this->assertEquals($expectedHost, $user->host);
        $this->assertEquals($expectedIdent, $user->isIdented);

        //Test toString
        $this->assertEquals(str_replace(':', '', $input), (string)$user);
    }

    /**
     * Data provider for the test user parsing function
     *
     * @return array
     */
    public function dataProviderTestUserParsing()
    {
        return [
            ['someone!HeLLO@something.com', 'someone', 'HeLLO', 'something.com', true],
            ['another!~champion@semaphore.net', 'another', 'champion', 'semaphore.net', false],
            [':nick!name@host', 'nick', 'name', 'host', true]
        ];
    }

    /**
     * Test user parsing failures
     *
     * @param $input
     * @expectedException \Exception
     * @dataProvider dataProviderTestUserParsingFailures
     */
    public function testUserParsingFailures($input)
    {
        $user = new \SalernoLabs\IRC\User($input);
    }

    /**
     * Returns invalid data
     */
    public function dataProviderTestUserParsingFailures()
    {
        return [
            [''],
            ['asdfasdfasfdasf'],
            ['@#^%@!#$!DASF'],
            ['~!:ASFD2.ASDF'],
            ['geezer!asdf'],
            ['asdf@asdf.com'],
            ['superman!clark.kent']
        ];
    }
}
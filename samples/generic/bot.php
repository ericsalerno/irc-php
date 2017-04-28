<?php
/**
 * The sample expects some command line arguments and will add all the commands available
 *
 * @package SlzBot
 * @subpackage IRC
 * @author Eric Salerno
 */
require_once(__DIR__ . '/../../vendor/autoload.php');

if (count($argv) < 3)
{
    echo 'Usage: php ' . $argv[0] . ' <nickname> <channel> <server> [port]';
    exit();
}

$nickname = $argv[1];
$channel = $argv[2];
$server = $argv[3];
$port = !empty($argv[4]) ? $argv[4] : 6667;

$autojoin = new \SlzBot\IRC\Events\AutoJoin();
$autojoin->setAutoJoins($channel);

$bot = new \SlzBot\IRC\Bot();

$bot->setUser($nickname, 'SlzBot')
    ->setServer($server, $port)
    ->addOpCodeEvent(\SlzBot\IRC\OpCodes::EVENT_READY, $autojoin)
    ->addCommand('join', new \SlzBot\IRC\Commands\Join())
    ->addCommand('part', new \SlzBot\IRC\Commands\Part())
    ->addCommand('quit', new \SlzBot\IRC\Commands\Quit())
    ->addCommand('say', new \SlzBot\IRC\Commands\Say())
    ->addCommand('hello', new \SlzBot\IRC\Commands\TestColors())
    ->addCommand('uptime', new \SlzBot\IRC\Commands\Uptime())
    ->setDebug(true)
    ->connect();
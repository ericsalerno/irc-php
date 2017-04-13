<?php
/**
 * The sample expects some command line arguments and will add all the commands available
 *
 * @package SalernoLabs
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

$autojoin = new \SalernoLabs\IRC\Events\AutoJoin();
$autojoin->setAutoJoins($channel);

$bot = new \SalernoLabs\IRC\Bot();

$bot->setUser($nickname, 'SlzBot')
    ->setServer($server, $port)
    ->addOpCodeEvent(\SalernoLabs\IRC\OpCodes::EVENT_READY, $autojoin)
    ->addCommand('join', new \SalernoLabs\IRC\Commands\Join())
    ->addCommand('part', new \SalernoLabs\IRC\Commands\Part())
    ->addCommand('quit', new \SalernoLabs\IRC\Commands\Quit())
    ->addCommand('say', new \SalernoLabs\IRC\Commands\Say())
    ->addCommand('hello', new \SalernoLabs\IRC\Commands\TestColors())
    ->addCommand('uptime', new \SalernoLabs\IRC\Commands\Uptime())
    ->setDebug(true)
    ->connect();
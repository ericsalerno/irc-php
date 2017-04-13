<?php

require_once(__DIR__ . '/../../vendor/autoload.php');

$autojoin = new \SalernoLabs\IRC\Events\AutoJoin();
$autojoin->setAutoJoins(['#gamedev']);

$bot = new \SalernoLabs\IRC\Bot();

$bot->setUser('shyguy', 'Real Name')
    ->setServer('irc.somenetwork.org', 6667)
    ->addOpCodeEvent(\SalernoLabs\IRC\OpCodes::EVENT_READY, $autojoin)
    ->setDebug(true)
    ->connect();
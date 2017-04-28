<?php
/**
 * Just an enum for constants of opcodes from the IRC RFC spec
 *
 * @package SlzBot
 * @subpackage IRC
 * @author Eric Salerno
 */
namespace SlzBot\IRC;

class OpCodes
{
    const IRC_END_OF_MOTD = 376;
    const IRC_MOTD_LINE = 375;

    const EVENT_PING = 'PING';
    const EVENT_CONNECTED = 'CONNECT';
    const EVENT_DISCONNECT = 'DISCONNECT';
    const EVENT_PRIVATE_MESSAGE = 'PRIVMSG';
    const EVENT_READY = 'READY';
}
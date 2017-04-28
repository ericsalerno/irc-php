<?php
/**
 * The MOTD Event occurs after the motd has triggered
 *
 * @package SlzBot
 * @subpackage IRC
 * @author Eric Salerno
 *
 */
namespace SlzBot\IRC\Events;

class MOTD implements EventInterface
{
    /**
     * @param \SlzBot\IRC\Bot $bot
     * @param array $parameters
     */
    public function execute(\SlzBot\IRC\Bot $bot, $parameters = [])
    {

    }
}
<?php
/**
 * The MOTD Event occurs after the motd has triggered
 *
 * @package SalernoLabs
 * @subpackage IRC
 * @author Eric Salerno
 *
 */
namespace SalernoLabs\IRC\Events;

class MOTD implements EventInterface
{
    /**
     * @param \SalernoLabs\IRC\Bot $bot
     * @param array $parameters
     */
    public function execute(\SalernoLabs\IRC\Bot $bot, $parameters = [])
    {

    }
}
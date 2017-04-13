<?php
/**
 * Bind this event to OpCodes::EVENT_READY to perform autojoins
 *
 * @package SalernoLabs
 * @subpackage IRC
 * @author Eric Salerno
 *
 */
namespace SalernoLabs\IRC\Events;

class AutoJoin implements EventInterface
{
    /**
     * @var array
     */
    private $autoJoins = [];

    /**
     * Set autojoins
     *
     * @param $autoJoins
     */
    public function setAutoJoins($autoJoins)
    {
        $this->autoJoins = $autoJoins;

        return $this;
    }

    /**
     * @param \SalernoLabs\IRC\Bot $bot
     * @param array $parameters
     */
    public function execute(\SalernoLabs\IRC\Bot $bot, $parameters = [])
    {
        if (!empty($this->autoJoins))
        {
            $bot->joinChannel($this->autoJoins);
        }
    }
}
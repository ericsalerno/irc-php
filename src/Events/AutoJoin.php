<?php
/**
 * Bind this event to OpCodes::EVENT_READY to perform autojoins
 *
 * @package SlzBot
 * @subpackage IRC
 * @author Eric Salerno
 *
 */
namespace SlzBot\IRC\Events;

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
     * @param \SlzBot\IRC\Bot $bot
     * @param array $parameters
     */
    public function execute(\SlzBot\IRC\Bot $bot, $parameters = [])
    {
        if (!empty($this->autoJoins))
        {
            $bot->joinChannel($this->autoJoins);
        }
    }
}
<?php
/**
 * Perform the Test Colors Command
 *
 * @package SlzBot
 * @subpackage IRC
 * @author Eric Salerno
 */
namespace SlzBot\IRC\Commands;

class TestColors implements CommandInterface
{
    /**
     * Perform the command
     *
     * @param \SlzBot\IRC\Bot $bot
     * @param \SlzBot\IRC\User $user
     * @param $channel
     * @param $parameters
     */
    public function execute(\SlzBot\IRC\Bot $bot, \SlzBot\IRC\User $user, $channel, $parameters)
    {
        $text = ['H','e','l','l','o',' ','E','v','e','r','b','o','d','y','!'];

        $output = "";
        $i=0;
        foreach ($text as $letter)
        {
            $output.= $bot->colorText($letter, 0, $i++);
        }

        $bot->sendMessage($output, $channel);
    }
}
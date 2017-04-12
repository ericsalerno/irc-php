<?php
/**
 * Perform the Test Colors Command
 *
 * @package EricSalerno
 * @subpackage IRC
 * @author Eric Salerno
 */
namespace EricSalerno\IRC\Commands;

class TestColors implements CommandInterface
{
    /**
     * Perform the command
     *
     * @param \EricSalerno\IRC\Bot $bot
     * @param \EricSalerno\IRC\User $user
     * @param $channel
     * @param $parameters
     */
    public function execute(\EricSalerno\IRC\Bot $bot, \EricSalerno\IRC\User $user, $channel, $parameters)
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
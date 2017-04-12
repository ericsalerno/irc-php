# irc-php
For fun and practice, I'm throwing together a super simple irc bot.

The idea would be to make an event based Bot class that you can extend to add your own business logic to.

## Usage

You can use the bot by including ericsalerno/irc-php with composer (when its in packagist, not yet) and activating it like this.

    $bot = new \EricSalerno\IRC\Bot();
    
    $bot
        ->setServer('irc.efnet.org', 6667, false)
        ->setChannels('#ircphp')
        ->setUser('ircphpbot', 'IRC PHP')
        ->connect();
        

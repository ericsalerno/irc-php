# slzbot-irc

For fun and practice, I'm throwing together a super simple PHP based irc bot that runs from the command line (or a container).

The idea would be to make an event based Bot class that you can extend to add your own business logic to.

I hope it should go without saying, but __never run this bot as root__!

## Usage

Include the library in your project with composer.

    composer require ericsalerno/slzbot-irc

You can use the bot by including salernolabs/slzbot-irc with composer and activating it like this.

    $bot = new \SlzBot\IRC\Bot();
    
    $bot
        ->setServer('irc.efnet.org', 6667)
        ->setChannels('#ircphp')
        ->setUser('myBotNickname', 'SlzBot')
           //any events and commands you want to bind can go here
        ->connect();
        
## Events

You can bind and respond to events that occur from the server. You can bind multiple event executors to a single event. For example, 376 is the IRC op code for the end of the MOTD. You can bind an event to autojoin channels like this.

    $autoJoins = new \SlzBot\IRC\Events\AutoJoin();
    $autoJoins->setAutoJoins(['#programming', '#irc', '#php']);

    $bot
       ->addOpCodeEvent(376, $autoJoins)

There are some op codes and other events that Slzbot listens for in the \SlzBot\IRC\OpCodes class.

The event class must implement the \SlzBot\IRC\Events\EventInterface interface to work so feel free to create them in your project.

## Commands

You can also bind commands to your bot so that it can listen for user requests. For example if a user types !uptime and you want to listen for that keyword, you can do something like this:

    $command = new \SlzBot\IRC\Commands\Uptime();

    $bot
        ->addCommand('uptime', $command);

This would make the bot listen for users to say "!uptime" and then it would execute the code within the class. In this case it would just say how long it was since the class was instantiated.

The command class must implement the \SlzBot\IRC\Commands\CommandInterface interface to work so feel free to create them in your project. You can also change the activation character from the default of '!' with setCommandActivationCharacter.

## Sample

You can run a quick sample with the included generic bot. From the command line and assuming you are in the project's directory:

    /path/to/php samples/generic/bot.php nickname #channel irc.yourservername

The generic bot expects several parameters. Run it without parameters to get usage info.

    Usage: php samples/generic/bot.php <nickname> <channel> <server> [port]


<?php
/**
 * The main bot class, you can run this directly or extend it and add event handlers.
 *
 * This is meant to be run from the command line.
 * 
 * @package EricSalerno
 * @subpackage IRC
 * @author Eric Salerno
 */
namespace EricSalerno\IRC;

class Bot
{
    /**
     * Number of bytes to read at a time
     */
    const SOCKET_READ_BYTES = 1024;

    /**
     * Number of millisconds to wait between each server data read
     */
    const LOOP_SLEEP_MS = 10;

    /**
     * In case you want to change the class of the User type
     */
    const USER_CLASS_NAME = '\EricSalerno\IRC\User';

    /**
     * Op code to function mapping events
     *
     * @see http://tools.ietf.org/html/rfc1459.html#section-6
     * @var Events\EventInterface[]
     */
    private $opCodeEvents = [];

    /**
     * Command bindings
     *
     * @var Commands\CommandInterface[]
     */
    private $commands = [];

    /**
     * IRC Socket
     *
     * @var resource
     */
    private $socket;

    /**
     * Antiflood Enabled
     *
     * @var boolean
     */
    private $antiFloodEnabled = true;

    /**
     * Anti flood packet count
     *
     * @var integer
     */
    private $antiFloodPacketCount = 3;

    /**
     * ANti flood packet speed
     *
     * @var integer
     */
    private $antiFloodPacketSpeed = 1000;

    /**
     * Anti flood packet gap
     *
     * @var integer
     */
    private $antiFloodPacketGap = 3000;

    /**
     * Activation Character
     *
     * @var string
     */
    private $activationCharacter = '!';

    /**
     * Server name
     *
     * @var string
     */
    private $server = 'irc.efnet.org';

    /**
     * Server port
     *
     * @var integer
     */
    private $port = 6667;

    /**
     * Nickname
     *
     * @var string
     */
    private $nickname = 'PHPIRCBot';

    /**
     * Real name
     *
     * @var string
     */
    private $realName = 'PHP IRC Bot';

    /**
     * Use SSL
     *
     * @var boolean
     */
    private $useSSL = false;

    /**
     * Channels to join on load
     *
     * @var string[]
     */
    private $channels = [];

    /**
     * Debug mode
     *
     * @var boolean
     */
    private $debug = false;

    /**
     * Server password
     *
     * @var string
     */
    private $password = false;

    /**
     * Constructor
     *
     * @param array $configuration
     */
    public function __construct()
    {
        set_time_limit(0);
        ini_set('display_errors', 'on');

        //Add default MOTD event handler
        $this->opCodeEvents[376] = new Events\MOTD();
        $this->opCodeEvents['PING'] = new Events\ServerPing();

        //Add default !sv command handler
        $this->commands['sv'] = new Commands\ServerVersion();
    }

    /**
     * Set up antiflood parameters
     *
     * @param bool $enabled
     * @param int $packetCount
     * @param int $packetGap
     * @param int $packetSpeed
     * @return $this
     */
    public function setAntiFlood($enabled = true, $packetCount = 3, $packetGap = 3000, $packetSpeed = 1000)
    {
        $this->antiFloodEnabled = $enabled;
        $this->antiFloodPacketCount = $packetCount;
        $this->antiFloodPacketGap = $packetGap;
        $this->antiFloodPacketSpeed = $packetSpeed;

        return $this;
    }

    /**
     * Set server information
     *
     * @param $server
     * @param int $port
     * @param bool $ssl
     * @return $this
     */
    public function setServer($server, $port = 6667, $ssl = false)
    {
        $this->server = $server;
        $this->port = $port;
        $this->useSSL = $ssl;

        return $this;
    }

    /**
     * Set user information up
     *
     * @param $nickname
     * @param $realName
     * @param bool $password
     * @return $this
     */
    public function setUser($nickname, $realName, $password = false)
    {
        $this->nickname = $nickname;
        $this->realName = $realName;
        $this->password = $password;

        return $this;
    }

    /**
     * Set debug mode
     *
     * @param $debugMode
     * @return $this
     */
    public function setDebug($debugMode)
    {
        $this->debug = $debugMode;

        return $this;
    }

    /**
     * Set autojoin channels
     *
     * @param array $channels
     * @return $this
     */
    public function setAutojoinChannels($channels = [])
    {
        $this->channels = $channels;

        return $this;
    }

    /**
     * Add op code event
     *
     * @param $opCode
     * @param Events\EventInterface $event
     * @return $this
     * @throws \Exception
     */
    public function addOpCodeEvent($opCode, Events\EventInterface $event)
    {
        if (empty($opCode))
        {
            throw new \Exception("Can not bind empty opcode!");
        }

        $this->opCodeEvents[$opCode] = $event;

        return $this;
    }

    /**
     * Add command
     *
     * @param $commandText
     * @param Commands\CommandInterface $command
     * @throws \Exception
     */
    public function addCommand($commandText, Commands\CommandInterface $command)
    {
        if (empty($commandText))
        {
            throw new \Exception("Can not bind empty command!");
        }

        $this->commands[$commandText] = $command;
    }

    /**
     * Connect and begin running
     */
    public function connect()
    {
        $server = $this->server;

        if ($this->useSSL)
        {
            $server = 'ssl://' . $server;
        }

        $this->debugMessage("Connecting to " . $server . ':' . $this->port . '...');
        $this->socket = @fsockopen($server, $this->port);

        if (empty($this->socket))
        {
            $this->debugMessage("Failed to connect!");
            return;
        }

        $this->debugMessage("Connected! Logging in...");

        $this->sendRawCommand('USER', $this->nickname . ' PHPIRCBot ' . $this->nickname . ' :' . $this->realName);
        $this->sendRawCommand('NICK', $this->nickname);

        do
        {
            $this->mainLoop();

            usleep(static::LOOP_SLEEP_MS * 1000);
        }
        while (!empty($this->socket));
    }

    /**
     * Main server response handler, dispatches each line specifically
     *
     * @param array $config
     */
    private function mainLoop()
    {
        if (feof($this->socket))
        {
            $this->debugMessage("Disconnected!");
            $this->socket = null;

            $this->onServerDisconnect();
            return;
        }

        //Get one line of data of SOCKET_READ_BYTES length
        $data = trim(@fgets($this->socket, static::SOCKET_READ_BYTES));

        $this->debugMessage($data);

        //Flush system output buffer
        flush();

        $serverResponseSegments = explode(' ', $data);

        //First check for ping-pong
        if ($serverResponseSegments[0] == 'PING')
        {
            $this->executeEvent('PING', $serverResponseSegments[1]);
            return;
        }

        if (empty($serverResponseSegments[1]))
        {
            $this->debugMessage("No op code could be found in server response.");
            return;
        }

        //Check to see if we have an opcode bound to a specific method
        if ($this->executeEvent($serverResponseSegments[1], $serverResponseSegments))
        {
            return;
        }

        if (empty($serverResponseSegments[3]))
        {
            return;
        }

        //No overridden op code, not a pong, lets carry on as if its a chat event
        //First check for bound commands, if not do the chat callback
        if ($serverResponseSegments[1] == 'PRIVMSG')
        {
            //First build the user from the configurable user class
            $user = call_user_func_array([static::USER_CLASS_NAME, 'getUser'], [$serverResponseSegments[0]]);

            $channel = $serverResponseSegments[2];

            if ($channel == $this->nickname)
            {
                $channel = $user->nickName;
            }

            $text = implode(' ', array_slice($serverResponseSegments, 3));

            $command = str_replace(array(chr(10), chr(13)), '', $serverResponseSegments[3]);

            $parameters = array();

            if (count($serverResponseSegments) > 3)
            {
                $parameters = array_slice($serverResponseSegments, 4);
            }

            if ($this->executeCommand($user, $channel, $command, $parameters))
            {
                return;
            }

            $this->handleChatMessage(
                $user,
                $channel,
                $text
            );
        }
    }

    /**
     * By default we look for a specified command function, if not ignore it
     *
     * @param User $user
     * @param string $channel
     * @param string $command
     * @param string[] $parameters
     *
     * @return boolean
     */
    private function executeCommand($user, $channel, $command, $parameters)
    {
        //Trim off leading colon
        if ($command[0] == ':')
        {
            $command = substr($command, 1);
        }

        if ($command[0] != $this->activationCharacter) return false;

        //Trim off activation character
        $command = substr($command, 1);

        if (!empty($this->commands[$command]) && $this->commands[$command] instanceof Commands\CommandInterface)
        {
            $this->debugMessage("Executing " . $command . " on channel " . $channel . ' with params "' . implode(' ' , $parameters) . '"');
            $this->commands[$command]->execute($this, $user, $channel, $parameters);

            return true;
        }

        return false;
    }

    /**
     * Execute Event
     *
     * @param $eventCode
     * @param $parameters
     * @return bool
     */
    private function executeEvent($eventCode, $parameters)
    {
        if (empty($this->opCodeEvents[$eventCode]) ||
            !($this->opCodeEvents[$eventCode] instanceof Events\EventInterface))
        {
            return false;
        }

        $this->opCodeEvents[$eventCode]->execute($this, $parameters);

        return $this;
    }

    /**
     * Handle chat messages if commands are not bound, etc
     *
     * @param User $user
     * @param $channel
     * @param $text
     */
    protected function handleChatMessage(User $user, $channel, $text)
    {
        $this->debugMessage('#' . $channel . ' <' . $user->nickname . '> ' . $text);
    }

    /**
     * On disconnect function for server termination
     */
    protected function onServerDisconnect()
    {
        $this->debugMessage('Disconnecting...');
    }

    /**
     * Quit and disconnect
     */
    public function quit($quitMessage = '')
    {
        $this->sendRawCommand('QUIT', '"' . $quitMessage . '"');
        $this->socket = null;
    }

    /**
     * Send a message to the IRC server
     *
     * @param string $text
     * @param string $channel
     */
    public function sendMessage($text, $channel)
    {
        $count = 0;

        $lines = explode("\n", $text);

        foreach ($lines as $line)
        {
            $line = trim($line);

            if (!empty($line))
            {
                $this->sendRawCommand('PRIVMSG', $channel . ' :' . $line);

                if ($count == ($this->antiFloodPacketCount - 1))
                {
                    $count = 0;

                    if ($this->antiFloodEnabled)
                    {
                        usleep($this->antiFloodPacketGap * 1000);
                    }
                }
                else
                {
                    if ($this->antiFloodEnabled)
                    {
                        usleep($this->antiFloodPacketSpeed * 1000);
                    }
                }

                $count++;
            }
        }
    }

    /**
     * Send generic data to the server
     *
     * @param string $cmd
     * @param string $msg
     */
    public function sendRawCommand($cmd, $msg = null)
    {
        if (empty($msg))
        {
            @fputs($this->socket, $cmd . "\r\n");

            $this->debugMessage($cmd);

            return;
        }

        @fputs($this->socket, $cmd . ' ' . $msg . "\r\n");

        $this->debugMessage($cmd . ' ' . $msg);
    }

    /**
     * Join a channel (or channels)
     *
     * @param string|string[] $channel
     */
    public function joinChannel($channel)
    {
        if (is_array($channel))
        {
            foreach($channel as $chan)
            {
                $this->sendRawCommand('JOIN', $chan);
            }

            return;
        }

        $this->sendRawCommand('JOIN', $channel);
    }

    /**
     * Part one or more channels
     *
     * @param $channel
     */
    public function partChannel($channel)
    {
        if (is_array($channel))
        {
            foreach ($channel as $chan)
            {
                $this->sendRawCommand('PART', $chan);
            }

            return;
        }

        $this->sendRawCommand('PART', $channel);
    }

    /**
     * Wrap text in ANSI color
     *
     * @param integer $colorIndex
     * @return string
     */
    public function colorText($text, $colorIndexForeground, $colorIndexBackground = 0)
    {
        if ($colorIndexForeground < 1 || $colorIndexBackground > 16) $colorIndexForeground = 0;
        if ($colorIndexBackground < 1 || $colorIndexBackground > 16) $colorIndexBackground = 1;

        return "\x03" . $colorIndexForeground . ',' . $colorIndexBackground . $text . "\x03";
    }

    /**
     * Print a debug message somewhere, or don't
     *
     * @param string $message
     */
    private function debugMessage($message)
    {
        if ($this->debug) echo $message."\n";
    }
}
<?php
/**
 * IRC User Class
 *
 * Should make parsing and dealing with irc style user classes easier. Use the
 * getUser static method to take advantage of caching out the preg_match.
 *
 * @package EricSalerno
 * @subpackage IRC
 * @author Eric Salerno
 */
namespace EricSalerno\IRC;

class User
{
    /**
     * User list for memory caching
     *
     * @var User[string]
     */
    private static $_usersList = [];

    /**
     * User Nickname
     *
     * @var string
     */
    public $nickName;

    /**
     * User Account Name
     *
     * @var string
     */
    public $name;

    /**
     * User Host
     *
     * @var string
     */
    public $host;

    /**
     * Username was idented
     *
     * @var boolean
     */
    public $isIdented = false;

    /**
     * Build a user from a string
     *
     * @param string $userString
     */
    public function __construct($userString = null)
    {
        if (!empty($userString))
        {
            $userSegments = array();
            preg_match('#:(.*?)\!(.*?)\@(.*)#', $userString, $userSegments);

            if (!empty($userSegments[1]))
            {
                $this->nickName = $userSegments[1];
            }

            if (!empty($userSegments[2]))
            {
                $this->name = $userSegments[2];

                if ($this->name[0] != '~') $this->isIdented = true;
            }

            if (!empty($userSegments[3]))
            {
                $this->host = $userSegments[3];
            }
        }
    }

    /**
     * Get a user, do not recreate if unnecessary
     *
     * @param string $userString
     * @return User
     */
    public static function getUser($userString)
    {
        if (!empty(static::$_usersList[$userString]))
        {
            return static::$_usersList[$userString];
        }

        $thisClass = get_called_class();

        $user = new $thisClass($userString);

        static::$_usersList[$userString] = $user;

        return $user;
    }

    /**
     * To string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->nickName . '!' . $this->name . '@' . $this->host;
    }

}
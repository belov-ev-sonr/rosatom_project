<?php
namespace Rosatom\Common;

use mysqli;

class DBConnect
{
    /** @var mysqli */
    private static $mysqli;
    /** @var DBConnect */
    private static $instance;

    /**
     * DBConnect constructor.
     */
    private function __construct()
    {
        self::init();
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }


    /**
     * @return mysqli
     */
    public static function getMysqli()
    {
        $instans = self::getInstance();
        return $instans::$mysqli;
    }

    public static function init(): void
    {
        $host ='vh58.timeweb.ru';
        $user = 'kyplinov_rosatom';
        $pass = 'qwerosatom1234';
        $dbName = 'kyplinov_rosatom';
        $port = '3306';
        $resource = new \mysqli($host, $user, $pass, $dbName, $port);
        self::isDBError($resource);
        self::$mysqli = $resource;
    }

    private static function isDBError(mysqli $resource): void
    {
        if (!$resource) {
            exit($resource->error);
        }
    }
}

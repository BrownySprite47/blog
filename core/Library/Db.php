<?php
/**
 * Created by PhpStorm.
 * User: BestUser1
 * Date: 12.04.2018
 * Time: 14:28
 */

namespace Library;

class Db
{
    private static $_db = null;
    private $_link;

    private function __construct()
    {
        if (!file_exists(__DIR__.'/../Config/db_conf.php')){
            throw new \Exception('Config db not found');
        }
        $config = require_once __DIR__.'/../Config/db_conf.php';
        $this->_link = @new \mysqli($config['host'], $config['username'], $config['password'], $config['db_name']);
        if ($this->_link->connect_error){
            throw new \Exception($this->_link->connect_error);
        }
        $this->_link->set_charset('utf8');
    }

    public static function getDb()
    {
        if (is_null(self::$_db)){
            self::$_db = new self();
        }
        return self::$_db;
    }

}
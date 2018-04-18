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
    /**
     * @var null
     */
    private static $_db = null;
    /**
     * @var \mysqli
     */
    private $_link;

    /**
     * Db constructor.
     * @throws \Exception
     */
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

    /**
     * @return Db|null
     * @throws \Exception
     */
    public static function getDb()
    {
        if (is_null(self::$_db)){
            self::$_db = new self();
        }
        return self::$_db;
    }

    /**
     * @param $sql
     * @return bool|\mysqli_result
     * @throws \Exception
     */
    public function sendSelectQuery($sql)
    {
        $connect = $this->_link->query($sql);
        if (!$connect){
            throw new \Exception($this->_link->error);
        }else{
            while ($row = $connect->fetch_assoc()){
                $result[] = $row;
            }
        }
        return $result;
    }

    /**
     * @param $sql
     * @return bool|\mysqli_result
     * @throws \Exception
     */
    public function sendIUDQuery($sql)
    {
        $connect = $this->_link->query($sql);
        if (!$connect){
            throw new \Exception($this->_link->error);
        }

        return $connect;
    }

    public function getSafeData($data){
        return $this->_link->real_escape_string($data);
    }
}
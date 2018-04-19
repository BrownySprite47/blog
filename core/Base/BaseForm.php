<?php
/**
 * Created by PhpStorm.
 * User: BestUser1
 * Date: 18.04.2018
 * Time: 14:26
 */

namespace Base;


use Library\Db;
use Library\Validator;

abstract class BaseForm
{
    protected $_db;
    protected $_errors = [];
    protected $_data;
    protected $_validator = null;

    /**
     * BaseForm constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->_db = Db::getDb();
    }

    /**
     * @return mixed
     */
    abstract public function getRules();

    /**
     * @return bool
     * @throws \Exception
     */
    public function validate()
    {
        $validator = new Validator($this->_data, $this->getRules());
        if (!empty($this->_tableName)){
            $validator->setTable($this->_tableName);
        }
        if (!$validator->validateThis()){
            $this->_errors = $validator->getErrors();
            return false;
        }
        return true;
    }

    /**
     * @param $data
     * @return bool
     */
    public function load($data)
    {
        //echo '<pre>';
        //var_dump($data);
        foreach ($data as $propName => $propValue) {
            if (property_exists(static::class, $propName)){
                $propValue = $this->_db->getSafeData($propValue);
                $this->$propName = $propValue;
                $this->_data[$propName] = $propValue;
            }else{
                return false;
            }
        }
        return true;

    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->_errors;
    }
}
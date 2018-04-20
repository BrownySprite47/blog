<?php
/**
 * Created by PhpStorm.
 * RegisterForm: BestUser1
 * Date: 18.04.2018
 * Time: 14:10
 */

namespace Core\Library;


class Validator
{
    protected $_errors = [];
    protected $_rules = [];
    protected $_fields = [];
    protected $_data = [];
    protected $table;

    /**
     * Validator constructor.
     * @param $data
     * @param $rules
     */
    public function __construct($data, $rules)
    {
        $this->_rules = $rules;
        $this->_data = $data;

        $this->_fields = array_keys($rules);
    }

    /**
     * @param $field
     */
    protected function required($field)
    {
        if (empty($this->_data[$field])){
            $this->addError($field, 'Field must be set!');
        }
    }

    /**
     * @param $field
     */
    protected function email($field)
    {
        if (!preg_match('/^([\w\-.])+@+([\w\-]{2}+.+[a-zA-Z]{2})$/', $this->_data[$field])){
            $this->addError($field, 'Email in wrong format');
        }
    }

    /**
     * @param $field
     * @throws \Exception
     */
    protected function unique($field)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$field} = '{$this->_data[$field]}'";
        $result =  Db::getDb()->sendQuery($sql);
        if ($result->num_rows > 0){
            $this->addError($field, $field.' is not unique');
        }
    }

    /**
     * @param $field
     */
    protected function confirm($field)
    {
        if ($this->_data[$field] != $this->_data[$field.'_confirm']){
            $this->addError($field, $field.'_confirm in incorrect');
        }
    }

    /**
     * @param $field
     * @param $error
     */
    public function addError($field, $error)
    {
        $this->_errors[$field] = $error;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->_errors;
    }

    /**
     * @param $field
     * @return mixed
     */
    public function getError($field)
    {
        return $this->_errors[$field];
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function validateThis()
    {
        foreach ($this->_rules as $field => $rules) {
            foreach ($rules as $rule) {
                if(method_exists($this, $rule)){
                    if (is_null($this->getError($field))){
                        $this->$rule($field);
                    }
                }else{
                    throw new \Exception('Unknown validation rule: '.$rule);
                }
            }
        }

        if (!empty($this->_errors)){
            return false;
        }

        return true;
    }

    /**
     * @param $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }
}
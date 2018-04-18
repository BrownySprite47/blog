<?php
/**
 * Created by PhpStorm.
 * User: BestUser1
 * Date: 18.04.2018
 * Time: 15:57
 */

namespace Models;


use Base\BaseForm;

class RegisterForm extends BaseForm
{
    public $login;
    public $password;
    public $password_confirm;

    protected $_tableName = 'user';
    /**
     * @return mixed
     */
    public function getRules()
    {
        return [
            'login' => ['required', 'email', 'unique'],
            'password' => ['required', 'confirm'],
            'password_confirm' => ['required'],
        ];
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function doRegister()
    {
        //$password = md5($this->password);
        $password = $this->password;
        $sql = "INSERT INTO users ('login', 'password') VALUES ('{$this->login}', '{$password}')";

        $result = $this->_db->sendIUDQuery($sql);
        if (!$result){
            $this->_errors['register'] = 'Error!';
            return false;
        }
        return true;
    }
}
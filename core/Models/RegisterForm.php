<?php
/**
 * Created by PhpStorm.
 * User: BestUser1
 * Date: 18.04.2018
 * Time: 15:57
 */

namespace Core\Models;


use Core\Base\BaseForm;
use Core\Library\Auth;

class RegisterForm extends BaseForm
{
    public $login;
    public $password;
    public $password_confirm;

    protected $_tableName = 'users';
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
        $password = md5($this->password);
        //$password = $this->password;
        $sql = "INSERT INTO {$this->_tableName} (login, password) VALUES ('{$this->login}', '{$password}')";

        $result = $this->_db->sendQuery($sql);
        if (!$result){
            $this->_errors['register'] = 'Error!';
            return false;
        }
        // авторизовываем пользователя сразу поле регистрации
        $id= $this->_db->getLastInsertId();
        $role = 'user';
        Auth::login($id, $role);
        return true;
    }
}
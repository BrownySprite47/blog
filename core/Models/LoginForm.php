<?php
/**
 * Created by PhpStorm.
 * User: BestUser1
 * Date: 18.04.2018
 * Time: 14:42
 */

namespace Models;


use Base\BaseForm;
use Library\Auth;

class LoginForm extends BaseForm
{
    public $login;
    public $password;
    /**
     * @return mixed
     */
    public function getRules()
    {
        return [
            'login' => ['required', 'email'],
            'password' => ['required']
        ];
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function doLogin()
    {
        //$password = md5($this->password);
        $password = $this->password;
        $sql = "SELECT id, role FROM users WHERE login = '{$this->login}' and password = '{$password}'";

        $user = $this->_db->sendSelectQuery($sql);
        if ($user){
            Auth::login($user['id'], $user['role']);
            return true;
        }else{
            return false;
        }
    }
}
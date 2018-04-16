<?php
/**
 * Created by PhpStorm.
 * User: BestUser1
 * Date: 12.04.2018
 * Time: 16:57
 */

namespace Library;


class Auth
{
    public function isGuest()
    {
        if(empty($_SESSION['user']))
        {
            return true;
        }
        return false;
    }

    public static function canAccess($role)
    {
        if($_SESSION['user']['role'] == $role)
        {
            return true;
        }
        return false;
    }

    public static function login($id, $role)
    {
        $_SESSION['user']['id'] = $id;
        $_SESSION['user']['role'] = $role;
    }

    public static function logout()
    {
        session_unset();
        session_destroy();
    }
}
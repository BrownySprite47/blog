<?php
/**
 * Created by PhpStorm.
 * User: BestUser1
 * Date: 18.04.2018
 * Time: 15:03
 */

namespace Library;


class Request
{
    public $post;
    public $get;

    /**
     * @return bool
     */
    public static function isPost()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public static function isGet()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            return true;
        }

        return false;
    }

    /**
     * @return mixed
     */
    public static function getPost()
    {
        //var_dump($_POST);
        return $_POST;
    }

    /**
     * @return mixed
     */
    public static function getGet()
    {
        return $_GET;
    }
}
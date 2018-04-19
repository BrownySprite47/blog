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
    public static function getPost($param = null)
    {
        if (is_null($param)){
            return $_POST;
        }else{
            return $_POST[$param];
        }
    }

    /**
     * @return mixed
     */
    public static function getGet($param = null)
    {
        if (is_null($param)){
            return $_GET;
        }else{
            return $_GET[$param];
        }
    }
}
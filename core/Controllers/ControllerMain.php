<?php
/**
 * Created by PhpStorm.
 * User: BestUser1
 * Date: 12.04.2018
 * Time: 13:03
 */

namespace Controllers;
use Base\Controller;
use Library\Db;

class ControllerMain extends Controller
{
    public function actionIndex()
    {
        $db = Db::getDb();
        var_dump(dirname(__DIR__));
        echo 'Index Page';
    }
}
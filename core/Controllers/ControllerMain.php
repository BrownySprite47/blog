<?php
/**
 * Created by PhpStorm.
 * User: BestUser1
 * Date: 12.04.2018
 * Time: 13:03
 */

namespace Controllers;
use Base\Controller;

class ControllerMain extends Controller
{
    public function actionIndex()
    {
        echo 'Index Page';
    }
}
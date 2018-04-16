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
    /**
     * @throws \Exception
     */
    public function actionIndex()
    {

    }

    public function actionLogin()
    {
        $this->_view->setTitle('Login');
        $this->_view->render('login', []);
    }

    public function actionLogout()
    {

    }

    public function actionRegister()
    {

    }
}
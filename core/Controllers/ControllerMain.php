<?php
/**
 * Created by PhpStorm.
 * User: BestUser1
 * Date: 12.04.2018
 * Time: 13:03
 */

namespace Controllers;
use Base\Controller;
use Library\Auth;
use Library\HttpException;
use Library\Request;
use Models\LoginForm;
use Models\RegisterForm;

class ControllerMain extends Controller
{
    /**
     * @throws \Exception
     */
    public function actionIndex()
    {

    }

    /**
     * @throws HttpException
     * @throws \Exception
     */
    public function actionLogin()
    {
        if (Auth::isGuest()){

            $model= new LoginForm();
            if (Request::isPost()){
                //echo 1;
                if ($model->load(Request::getPost()) and $model->validate()){
                    //echo 2;
                    if ($model->doLogin()){
                        //echo 3;
                        header('Location: /');
                    }
                }
            }

            $this->_view->setTitle('Login');
            $this->_view->render('login', ['model' => $model]);
        }else{
            throw  new HttpException('Forbidden', '403');
        }
    }

    /**
     * @throws HttpException
     */
    public function actionLogout()
    {
        if(!Auth::isGuest()){
            Auth::logout();
            header("Location: /");
        }else{
            throw  new HttpException('Forbidden', '403');
        }

    }

    /**
     * @throws HttpException
     * @throws \Exception
     */
    public function actionRegister()
    {
        if (Auth::isGuest()) {
            $model = new RegisterForm();
            if (Request::isPost()) {
                if ($model->load(Request::getPost()) and $model->validate()) {
                      if ($model->doRegister()) {
                        header('Location: /');
                    }
                }
            }
            $this->_view->setTitle('Registration');
            $this->_view->render('registration', ['model' => $model]);
        }else{
            throw new HttpException('Forbidden'. '403');
        }
    }
}
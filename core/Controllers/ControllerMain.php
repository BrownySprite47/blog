<?php
/**
 * Created by PhpStorm.
 * RegisterForm: BestUser1
 * Date: 12.04.2018
 * Time: 13:03
 */

namespace Core\Controllers;

use Core\Base\Controller;
use Core\Library\Auth;
use Core\Library\HttpException;
use Core\Library\Request;
use Core\Models\Posts;
use Core\Models\LoginForm;
use Core\Models\RegisterForm;

class ControllerMain extends Controller
{
    /**
     * @throws \Exception
     */
    public function actionIndex()
    {
        $model = new Posts();
        $this->_view->setTitle('Главная');
        $this->_view->setCss('style.css');
        $this->_view->render('posts', ['model' => $model]);
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
                if ($model->load(Request::getPost()) and $model->validate()){
                    if ($model->doLogin()){
                        header('Location: /');
                    }
                }
            }

            $this->_view->setTitle('Вход');
            $this->_view->setCss('style.css');
            $this->_view->render('login', ['model' => $model]);
        }else{
            throw new HttpException('Forbidden', '403');
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
            throw new HttpException('Forbidden', '403');
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
            $this->_view->setTitle('Регистрация');
            $this->_view->setCss('style.css');
            $this->_view->render('registration', ['model' => $model]);
        }else{
            throw new HttpException('Forbidden', '403');
        }
    }
}
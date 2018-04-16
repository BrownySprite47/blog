<?php
/**
 * Created by PhpStorm.
 * User: BestUser1
 * Date: 12.04.2018
 * Time: 13:04
 */

namespace Base;


abstract class Controller
{
    protected $_view;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->_view = new View();
        $this->_view->setLayout('main');
    }

    abstract public function actionIndex();
}
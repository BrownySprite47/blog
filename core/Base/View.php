<?php
/**
 * Created by PhpStorm.
 * User: BestUser1
 * Date: 12.04.2018
 * Time: 17:16
 */

namespace Base;


class View
{
    public $basePath = __DIR__.'/../views/templates/';
    protected $title;
    protected $seo = [];
    protected $css = [];
    protected $js = [];

    protected $_layout;

    public function render($tplName, $data)
    {
        include $this->_layout;
    }

}
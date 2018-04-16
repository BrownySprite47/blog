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
    public $basePath = '/../views/templates/';
    protected $title;
    protected $seo = [];
    protected $css = [];
    protected $js = [];

    protected $_layout;

    /**
     * @param $tplName
     * @param $data
     */
    public function render($tplName, $data)
    {
        include __DIR__.'/../views/layout/'.$this->_layout.'.php';
        //echo $this->basePath;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param array $seo
     */
    public function setSeo($seo)
    {
        $this->seo[] = $seo;
    }

    /**
     * @param array $css
     */
    public function setCss($css)
    {
        $this->css[] = $css;
    }

    /**
     * @param array $js
     */
    public function setJs($js)
    {
        $this->js[] = $js;
    }

    /**
     * @param mixed $layout
     */
    public function setLayout($layout)
    {
        $this->_layout = __DIR__.'/../views/layout/'.$this->_layout.'.php';
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return array
     */
    public function getSeo()
    {
        return $this->seo;
    }

    /**
     * @return array
     */
    public function getCss()
    {
        return $this->css;
    }

    /**
     * @return array
     */
    public function getJs()
    {
        return $this->js;
    }

    /**
     * @return mixed
     */
    public function getLayout()
    {
        return $this->_layout;
    }

}
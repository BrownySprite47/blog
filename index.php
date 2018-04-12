<?php

use Library\Url;

/**
 * Автозагрузка классов
 * @param $className
 */

function __autoload($className)
{
    $filename = 'core/'.str_replace('\\', '/', $className) . '.php';
    if (!file_exists($filename)){
        throw new \Exception('Class [' . $className . '] Not Found', 1);
    }

    require_once $filename;
}

try{
    $controllerName = Url::getSegment(0);
    $actionName = Url::getSegment(1);

    $controller = (is_null($controllerName)) ? 'Controllers\ControllerMain' : 'Controllers\Controller'.ucfirst($controllerName);
    $action = (is_null($actionName)) ? 'actionIndex' : 'action'.ucfirst($actionName);

    $filename = 'core/'.str_replace('\\', '/', $controller) . '.php';
    if (!file_exists($filename)){
        throw new \Library\HttpException('Not found', '404');
    }else{
        $controller = new $controller();
        if (!method_exists($controller, $action)){
            throw new \Library\HttpException('Not found', '404');
        }else{
            $controller->$action();
        }
    }


}catch (\Library\HttpException $e){
    header("HTTP/1.1 ".$e->getCode().' '.$e->getMessage());
    die('Page Not Found');
}catch (\Exception $e){
    die($e->getMessage());
}


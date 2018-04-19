<?php

session_start();

use Library\Url;

/**
 * Автозагрузка классов
 * @param $className
 * @throws Exception
 */
function __autoload($className)
{
    $fileName = 'core/'.str_replace('\\', '/', $className) . '.php';
    if (!file_exists($fileName)){
        throw new \Exception('Class [' . $className . '] Not Found');
    }
    require_once $fileName;
}
$controllerName = Url::getSegment(0);
$actionName = Url::getSegment(1);
$controller = (is_null($controllerName)) ? 'Controllers\ControllerMain' : 'Controllers\Controller'.ucfirst($controllerName);
$action = (is_null($actionName)) ? 'actionIndex' : 'action'.ucfirst($actionName);

try{
    $fileName = 'core/'.str_replace('\\', '/', $controller) . '.php';
    if (!file_exists($fileName)){
        throw new Library\HttpException('Not found', '404');
    }
    $controller = new $controller();
    if (!method_exists($controller, $action)){
        throw new Library\HttpException('Not found', '404');
    }
    $controller->$action();
}catch (Library\HttpException $e){
    header("HTTP/1.1 ".$e->getCode().' '.$e->getMessage());
    die($e->getMessage());
}catch (\Exception $e){
    die($e->getMessage());
}


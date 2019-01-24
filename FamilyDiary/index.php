<?php

include_once 'Config.php';

function __autoload($className){
    $controllerPath = 'controller/'.$className.'.php';
    $modelPath = 'model/'.$className.'.php';
    $class = $className.'.php';

    if(file_exists($class)){
        require_once $class;
    }
    elseif(file_exists($modelPath)){
        require_once $modelPath;
    }

    elseif(file_exists($controllerPath)){
        require_once $controllerPath;
    }
    else {
        throw new Exception("Class $className not require");
    }
}


$router = new Router();

//Call controller and action
$controllerClass = $router->getController();
$controller = new $controllerClass();
$controllerMethod = $router->getAction();
$controller->$controllerMethod();

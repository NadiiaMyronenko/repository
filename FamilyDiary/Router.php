<?php

class Router {
    protected $controller;
    protected $action;

    public function getController()
    {
        return $this->controller;
    }
    public function getAction()
    {
        return $this->action;
    }

    public function __construct()
    {
        //Default value
        $this->controller = 'ControllerBase';
        $this->action = 'index';

        if(!empty($_GET['param'])) {
            $url = $_GET['param'];
            $url = strtolower(trim($url, '/'));
            $urlPath = explode('/', $url);

            if(!empty(current($urlPath))){
                $this->controller = 'Controller' . ucfirst(current($urlPath));
                array_shift($urlPath);
            }
            if(!empty(current($urlPath))){
                $this->action = current($urlPath);
                array_shift($urlPath);
            }
        }

//        echo 'Controller ' . $this->controller . '<br>';
//        echo 'Action ' . $this->action . '<br>';
    }
}
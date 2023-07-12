<?php

class App
{
    private $controller = 'HomeController';
    private $method = 'index';
    private $params = [];

    public function __construct()
    {
        $this->prepare_url();
        $this->render();
    }

    public function prepare_url()
    {
        $url = $_SERVER['QUERY_STRING'];

        if (!empty($url)) {
            $url = trim($url, "/");
            $url = explode('/', $url);

            if ($url[0] === 'i=1' || $url[0] === 'i=2') {
                redirect();
            }

            $this->controller = isset($url[0]) ? ucwords($url[0]) . 'Controller' : $this->controller;

            $this->method = isset($url[1]) ? $url[1] : $this->method;


            unset($url[0], $url[1]);
            $this->params = !empty($url) ? $url : $this->params;
        }
    }

    public function render()
    {
        if (class_exists($this->controller)) {

            $controller = new $this->controller;
            $reflection = new ReflectionMethod($controller, $this->method);

            if (method_exists($controller, $this->method) && $reflection->isPublic()) {
                call_user_func_array([$controller, $this->method], $this->params);
            } else {
                View::load('error', ['pageName' => 'Error', "nav" => ['login', 'sign up', 'home']]);
            }
        } else {
            View::load('error', ['pageName' => 'Error', "nav" => ['login', 'sign up', 'home']]);
        }
    }
}

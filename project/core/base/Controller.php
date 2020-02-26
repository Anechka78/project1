<?php

namespace project\core\base;


abstract class Controller
{

    public $route = [];
    public $prefix;
    public $view;
    public $layout;

    public $vars = [];

    public function __construct($route){
        $this->route = $route;
        $this->view = $route['action'];
        $this->prefix = $route['prefix'];
    }

    public function getView(){
        $vObj = new View($this->route, $this->layout, $this->view);
        $vObj->render($this->vars);
    }

    public function set($vars){
        $this->vars = $vars;
    }

    public function isAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    public function loadView($view, $vars = []){
        extract($vars); //извлекаем переменные из массива
        require APP . "/views/{$this->prefix}{$this->route['controller']}/{$view}.php";
        die;
    }


}
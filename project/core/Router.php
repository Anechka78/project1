<?php
namespace project\core;

class Router
{
    protected static $routes = [];
    protected static $route = [];

    /**
     * @param $regexp
     * @param array $route
     */
    public static function add($regexp, $route = []){
        self::$routes[$regexp] = $route;
    }

    /**
     *
     * @return array
     */
    public static function getRoutes(){
        return self::$routes;
    }

    /**
     *
     * @return array
     */
    public static function getRoute(){
        return self::$route;
    }

    /**
     *
     * @param $url
     * @return bool
     */
    protected static function matchRoute($url){

        foreach(self::$routes as $pattern => $route){
            if(preg_match("#$pattern#i", $url, $matches)){
                foreach($matches as $k => $v){
                    if(is_string($k)){
                        $route[$k] = $v;
                    }
                }
                if(!isset($route['action'])) {
                    $route['action'] = 'index';
                }
                if(!isset($route['prefix'])){
                    $route['prefix'] = '';
                }else{
                    $route['prefix'] .= '\\';
                }

                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    /**
     *
     * @param string $url
     * @return void
     */
    public static function dispatch($url){
        $url = self::removeQueryString($url);

        if(self::matchRoute($url)){
           $controller = 'app\controllers\\' . self::$route['prefix'] . self::$route['controller'] . 'Controller';
            if(class_exists($controller)){
                $cObj = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action']) . 'Action';
                if(method_exists($cObj, $action)){
                    $cObj->$action();
                    $cObj->getView();
                }else{
                    echo'Non ok method!' . $controller;
                }
            }else{
                echo'Non ok!'. $controller;
            }
        }else{
            http_response_code(404);
            include '404.html';
        }
    }

    protected static function upperCamelCase($name){
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    protected static function lowerCamelCase($name){
        return lcfirst(self::upperCamelCase($name));
    }

    protected static function removeQueryString($url){
        if($url){
            $params = explode('&', $url, 2);
            if(false === strpos($params['0'], '=')){
                return trim($params['0'], '/');
            }else{
                return '';
            }
        }
    }


    protected static function getQueryString($url){
        if($url){
            $q2 = explode('&', $url);
            array_splice($q2, 0, 1);

            if (!isset($q2[0])) {
                return false;
            }

            $qq1 = array_map(function ($in){
                return ['k' => explode('=', $in, 2)[0], 'v' => explode('=', $in, 2)[1]];
            }, $q2);

            $qq2 = [];
            foreach ($qq1 as $val) {
                $qq2[$val['k']] = $val['v'];
            }

            if (array_key_exists('s', $qq2)) {
                return $qq2['s'];
            }
            return false;
        }
    }

}



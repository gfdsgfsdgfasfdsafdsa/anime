<?php
class Route{
    private static $routes = array(
        'GET' => array(),
        'POST' => array(),
        'MAKE' => array()
    );
    public static function init($loadFile, $uri, $requestType){
        require_once $loadFile . '.php';
        if(array_key_exists($uri, self::$routes['MAKE'])){
            return self::callMethod(
                ...explode('/', self::$routes['MAKE'][$uri])
            );
        }else if(array_key_exists($uri, self::$routes[$requestType])){
            return self::callMethod(
                ...explode('/', self::$routes[$requestType][$uri])
            );
        }
        return self::callMethod('Error404', 'index');
    }
    private static function callMethod($controller, $method){
        return (new $controller)->$method();
    }
    public static function get($uri, $controller){
        self::$routes['GET'][$uri] = $controller;
    }
    public static function post($uri, $controller){
        self::$routes['POST'][$uri] = $controller;
    }
    public static function make($uri, $controller){
        self::$routes['MAKE'][$uri] = $controller;
    }
}
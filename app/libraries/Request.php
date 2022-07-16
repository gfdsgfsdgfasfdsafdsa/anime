<?php
class Request{
    public static function uri($rootFolder = ''){
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),'/');
        return $rootFolder == '' ? $uri : ltrim(str_replace_first($rootFolder, '', $uri), '/');
    }
    public static function method(){ return $_SERVER['REQUEST_METHOD']; }
    public static function post(){ return $_SERVER['REQUEST_METHOD'] == 'POST'; }
    public static function get(){ return $_SERVER['REQUEST_METHOD'] == 'GET'; }
}
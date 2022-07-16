<?php
@session_start();
require_once '../app/config/config.php';
require_once '../app/config/functions.php';
spl_autoload_register(function ($class){
    if(file_exists(APPROOT.'controllers/'."{$class}.php"))
        require_once APPROOT.'controllers/'."{$class}.php";
    else if(file_exists(APPROOT.'libraries/'."{$class}.php"))
        require_once APPROOT.'libraries/'."{$class}.php";
    else if(file_exists(APPROOT.'models/'."{$class}.php"))
        require_once APPROOT.'models/'."{$class}.php";

    global $autoLoadFolders;
    if(!empty($autoLoadFolders['controllers'])){
        foreach ($autoLoadFolders['controllers'] as $path){
            if(file_exists(APPROOT.'controllers/'.$path.DS."{$class}.php")){
                require_once APPROOT.'controllers/'.$path.DS."{$class}.php";
            }
        }
    }
    if(!empty($autoLoadFolders['models'])){
        foreach ($autoLoadFolders['models'] as $path){
            if(file_exists(APPROOT.'models/'.$path.DS."{$class}.php")){
                require_once APPROOT.'models/'.$path.DS."{$class}.php";
            }
        }
    }
});
Route::init('../app/config/routes',
    Request::uri(ROOTFOLDER),
    Request::method());

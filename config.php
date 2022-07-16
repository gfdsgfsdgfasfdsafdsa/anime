<?php
//Database Config
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'anime_db');

//
define('DS', DIRECTORY_SEPARATOR);
define('ROOTFOLDER', 'anime');
define('ROOTURL', 'http://localhost:8080/anime/');
define('IMAGESPATH', ROOTURL.'images'.DS);

//Auto Load Classes in Folder
$autoLoadFolders = array(
    'controllers' => array(),
    'models' => array()
);
//System Config
define('APPROOT', dirname(dirname(__FILE__)).DS);

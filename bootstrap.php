<?php

// Define web root
// Remember to change this //
$temp_dir = str_replace('\\', '/', __DIR__);
$temp_dir = str_replace('C:/xampp/htdocs', '', $temp_dir);

if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on'){
    define('_DEFAULT_PATH', 'https://localhost'.$temp_dir);
}else{
    define('_DEFAULT_PATH', 'http://localhost'.$temp_dir);
}

// Automatically load configs
$cfg_dir = scandir('configs');

if(!empty($cfg_dir)){
    foreach($cfg_dir as $cfg){
        if($cfg != '.' && $cfg != '..' && file_exists('configs/'.$cfg)){
            require_once 'configs/'.$cfg;
        }
    }
}

require_once 'core/Loader.php';
require_once 'core/Middleware.php';
// require_once 'core/Route.php';
require_once 'core/Session.php';

// DATABASE Require
if(!empty($config['database'])){
    require_once 'core/Database.php';
}
$_DATABASE = new Database();

require_once 'app/App.php';

require_once 'core/Model.php';
require_once 'core/Controller.php';
require_once 'core/Request.php';
require_once 'core/Response.php';
require_once 'core/Helper.php';

require_once 'tmdb_v3/tmdb-api.php';
$_TMDB = new TMDB();

// TMDB IMG SRC PREFIX
define('_TMDB_IMG', 'https://image.tmdb.org/t/p/original');
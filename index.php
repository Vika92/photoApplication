<?php
//FRONT Controller

// 1.General Settings
//    ini_set('display_errors', '1');
//    error_reporting(E_ALL);

    session_start();
// 2.Files include

    define('ROOT',dirname(__FILE__));
require_once(ROOT.'/components/Autoload.php');
//require_once(ROOT.'\components\Router.php');
//require_once(ROOT.'\components\Db.php');

// 3. Set connection to DB

// 4. Call Router
    $router = new Router;
    $router->run();
?>
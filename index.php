<?php

session_start();

require_once 'app/Autoload.php';
require_once 'core/Autoload.php';

define('ROOT', dirname(str_replace('\\', '/', __DIR__)));
App\Autoloader::register();
Core\Autoloader::register();


if(isset($_GET['p'])){
    $page = $_GET['p'];
}else{
    $page = 'home';
}


$page = explode('.', $page);

if($page[0] == 'admin'){
    $controller = '\App\Controller\Admin\\' . ucfirst($page[0]) . 'Controller';
    $action = $page[0];
}
else {
    if(class_exists('\App\Controller\\' . ucfirst($page[0]) . 'Controller')) {
        $controller = '\App\Controller\\' . ucfirst($page[0]) . 'Controller';
        $action = $page[0];
    } else {
        $page = 'error';
        $controller = '\App\Controller\\' . ucfirst($page) . 'Controller';
        $action = $page;
    }
}

$controller = new $controller();
$controller->$action();


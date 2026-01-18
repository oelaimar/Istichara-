<?php

// $router=new Router();
// $router->dispatch();

spl_autoload_register(function ($class) {
    $path = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
});

$url = $_GET['url'] ?? 'home';

switch ($url) {
    case 'istichara':
        require 'index.php';
        break;
    case 'add':
        $controller = new controllers\PersonneController();
        $controller->createForm();
        break;
    case 'home':
        require 'views/home.php';
        break;    
    default:
        echo "Page non trouvée";
}
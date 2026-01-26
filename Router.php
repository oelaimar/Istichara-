<?php

use controllers\DashboardController;
use controllers\PersonneController;
use controllers\VilleController;
use controllers\AvocatController;
use controllers\DemandeController;
use controllers\HussierController;
use controllers\HomeController;
use controllers\SearchController;
use controllers\RegisterController;
use controllers\AdminController;
use controllers\LoginController;

class Router{
    private static array $controllers=[
        "avocat" => AvocatController::class,
        "hussier" => HussierController::class,
        "dashboard"=>DashboardController::class,
        "personne"=>PersonneController::class,
        "ville" =>VilleController::class,
        "home"=> HomeController::class,
        "search" => SearchController::class,
        "register" => RegisterController::class,
        "demande" => DemandeController::class,
        "admin" => AdminController::class,
        "login"=>LoginController::class
    ];

    public static function dispatch(){
        $url = $_GET['url'] ?? '';
        
        if ($url) {
            $parts = explode('/', trim($url, '/'));
            $controllerKey = $parts[0] ?? 'home';
            $action = $parts[1] ?? 'index';
            
            // Handle empty strings if url was just '/'
            if(empty($controllerKey)) $controllerKey = 'home';
            if(empty($action)) $action = 'index';
        } else {
            $controllerKey=$_GET["controller"] ?? 'home'; 
            $action=$_GET["action"] ?? 'index'; // Changed default to index as methods are usually index()
        }

        if(!isset(self::$controllers[$controllerKey])){
            throw new \Exception('Controller intrrouvable');
        }

        $controllerClasse=new self::$controllers[$controllerKey];

        if(!method_exists($controllerClasse,$action)){
            throw new \Exception('Methode intrrouvable');

        }
        $controllerClasse->$action();
    }    
}
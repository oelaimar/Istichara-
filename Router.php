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
        "demande" => DemandeController::class
        "admin" => AdminController::class,
        "home" =>HomeController::class,
    ];

    public static function dispatch(){
        $controllerKey=$_GET["controller"] ?? 'home'; 
        $action=$_GET["action"] ?? 'home';

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
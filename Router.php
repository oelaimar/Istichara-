<?php

class Router{
    private array $controllers=[
        "avocat" => AvocatController::class,
        "hussier" => HussierController::class,
        "personne"=>PersonneController::class,
        "ville" => VilleController::class
    ];

    public function dispatch(){
        $controllerKey=$_GET["controller"];
        $action=$_GET["action"];

        if(!isset($this->controllers[$controllerKey])){
            throw new \Exception('Controller intrrouvable');
        }

        $controllerClasse=new $this->controllers[$controllerKey];

        if(!method_exists($controllerClasse,$action)){
            throw new \Exception('Methode intrrouvable');

        }
        $controllerClasse->$action();
    }    
}
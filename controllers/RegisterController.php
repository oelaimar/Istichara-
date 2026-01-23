<?php

namespace controllers;

use repositories\UserRepo;
use repositories\ClientRepo;
use repositories\VilleRepo;

use models\User;
use models\Client;
use helper\Database;
require_once __DIR__ . '/../helper/Validator.php';

class RegisterController{
    public function createClientForm() {
        // recuperation des villes via  repo
        $villeRepo = new VilleRepo();
        $villes = $villeRepo->affichage();
        
        require_once __DIR__ . '/../views/Registerclientform.php';  
    }
    
    public function Registerclient(){
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $city = (int)$_POST['ville'];
        }
        $conn = Database::getConnection();

        $conn = Database::getConnection();
            // $sql = "INSERT INTO \"user\"(email, password, role) VALUES('$email', '$password', 'client')";
            // $stmtS = $conn->prepare($sql);
            // $result = $stmtS->execute();
            // $user_id = $conn->lastInsertId();
            
            // $sql = "INSERT INTO \"client\"(user_id, name, phone, city_id) VALUES('$user_id', '$name', '$phone', '$city')";
            // $stmt = $conn->prepare($sql);
            // $result = $stmt->execute();


            // // create user
            // // $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 
            $user = new User($email, $password, 'client');
            $userRepo = new UserRepo();
            $user_id = $userRepo->create($user);
            // echo $user_id;
            if (!$user_id) {
                    throw new \Exception("erreur lors de la creation du compte");
            }
            // //create Client
            $client = new Client($user_id, $name, $phone, $city);
            $clientRepo = new ClientRepo();
            var_dump($user_id);
            $clientcreated = $clientRepo->create($client);

    }

    
}

?>
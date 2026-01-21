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

        $conn->beginTransaction();
        try{
            // create user
            // $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 
            $user = new User($email, $password, 'client');
            $userRepo = new UserRepo();
            $user_id = $userRepo->create($user);
            
            if (!$user_id) {
                    throw new \Exception("Erreur lors de la création du compte");
            }

            //create Client
            $client = new Client($user_id, $name, $email, $phone, $city);
            $clientRepo = new ClientRepo();
            $clientcreated = $clientRepo->create($client);

            $conn->commit();

            header("Location: /istishara/login");
            exit;

        }catch (\Exception $e){
            $conn->rollback();
            $_SESSION['error'] = "Erreur lors de l'inscription. Cet email est peut-être déjà utilisé.";
            header("Location: /istishara/register/client");
            exit;
        }
    }
}

?>
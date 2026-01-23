<?php

namespace controllers;

use repositories\UserRepo;
use repositories\DemandeRepo;
use repositories\VilleRepo;
use models\User;
use models\Demande;
use helper\Database;

require_once __DIR__ . '/../helper/Validator.php';

class DemandeController{
    public function createProForm() {
        // recuperation des villes via  repo
        $villeRepo = new VilleRepo();
        $villes = $villeRepo->affichage();
        
        require_once __DIR__ . '/../views/Registerproform.php';  
    }

    public function Registerpro(){
        if(isset($_POST['submit'])){
            $type = $_POST['type'];

            if(strtolower($type) === 'avocat'){
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $city = $_POST['ville'];
                $experience = $_POST['experience'];
                $tarif = $_POST['tarif'];
                $specialization = $_POST['specialization'];
                $consultation_online = $_POST['consultation_online'] == '1' ? 1 : 0;
                $password = $_POST['password'];
                $diplomes = $_FILES["diplomes"];

                // save file

                $url = $this->uploadDocuments($diplomes);
                if (!$url) {
                $_SESSION['error'] = "Erreur lors de l'upload du document";
                exit;
                }

                $client = new Demande($name, $email, $phone, $tarif, $experience, $url, 'pending', $city, $specialization, $consultation_online, null);
                $clientRepo = new DemandeRepo();
                $clientcreated = $clientRepo->createAvocat($client);
                
                header("location: /../views/home.php");
                exit;


            }elseif(strtolower($type) === 'huissier'){
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $city = $_POST['ville'];
                $experience = $_POST['experience'];
                $tarif = $_POST['tarif'];
                $type_actes = $_POST['type_actes'];
                $password = $_POST['password'];
                $diplomes = $_FILES['diplomes'];

                // save file

                $url = $this->uploadDocuments($diplomes);
                if (!$url) {
                $_SESSION['error'] = "Erreur lors de l'upload du document";
                exit;
                }

                $client = new Demande($name, $email, $phone, $tarif, $experience, $url, 'pending', $city,null, null, $type_actes);
                $clientRepo = new DemandeRepo();
                $clientcreated = $clientRepo->createHuissier($client);
                header("location: /../views/home.php");
                exit;
            }
        }

        
    }
    private function uploadDocuments($files) {
    $uploadDir = __DIR__ . '/../public/documents/';
    
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    if (!isset($files['name'][0]) || $files['error'][0] !== 0) {
        return false;
    }
    
    $extension = pathinfo($files['name'][0], PATHINFO_EXTENSION);
    $fileName = time() . '_' . uniqid() . '.' . $extension;
    
    $tmpPath = $files['tmp_name'][0];
    $finalPath = $uploadDir . $fileName;
    
    if (move_uploaded_file($tmpPath, $finalPath)) {
        return $fileName;
    }
    
    return false;
}
}


?>
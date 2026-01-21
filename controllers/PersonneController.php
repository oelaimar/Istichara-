<?php
namespace controllers;

use repositories\VilleRepo;
use repositories\AvocatRepo;
use repositories\HussierRepo;
use services\Mailer;
require_once __DIR__ . '/../helper/Validator.php';

class PersonneController{
    public function createForm() {
        // recuperation des villes via  repo
        $villeRepo = new VilleRepo();
        $villes = $villeRepo->affichage();
        
        require_once __DIR__ . '/../views/Form.php';  
    }

    // apres la soumission
    public function create() {
        if (isset($_POST['submit'])){ 
            $name = $_POST['name'];
            $email =$_POST['email'];
            $phone =$_POST['phone'];
            $city_id = (int) $_POST['ville'];
            $role = $_POST['role'];
            
            
              $data = [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'city_id' => $city_id  
            ];
            
            $success = false;
                if ($role === 'avocat') {
                    $data['years_of_experiences'] = (int) $_POST['expYears'];
                    $data['hourly_rate'] = (float) $_POST['hourlyRate'];
                    $data['specialization'] = $_POST['specialisation'];
                    $data['consultation_online'] = isset($_POST['consultationOnline']) ? 1 : 0;
                    
                    // insertion en lawyer
                    $repo = new AvocatRepo();
                    $success = $repo->create($data);
                } elseif ($role === 'hussier') {
                    $data['years_of_experiences'] = (int) $_POST['expYears'];
                    $data['hourly_rate'] = (float) $_POST['hourlyRate'];
                    $data['type'] = $_POST['type'];
                    
                    // insertion en huissier
                    $repo = new HussierRepo();
                    $success = $repo->create($data);
                } else {
                    echo "Role invalide.";
                    return;
                }
           
            
            if ($success) {
                // envoi de mail automatique

                Mailer::sendWelcomeEmail($email, $name, $role);
                
                header('Location: index.php?controller=dashboard&action=dashboard');
                exit;
            } else {
                echo "Erreur lors de l'enregistrement.";
            }
        } else {
            header('Location: index.php?controller=personne&action=createForm');
            exit;
        }
    }
}   
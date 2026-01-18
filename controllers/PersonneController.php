<?php
namespace controllers;

use repositories\VilleRepo;
use repositories\AvocatRepo;
use repositories\HussierRepo;
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
            $villeId = (int) $_POST['ville'];
            $role = $_POST['role'];
            
            
              $data = [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'ville_id' => $villeId  
            ];
            
            $success = false;
            if ($role === 'avocat') {
                $data['exp_years'] = (int) $_POST['expYears'];
                $data['hourly_rate'] = (float) $_POST['hourlyRate'];
                $data['specialisation'] = $_POST['specialisation'];
                $data['consultation_online'] = isset($_POST['consultationOnline']) ? 1 : 0;
                
                // insertion en lawyer
                $repo = new AvocatRepo();
                $success = $repo->create($data);
            } elseif ($role === 'hussier') {
                $data['exp_years'] = (int) $_POST['expYears'];
                $data['hourly_rate'] = (float) $_POST['hourlyRate'];
                $data['type'] = $_POST['type'];
                
                // insertion en huissier
                $repo = new HussierRepo();
                $success = $repo->create($data);
            } else {
                echo "Role invalide.";
                return;
            }
            
            // Gestion du résultat
            if ($success) {
                header('Location: index.php?controller=personne&action=afficher');
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
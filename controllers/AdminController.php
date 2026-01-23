<?php
namespace controllers;

use repositories\DemandeRepo;
use repositories\AvocatRepo;
use repositories\HussierRepo;
use repositories\UserRepo;
use helper\Database;
use models\User;

class AdminController {

    public function validationCompte() {
        $demandeRepo = new DemandeRepo();
        $pendingPros = $demandeRepo->getPending();
        require_once __DIR__ . '/../views/ValidationCompte.php';
    }

    public function accept() {
        if(isset($_POST['id'])) {
            $id = $_POST['id'];
            
            $validerCompte = new \services\ValiderCompte();
            $result = $validerCompte->validerProfessionnel($id);
            
            if ($result !== true) {
                echo "Error: " . $result; 
            }
            
            header('Location: index.php?controller=admin&action=validationCompte');
            exit;
        }
    }

    public function reject() {
        if(isset($_POST['id'])) {
            $id = $_POST['id'];
            $demandeRepo = new DemandeRepo();
            $demandeRepo->updateStatus($id, 'rejected');
            header('Location: index.php?controller=admin&action=validationCompte');
            exit;
        }
    }
}

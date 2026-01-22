<?php
namespace controllers;

use repositories\DemandeRepo;
use repositories\AvocatRepo;
use repositories\HussierRepo;
use repositories\UserRepo;
use helper\Database;

class AdminController {

    public function validationCompte() {
        $demandeRepo = new DemandeRepo();
        $pendingPros = $demandeRepo->getPending();
        require_once __DIR__ . '/../views/ValidationCompte.php';
    }

    public function accept() {
        if(isset($_POST['id'])) {
            $id = $_POST['id'];
            $demandeRepo = new DemandeRepo();
            $conn = Database::getConnection();
            $conn->beginTransaction();

            try {
                $demande = $demandeRepo->findById($id);
                if(!$demande) throw new \Exception("Demande not found");

                $demandeRepo->updateStatus($id, 'accepted');

                $data = [
                    'name' => $demande['name'],
                    'email' => $demande['email'],
                    'phone' => $demande['phone'],
                    'years_of_experiences' => $demande['years_of_experiences'],
                    'hourly_rate' => $demande['hourly_rate'],
                    'specialization'=>$demande['specialization'],
                    'type'=>$demande['type'],
                    'city_id' => $demande['city_id'],
                    'consultation_online' => $demande['consultation_online'] ?? null
                ];

                $repo = null;
                if (!empty($demande['specialization'])) {
                    // an avocat
                    $data['specialization'] = $demande['specialization'];
                    $repo = new AvocatRepo();
                } elseif (!empty($demande['type'])) {
                    // an hussier
                    $data['type'] = $demande['type'];
                    $repo = new HussierRepo();
                } else {
                    throw new \Exception("Unknown role from data");
                }
                
                if($repo) {
                    $repo->create($data);
                }
                
                $conn->commit();
                
            } catch (\Exception $e) {
                $conn->rollBack();
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

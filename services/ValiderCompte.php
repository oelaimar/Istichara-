<?php
namespace services;
use repositories\AvocatRepo;
use repositories\HussierRepo;
use repositories\DemandeRepo;
use helper\Database;

class ValiderCompte{
    
    private DemandeRepo $demandeRepo;
    private $conn;

    public function __construct() {
        $this->demandeRepo = new DemandeRepo();
        $this->conn = Database::getConnection();
    }

    public function validerProfessionnel($id) {
        $this->conn->beginTransaction();

        try {
            $demande = $this->demandeRepo->findById($id);
            if(!$demande) {
                throw new \Exception("Demande not found");
            }

            $this->demandeRepo->updateStatus($id, 'accepted');

            // if accepted insert data in lawyer or hussier table
            $data = [
                'name' => $demande['name'],
                'email' => $demande['email'],
                'phone' => $demande['phone'],
                'years_of_experiences' => $demande['years_of_experiences'],
                'hourly_rate' => $demande['hourly_rate'],
                'city_id' => $demande['city_id'],
                'consultation_online' => $demande['consultation_online'] ?? 0
            ];

            $repo = null;

            // checking if specialization exists  or type exists 
            if (!empty($demande['specialization'])) {
                // it's an avocat
                $data['specialization'] = $demande['specialization'];
                $repo = new AvocatRepo();
                
            } elseif (!empty($demande['role'])) {
                // it's an hussier
                $data['role'] = $demande['role']; 
                $repo = new HussierRepo();
            } else {
                 throw new \Exception("Unknown role from data");
            }

            if($repo) {
                $repo->create($data);
            }

            $this->conn->commit();
            return true;

        } catch (\Exception $e) {
            $this->conn->rollBack();
            return $e->getMessage();
        }
    }
}
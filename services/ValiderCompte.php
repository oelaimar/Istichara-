<?php
namespace services;
use repositories\AvocatRepo;
use repositories\HussierRepo;
use repositories\DemandeRepo;
use repositories\UserRepo;
use models\User;
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
            $role = '';

            // checking if specialization exists  or type exists 
            if (!empty($demande['specialization'])) {
                // it's an avocat
                $data['specialization'] = $demande['specialization'];
                $repo = new AvocatRepo();
                $role = 'lawyer';
                
            } elseif (!empty($demande['type'])) {
                // it's an hussier
                $data['type'] = $demande['type']; 
                $repo = new HussierRepo();
                $role = 'hussier';
            } else {
                 throw new \Exception("Unknown role from data");
            }

            // check if user already exists
            $userRepo = new UserRepo();
            $existingUser = $userRepo->findByEmail($demande['email']);
            
            if ($existingUser) {
                 $userId = $existingUser['id'];
            } else {
                // create User
                $password = password_hash('12345678', PASSWORD_DEFAULT);
                $user = new User($demande['email'], $password, $role);
                $userId = $userRepo->create($user);
            }
            
            $data['user_id'] = $userId;

            if($repo) {
                $repo->create($data);
            }

            $this->conn->commit();
            return true;

        } catch (\PDOException $e) {
            $this->conn->rollBack();
            return "Database Error: " . $e->getMessage() . " (Code: " . $e->getCode() . ")";
        } catch (\Exception $e) {
            $this->conn->rollBack();
            return "Error: " . $e->getMessage();
        }
    }
}
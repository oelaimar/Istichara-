<?php

namespace repositories;

use PDO;
use models\Reservation;

class ReservationRepo extends BaseRepo {
    protected string $table = "reservation";

    public function findByProfessional(int $id, string $type) {
        $column = ($type === 'lawyer') ? 'lawyer_id' : 'hussier_id';
        $sql = "SELECT r.*, c.name as client_name 
                FROM {$this->table} r
                JOIN client c ON r.client_id = c.id
                WHERE r.{$column} = :id
                ORDER BY r.day DESC, r.horaire ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByClient(int $clientId) {
        $sql = "SELECT r.*, 
                COALESCE(l.name, h.name) as professional_name,
                CASE WHEN r.lawyer_id IS NOT NULL THEN 'Avocat' ELSE 'Huissier' END as professional_type
                FROM {$this->table} r
                LEFT JOIN lawyer l ON r.lawyer_id = l.id
                LEFT JOIN hussier h ON r.hussier_id = h.id
                WHERE r.client_id = :clientId
                ORDER BY r.day DESC, r.horaire ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':clientId' => $clientId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checkAvailability(int $professionalId, string $type, string $day, string $horaire) {
        $column = ($type === 'lawyer') ? 'lawyer_id' : 'hussier_id';
        $sql = "SELECT COUNT(*) as count 
                FROM {$this->table} 
                WHERE {$column} = :id 
                AND day = :day 
                AND horaire = :horaire 
                AND status != 'declined'";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id' => $professionalId,
            ':day' => $day,
            ':horaire' => $horaire
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['count'] == 0;
    }
}

<?php
namespace repositories;
use repositories\BaseRepo;
use PDO;

class DemandeRepo extends BaseRepo {
    protected string $table = "demande";

    public function getPending() {
        $stmt = $this->conn->prepare("SELECT * FROM demande WHERE status = 'pending'");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function updateStatus($id, $status) {
        $stmt = $this->conn->prepare("UPDATE demande SET status = :status WHERE id = :id");
        return $stmt->execute(['status' => $status,
                               'id' => $id
                              ]);
    }

    public function findById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM demande WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
}

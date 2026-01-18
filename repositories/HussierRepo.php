<?php
namespace repositories;

use repositories\BaseRepo;
use models\Hussier;
use helper\Database;
use PDO;

class HussierRepo extends BaseRepo{
    public string $table="hussier";

    public function count():int
    {
        $stmt = $this->conn->query("SELECT COUNT(*) as total FROM hussier");
        return $stmt->fetch()['total'];
    }
    
    // Répartition par ville
    public function getByVille() {
        $stmt = $this->conn->query("SELECT city_id, COUNT(*) as count FROM hussier GROUP BY city_id");
        return $stmt->fetchAll();
    }
}
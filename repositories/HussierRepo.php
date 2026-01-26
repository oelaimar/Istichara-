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

    public function search($keyword, $cityId) {
        $sql = "SELECT hussier.*, city.name as city_name 
                FROM hussier 
                LEFT JOIN city ON hussier.city_id = city.id 
                WHERE hussier.name ILIKE :keyword";
        $params = [':keyword' => "%$keyword%"];

        if (!empty($cityId)) {
            $sql .= " AND hussier.city_id = :cityId";
            $params[':cityId'] = $cityId;
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}
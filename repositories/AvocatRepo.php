<?php
namespace repositories;
use repositories\BaseRepo;
use models\Avocat;
use helper\Database;
use PDO;

class AvocatRepo extends BaseRepo{
    public string $table="lawyer";


    public function count() {
        $stmt = $this->conn->query("SELECT COUNT(*) as total FROM lawyer");
        return $stmt->fetch()['total'];
    }
    
    // répartition par ville
    public function getByVille() {
        $stmt = $this->conn->query("SELECT city_id, COUNT(*) as count FROM lawyer GROUP BY city_id");
        return $stmt->fetchAll();
    }
    
    // Top 3 par années d'expérience
    public function getTopByExperience($limit = 3) {
        $stmt = $this->conn->prepare("SELECT name, years_of_experiences FROM lawyer ORDER BY years_of_experiences DESC LIMIT :limit");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function search($keyword, $cityId) {
        $sql = "SELECT lawyer.*, city.name as city_name 
                FROM lawyer 
                LEFT JOIN city ON lawyer.city_id = city.id 
                WHERE lawyer.name ILIKE :keyword";
        $params = [':keyword' => "%$keyword%"];

        if (!empty($cityId)) {
            $sql .= " AND lawyer.city_id = :cityId";
            $params[':cityId'] = $cityId;
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}

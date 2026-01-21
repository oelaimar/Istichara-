<?php
namespace repositories;
use repositories\BaseRepo;
use models\Ville;
use helper\Database;
use PDO;

class VilleRepo extends BaseRepo
{
    public string $table = "city";

    public function getVilleNames()
    {
        $stmt = $this->conn->query("SELECT id, name FROM city");
        return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    }

    public function countVilles()
    {
        $stmt = $this->conn->query("SELECT COUNT(*) FROM city");
        return $stmt->fetchColumn();
    }

    public function getPaginatedVilles($limit, $offset)
    {
        $stmt = $this->conn->prepare("SELECT * FROM city LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
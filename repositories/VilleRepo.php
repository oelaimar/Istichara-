<?php
namespace repositories;
use repositories\BaseRepo;
use models\Ville;
use helper\Database;
use PDO;

class VilleRepo extends BaseRepo{
    public string $table="city";

    public function getVilleNames() {
        $stmt = $this->conn->query("SELECT id, name FROM city");
        return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    }
}
<?php
namespace repositories;
use repositories\BaseRepo;
use models\Avocat;
use helper\Database;
use PDO;
class StatistiquesRepo extends BaseRepo{
    public function getTotal(){
         $stmt = $this->conn->query("SELECT (SELECT SUM(hourly_rate)FROM lawyer)+(SELECT SUM(hourly_rate) FROM hussier) AS total_chiffre");
        return $stmt->fetch()['total_chiffre'];
    }

    public function getTotalDemand(){
        $stmt = $this->conn->query("SELECT COUNT(*)AS total_demand FROM demand ");
        return $stmt->fetch()['total_demand'];
    }
}

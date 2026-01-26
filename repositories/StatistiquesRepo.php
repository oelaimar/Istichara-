<?php
namespace repositories;
use repositories\BaseRepo;
use models\Avocat;
use helper\Database;
use PDO;
class StatistiquesRepo extends BaseRepo{
    public function getTotal(){
         $stmt = $this->conn->query("SELECT 
            (SELECT COALESCE(SUM(hourly_rate), 0) FROM lawyer) + 
            (SELECT COALESCE(SUM(hourly_rate), 0) FROM hussier) 
            AS total_chiffre");
        return $stmt->fetch()['total_chiffre'];
    }

    public function getTotalDemand(){
        $stmt = $this->conn->query("SELECT COUNT(*)AS total_demand FROM demande ");
        return $stmt->fetch()['total_demand'];
    }

    public function countClient(){
        $stmt = $this->conn->query("SELECT COUNT(*) AS total_client FROM client ");
        $res=$stmt->fetch();
        // var_dump($res);:
        return $res['total_client'];
    }
}

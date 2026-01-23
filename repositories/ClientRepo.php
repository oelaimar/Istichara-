<?php
namespace repositories;
use models\Client;
use helper\Database;
use PDO;

class ClientRepo{
    private PDO $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function create(Client $client){
        $sql = 'INSERT INTO "client" (user_id, name, phone, city_id)
            VALUES(:user_id, :name, :phone, :city_id) RETURNING id';
        $stmt = $this->conn->prepare($sql);
        $result = $stmt->execute([
            ':user_id' => $client->getUserId(),
            ':name' => $client->getName(),
            ':phone' => $client->getPhone(),
            ':city_id' => $client->getCityId()
        ]);
        
        echo "execute scss";
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $client->setId($row['id']);
        return $result;
    }

}

?>

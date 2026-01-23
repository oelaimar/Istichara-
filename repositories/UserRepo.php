<?php

namespace repositories;

use models\User;
use models\Avocat;
use helper\Database;
use PDO;

class UserRepo{
    private PDO $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }
    public function create(User $user){
        $sql = 'INSERT INTO "user"(email, password, role)
            VALUES(:email, :password, :role)';
        $stmt = $this->conn->prepare($sql);
        $result = $stmt->execute([
            ':email' => $user->getEmail(),
            ':password' => $user->getPassword(),
            ':role' => $user->getRole(), 
        ]);
        $user_id = $this->conn->lastInsertId();
        $user->setId($user_id);
        return $user_id;

    }

    public function createAvocat(User $user){
        $sql = 'INSERT INTO "user"(email, password, role)
            VALUES(:email, :password, :role)';
        $stmt = $this->conn->prepare($sql);
        $result = $stmt->execute([
            ':email' => $user->getEmail(),
            ':password' => $user->getPassword(),
            ':role' => $user->getRole(),
        ]);
        $user_id = $this->conn->lastInsertId();
        $user->setId($user_id);
        return $user_id;

    }

}


?>
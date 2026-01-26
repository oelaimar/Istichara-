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
            VALUES(:email, :password, :role) RETURNING id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':email' => $user->getEmail(),
            ':password' => $user->getPassword(),
            ':role' => $user->getRole(), 
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $user_id = $row['id'];
        $user->setId($user_id);
        return $user_id;

    }

   public function findByEmail($email) {
        $stmt = $this->conn->prepare('SELECT * FROM "user" WHERE email = :email');
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

}


?>
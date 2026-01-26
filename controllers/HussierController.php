<?php

namespace controllers;

use helper\Database;
use models\Hussier;
use models\Type;
class HussierController{

public function showProfile(): void
    {
        $id = $_GET['id'] ;

        
        
        $conn = Database::getConnection();
              $conn->prepare("UPDATE hussier SET viewers = viewers + 1 WHERE id = :id")
            ->execute(["id" => $id]);
        $stmt = $conn->prepare("SELECT * FROM hussier WHERE id = :id");
        $stmt->execute(["id" => $id]);
        $data = $stmt->fetch();

         $type = $data['type'];
           $Hussier = new Hussier(
            $data['name'],
            "",
            0.0,
            (int)$data['years_of_experiences'],
            "",
            (int)$data['viewers'],
            type::from($type),
            false
        );
     require __DIR__ . "/../views/ShowHussierprofile.php";
}
}
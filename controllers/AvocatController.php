<?php
namespace controllers;

use helper\Database;
use models\Avocat;
use models\Specialisation;

class AvocatController {

    public function showProfile(): void
    {
        $id = $_GET['id'] ;
        
        
        $conn = Database::getConnection();
              $conn->prepare("UPDATE lawyer SET viewers = viewers + 1 WHERE id = :id")
            ->execute(["id" => $id]);
        $stmt = $conn->prepare("SELECT * FROM lawyer WHERE id = :id");
        $stmt->execute(["id" => $id]);
        $data = $stmt->fetch();

        $spec = $data['specialization'];

        $avocat = new Avocat(
            $data['name'],
            "",
            0.0,
            (int)$data['years_of_experiences'],
            "",
            (int)$data['viewers'],
            Specialisation::from($spec),
            false
        );


  

        require __DIR__ . "/../views/ShowAvocatprofile.php";
    }
}

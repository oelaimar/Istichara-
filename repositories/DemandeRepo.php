<?php
namespace repositories;
use models\Avocat;
use models\Demande;
use models\Hussier;
use helper\Database;
use PDO;

class DemandeRepo{
    private PDO $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function createAvocat(Demande $avocat){
        $sql = 'INSERT INTO "demande" (name, email, phone, years_of_experiences, hourly_rate, specialization, consultation_online, city_id, document, status)
            VALUES(:name, :email, :phone, :years_of_experiences, :hourly_rate, :specialization, :consultation_online, :city_id, :document, :status) RETURNING id';
        $stmt = $this->conn->prepare($sql);
        $result = $stmt->execute([
            ':name' => $avocat->getName(),
            ':email' => $avocat->getEmail(),
            ':phone' => $avocat->getPhone(),
            ':years_of_experiences' => $avocat->getExpYears(),
            ':hourly_rate' => $avocat->getHourlyRate(),
            ':specialization' => $avocat->getspecialization(),
            ':consultation_online' => $avocat->isConsultationOnline(),
            ':city_id' => $avocat->getCityId(),
            ':document' => $avocat->getDocument(),
            ':status' => $avocat->getStatus(),
        ]);
        return $result;
    }

    public function createHuissier(Demande $huissier){
        $sql = 'INSERT INTO "demande" (name, email, phone, years_of_experiences, hourly_rate, type, city_id, document, status)
            VALUES(:name, :email, :phone, :years_of_experiences, :hourly_rate, :type, :city_id, :document, :status) RETURNING id';
        $stmt = $this->conn->prepare($sql);
        $result = $stmt->execute([
            ':name' => $huissier->getName(),
            ':email' => $huissier->getEmail(),
            ':phone' => $huissier->getPhone(),
            ':years_of_experiences' => $huissier->getExpYears(),
            ':hourly_rate' => $huissier->getHourlyRate(),
            ':type' => $huissier->getType(),
            ':city_id' => $huissier->getCityId(),
            ':document' => $huissier->getDocument(),
            ':status' => $huissier->getStatus(),
        ]);
        return $result;
    }
}

?>
use repositories\BaseRepo;
use PDO;

class DemandeRepo extends BaseRepo {
    protected string $table = "demande";

    public function getPending() {
        $stmt = $this->conn->prepare("SELECT * FROM demande WHERE status = 'pending'");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function updateStatus($id, $status) {
        $stmt = $this->conn->prepare("UPDATE demande SET status = :status WHERE id = :id");
        return $stmt->execute(['status' => $status,
                               'id' => $id
                              ]);
    }

    public function findById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM demande WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
}

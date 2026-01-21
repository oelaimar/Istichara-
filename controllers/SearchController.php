<?php
namespace controllers;

use repositories\AvocatRepo;
use repositories\HussierRepo;
use repositories\VilleRepo;

class SearchController {
    public function index() {
        $villeRepo = new VilleRepo();
        $cities = $villeRepo->affichage();

        $keyword = $_GET['nom'] ?? '';
        $cityId = $_GET['city'] ?? '';

        $avocats = [];
        $huissiers = [];

        $avocatRepo = new AvocatRepo();
        $hussierRepo = new HussierRepo();

        $avocats = $avocatRepo->search($keyword, $cityId);
        $huissiers = $hussierRepo->search($keyword, $cityId);

        require_once __DIR__ . '/../views/search.php';
    }

    public function book() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reservationRepo = new \repositories\ReservationRepo();
            
            $data = [
                'lawyer_id' => !empty($_POST['lawyer_id']) ? $_POST['lawyer_id'] : null,
                'hussier_id' => !empty($_POST['hussier_id']) ? $_POST['hussier_id'] : null,
                'client_id' => 1, // Temporaire: à remplacer par l'ID de la session
                'day' => $_POST['day'],
                'horaire' => $_POST['time'],
                'is_online' => isset($_POST['is_online']) ? 1 : 0,
                'status' => 'pending'
            ];

            // Vérifier la disponibilité
            $profId = $data['lawyer_id'] ?? $data['hussier_id'];
            $type = $data['lawyer_id'] ? 'lawyer' : 'hussier';
            
            if ($reservationRepo->checkAvailability((int)$profId, $type, $data['day'], $data['horaire'])) {
                if ($reservationRepo->create($data)) {
                    $_SESSION['success'] = "Votre rendez-vous a été réservé avec succès.";
                } else {
                    $_SESSION['error'] = "Une erreur est survenue lors de la réservation.";
                }
            } else {
                $_SESSION['error'] = "Ce créneau n'est plus disponible.";
            }

            header('Location: index.php?controller=search&action=index');
            exit;
        }
    }
}

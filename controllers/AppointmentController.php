<?php

namespace controllers;

use repositories\ReservationRepo;

class AppointmentController {
    public function clientAppointments() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $repo = new ReservationRepo();
        $clientId = 1; // Temporaire
        $appointments = $repo->findByClient($clientId);
        
        require_once __DIR__ . '/../views/my_appointments.php';
    }

    public function manage() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $repo = new ReservationRepo();
        
        // Simuler un pro connecté pour la démo
        $profId = $_GET['id'] ?? 1;
        $type = $_GET['type'] ?? 'lawyer';
        
        $appointments = $repo->findByProfessional($profId, $type);
        
        require_once __DIR__ . '/../views/manage_appointments.php';
    }

    public function updateStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $repo = new ReservationRepo();
            $id = (int)$_POST['id'];
            $status = $_POST['status'];
            $meetingLink = $_POST['meeting_link'] ?? null;
            
            $data = ['status' => $status];
            if ($meetingLink) {
                $data['meeting_link'] = $meetingLink;
            }
            
            if ($repo->update($id, $data)) {
                $_SESSION['success'] = "Le statut du rendez-vous a été mis à jour.";
            } else {
                $_SESSION['error'] = "Erreur lors de la mise à jour.";
            }
            
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }
}

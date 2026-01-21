<?php
namespace controllers;

use repositories\AvocatRepo;
use repositories\HussierRepo;
use repositories\VilleRepo;
use repositories\StatistiquesRepo;

class DashboardController {
    public function dashboard() {
        $avocatRepo = new AvocatRepo();
        $hussierRepo = new HussierRepo();
        $villeRepo = new VilleRepo();
        $statistiquesRepo = new StatistiquesRepo();

        // 1. Statistiques Globales
        $totalChiffre = $statistiquesRepo->getTotal();
        $totalDemand = $statistiquesRepo->getTotalDemand();
        $totalAvocats = $avocatRepo->count();
        $totalHuissiers = $hussierRepo->count(); 

        // 2. Préparation de TOUTES les données par ville
        $avocatsByVille = $avocatRepo->getByVille();
        $huissiersByVille = $hussierRepo->getByVille();
        $villeNames = $villeRepo->getVilleNames();
        
        $allStatsCity = [];
        foreach ($villeNames as $id => $name) {
            $allStatsCity[$id] = [
                'ville' => $name,
                'avocats' => 0,
                'huissiers' => 0
            ];
        }

        foreach ($avocatsByVille as $row) {
            if(isset($allStatsCity[$row['city_id']])) {
                $allStatsCity[$row['city_id']]['avocats'] = $row['count'];
            }
        }

        foreach ($huissiersByVille as $row) {
            if(isset($allStatsCity[$row['city_id']])) {
                $allStatsCity[$row['city_id']]['huissiers'] = $row['count'];
            }
        }

        // 3. LOGIQUE DE PAGINATION (sur le tableau complet)
        $parPage = 6;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        
        $totalVilles = count($allStatsCity);
        $totalPages = ceil($totalVilles / $parPage);
        $offset = ($page - 1) * $parPage;

        // On découpe le tableau complet pour n'avoir que les 6 villes de la page actuelle
        // array_slice préserve l'ordre des éléments
        $statsCity = array_slice($allStatsCity, $offset, $parPage, true);

        // 4. Autres données
        $topAvocats = $avocatRepo->getTopByExperience(3);
        
        require_once __DIR__ . '/../views/Dashboard.php';  
    }
}
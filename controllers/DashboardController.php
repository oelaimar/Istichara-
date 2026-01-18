<?php
namespace controllers;

use repositories\AvocatRepo;
use repositories\HussierRepo;
use repositories\VilleRepo;

class DashboardController {
    public function dashboard() {
        $avocatRepo = new AvocatRepo();
        $hussierRepo = new HussierRepo();
        $villeRepo = new VilleRepo();
        
        $totalAvocats = $avocatRepo->count();
        $totalHuissiers = $hussierRepo->count(); 
        
        $avocatsByVille = $avocatRepo->getByVille();
        $huissiersByVille = $hussierRepo->getByVille();
        $villeNames = $villeRepo->getVilleNames();
        
        $topAvocats = $avocatRepo->getTopByExperience(3);
        
        $statsCity = [];
        foreach ($villeNames as $id => $name) {
            $statsCity[$id] = [
                'ville' => $name,
                'avocats' => 0,
                'huissiers' => 0
            ];
        }
        foreach ($avocatsByVille as $row) {
            $statsCity[$row['city_id']]['avocats'] = $row['count'];
        }
        foreach ($huissiersByVille as $row) {
            $statsCity[$row['city_id']]['huissiers'] = $row['count'];
        }
        //  var_dump($statsCity);
        
        require_once __DIR__ . '/../views/Dashboard.php';  
    }
}
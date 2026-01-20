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
}

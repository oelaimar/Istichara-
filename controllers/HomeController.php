<?php
namespace controllers;

class HomeController {
    public function home() {
        require_once __DIR__ . '/../views/home.php';
    }
}

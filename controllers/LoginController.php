<?php

namespace controllers;

use repositories\UserRepo;
use models\User;
require_once __DIR__ . '/../helper/Validator.php';

class LoginController{
    public function loginForm() {
        
        require_once __DIR__ . '/../views/LoginForm.php';
    }
    public function login() {
        if(isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            if(empty($email) || empty($password)){
                $_SESSION['error'] = "Veuillez remplir tous les champs";
                header("Location: index.php?controller=login&action=loginForm");
                exit;
            }
            $userRepo = new UserRepo();
            $user = $userRepo->findByEmail($email);

            if(!$user){
                $_SESSION['error'] = "Email ou mot de passe incorrect";
                header("Location: index.php?controller=login&action=loginForm");
                exit;
            }
            if($password !== $user['password']){
                echo "Email ou mot de passe incorrect";
                header("Location: index.php?controller=login&action=loginForm");
                exit;
            }
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['success'] = 'connexion reussie';

            header("location: index.php?controller=home&action=home");
        }
    }
    public function logout(){
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php?controller=login&action=loginForm");
        exit;
    }
}
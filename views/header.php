<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>ISTICHARA</title>
<link rel="stylesheet" href="<?= BASE_URL ?>/public/style.css">
<script src="<?= BASE_URL ?>/public/script.js" defer></script>
</head>
<body>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header>
  <div class="logo">
    <span>ISTICHARA</span>
    <span style="color: var(--gold);">⚖️</span>
  </div>
  
  <nav>
    <a href="index.php?controller=home&action=home">Accueil</a>
    
    <?php if (isset($_SESSION['user_id'])): ?>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <a href="index.php?controller=admin&action=validationCompte">Validation Comptes</a>
            <a href="index.php?controller=dashboard&action=dashboard">Dashboard</a>
        <?php elseif (isset($_SESSION['role']) && ($_SESSION['role'] === 'avocat' || $_SESSION['role'] === 'hussier')): ?>
             <a href="index.php?controller=appointment&action=manage">Mon Espace Pro</a>
             <a href="index.php?controller=appointment&action=clientAppointments">Mes RDV</a>
        <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'client'): ?>
             <a href="index.php?controller=search&action=index">Trouver un expert</a>
             <a href="index.php?controller=appointment&action=clientAppointments">Mes RDV</a>
        <?php endif; ?>
    <?php else: ?>
        <a href="index.php?controller=search&action=index">Trouver un expert</a>
        <a href="index.php?controller=personne&action=RegisterProForm">Rejoindre en tant que Pro</a>
    <?php endif; ?>
  </nav>

  <div class="nav-actions">
    

    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="logout.php" class="btn-nav ghost">Déconnexion</a>
    <?php else: ?>
        <a href="./LoginForm.php" class="btn-nav ghost">Connexion</a>
        <a href="index.php?controller=personne&action=createForm" class="btn-nav primary">S'inscrire</a>
    <?php endif; ?>
  </div>
</header>


<!-- CONSULTATION -->
<!-- <div id="consultation" class="page">
  <div class="form-box">
    <h2>Nouvelle demande</h2>
    <select>
      <option>Droit civil</option>
      <option>Droit pénal</option>
      <option>Droit famille</option>
    </select>
    <input type="text" placeholder="Sujet">
    <textarea rows="5" placeholder="Décrivez votre problème"></textarea>
    <button class="btn" onclick="alert('Demande envoyée !')">Envoyer</button>
  </div>
</div> -->


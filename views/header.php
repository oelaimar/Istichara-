<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>ISTICHARA</title>
<link rel="stylesheet" href="../public/style.css">
<script src="../public/script.js" defer></script>
</head>
<body>

<header>
  <div class="logo">ISTICHARA ⚖️</div>
  <nav>
    <a onclick="showPage('home')">Accueil</a>
    <a onclick="showPage('login')">Connexion</a>
  </nav>
</header>


<!-- CONSULTATION -->
<div id="consultation" class="page">
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
</div>


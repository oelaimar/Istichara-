<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>ISTICHARA</title>
<style>
:root{
  --blue:#0F2A44;
  --gold:#C9A24D;
  --light:#F9FAFC;
  --gray:#E5E7EB;
}

*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:Inter, Arial;
}

body{
  background:var(--light);
}

/* HEADER */
header{
  background:var(--blue);
  color:white;
  padding:20px 60px;
  display:flex;
  justify-content:space-between;
  align-items:center;
}

.logo{
  font-size:26px;
  font-weight:bold;
  color:var(--gold);
}

nav a{
  color:white;
  margin-left:20px;
  text-decoration:none;
  cursor:pointer;
}

/* BUTTON */
.btn{
  background:var(--blue);
  color:white;
  padding:12px 25px;
  border:none;
  border-radius:8px;
  cursor:pointer;
  display:inline-block;
  margin-top:10px;
}

/* HERO */
.hero{
  margin-top: 5rem;
  padding:80px;
  text-align:center;
}

.hero h1{
  font-size:40px;
  color:var(--blue);
}

.hero p{
  margin:20px 0;
  color:#555;
}

/* FORMS */
.register-container{
    max-width:1100px;
    margin:40px auto;
    background:#fff;
    padding:40px;
    border-radius:12px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
}

.register-container h2{
    text-align:center;
    color:var(--blue);
    margin-bottom:30px;
}

/* Inputs row */
.form-row{
    display:grid;
    grid-template-columns: repeat(3, 1fr);
    gap:20px;
    margin-bottom:25px;
}

.form-group label{
    font-weight:600;
    margin-bottom:6px;
    display:block;
}

.form-group input{
    width:100%;
    padding:12px;
    border:1px solid var(--gray);
    border-radius:6px;
}

/* Section label */
.section-label{
    font-weight:600;
    margin-bottom:15px;
    display:block;
}

/* Role cards */
.role-row{
    display:grid;
    grid-template-columns: 1fr 1fr;
    gap:20px;
    margin-bottom:30px;
}

.role-card{
    border:2px solid var(--gray);
    padding:18px;
    border-radius:10px;
    text-align:center;
    font-weight:600;
    cursor:pointer;
    transition:0.3s;
}

.role-card input{
    display:none;
}

.role-card:hover{
    border-color:var(--blue);
    background:#f2f6fa;
}

.role-card input:checked + span{
    font-weight:bold;
}

/* Button */
.submit-btn{
    width:50%;
    padding:16px;
    background:var(--blue);
    color:white;
    border:none;
    border-radius:8px;
    font-size:16px;
    cursor:pointer;
    margin-left: 17rem;
}


/* DASHBOARD */
.dashboard{
  display:flex;
}

.sidebar{
  width:220px;
  height:100vh;
  background:var(--blue);
  color:white;
  padding:20px;
}

.sidebar a{
  display:block;
  margin:15px 0;
  cursor:pointer;
}

.content{
  flex:1;
  padding:40px;
}

.card{
  background:white;
  padding:20px;
  border-radius:10px;
  box-shadow:0 10px 20px rgba(0,0,0,.05);
  margin-bottom:20px;
}

/* HIDE */
.page{
  display:none;
}
.active{
  display:block;
}
</style>
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


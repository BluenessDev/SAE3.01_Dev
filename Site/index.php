<?php
echo "<!DOCTYPE html>
<html lang='fr' class='inscription'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width'>
    <title>Accueil</title>
    <link href='assets/style.css'' rel='stylesheet' type='text/css'/>
    <link href='assets/logo.png' rel='icon'>
</head>
<body>";

$host = "localhost";
$username = "root";
$password = "root";

$conn = mysqli_connect($host, $username, $password) or die("erreur de connexion");

$namedb = "sae";
$db = mysqli_select_db($conn, $namedb) or die("erreur de connexion base");

session_start();

if (isset($_SESSION['login'])) {
    $utilisateur = $_SESSION['login'];
    echo "<header role='banner'>
  <nav role='navigation'>
    <ul class='nav-list'>
      <li><a href='logout.php?out' class='goldnav-button'>Se déconnecter</a></li>
    </ul>
  </nav>
  <br>
  <br>
  <div class='inheader'>
    <a href='index.php'><img src='assets/logo.png' alt='logo du site tickimoa'></a>
    <div class='title'>
      <h1>Ravi de vous revoir <span style='text-transform:uppercase'>$utilisateur</span></h1>
      <h1 class='highlight'>Vous êtes sur la page d'accueil</h1>
    </div>
  </div>
  <br>
  <br>
  <br>
</header>";
    include 'dashboard.html';
} else {
    include 'banner.html';
    include 'main.html';
}

include 'footer.html';
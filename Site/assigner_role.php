<?php
session_start();
$utilisateur = $_SESSION['login'];

if (isset($_SESSION['login'])) {
    $host = "localhost";
    $username = "root";
    $password = "root";

    $conn = mysqli_connect($host, $username, $password) or die("erreur de connexion");

    $namedb = "sae";
    $db = mysqli_select_db($conn, $namedb) or die("erreur de connexion base");

    $users_table = "users";
    include "functions.php";
    echo "<!DOCTYPE html>
<html lang='fr' class='inscription'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width'>
    <title>Assignation des Users</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN' crossorigin='anonymous'>
    <link href='assets/style.css' rel='stylesheet' type='text/css'/>
    <link href='assets/logo.png' rel='icon'>
</head>
<body>
<header role='banner'>
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
      <h1 class='highlight'>Vous êtes sur la page d'assignation des rôles</h1>
    </div>
  </div>
  <br>
  <br>
  <br>
</header>
<main role='main'>
    <div class='article'>
        <div class='main-article'>
                <div class='subarticle' id='form'>
                    <div class='titre' id='formtit'>
                        <h2 class='highlight2'>Liste des Utilisateurs et Techniciens :</h2>
                    </div>
                    <div class='userTable'>";
    afficherUtilisateurs();
    echo "</div>
                    <form action='index.php' method='post'>
                    <br>
                        <div class='submit_ticket align-content-center mt-3'>
                            <input type='submit' id='confirmer' value='Retour' class='btn btn-primary mr-2'>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</main>

<footer class='bg-dark text-white text-center py-3 fixed-bottom''>";
    include 'footer.html';
    echo "</footer>";
} else {
    header('Location: index.php');
}

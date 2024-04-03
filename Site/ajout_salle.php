<?php

echo "<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width'>
    <title>Ajout salle</title>
    <link href='assets/style.css' rel='stylesheet' type='text/css'/>
    <link href='assets/logo.png' rel='icon'>
</head>";

include 'functions.php';

$host = "localhost";
$username = "root";
$password = "root";

$conn = mysqli_connect($host, $username, $password) or die("erreur de connexion");

$namedb = "sae";
$db = mysqli_select_db($conn, $namedb) or die("erreur de connexion base");

session_start();

$table = "salle";

if (isset($_SESSION['login'])) {
    $utilisateur = $_SESSION['login'];
    if (isset($_POST['salle'])) {
        //initialisation des champs du ticket pour la BD
        $clean_salle = strip_tags($_POST['salle']);

        $salle = $clean_salle;

        if ($salle != "") {
        //Insertion de la salle dans la BD
        $requete_ticket = "INSERT INTO $table (salle) values (?)";
        $reqpre_ticket = mysqli_prepare($conn, $requete_ticket); //Prépare la requete requete_ticket.
        mysqli_stmt_bind_param($reqpre_ticket, "s", $salle); // Permet de lier les valeurs aux marqueurs de position (?) dans la requête préparée.
        mysqli_stmt_execute($reqpre_ticket); //Execute la requete
        header('Location: index.php');
        } else {
            header('Location: ajout_salle.php');
        }
    }

    echo "<body>
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
                <h1 class='highlight'>Vous êtes sur la page Création De Tickets</h1>
            </div>
        </div>
        <br>
        <br>
        <br>
    </header>
    <main role='main'>
        <div class='main'>
            <div class='article'>
                 <div class='main-article'>
                    <div class='subarticle' id='form'>
                        <div class='titre' id='formtit'>
                            <h2 class='highlight2'>Formulaire d'ajout de salle</h2>
                        </div>
                        <form action='' method='post' class='form_salle' id='form_salle'>                        
                            <div class='salle'>
                                <label for='salle'>Salle à ajouter</label>
                                <input type='text' name='salle' id='salle' required>
                            </div>
                            
                            <br>
                            
                            <div class='submit_salle'>
                                <input type='submit' id='confirmer' value='Confirmer'>
                            </div>
                    </form>
                    </div>
                </div>
            </div>        
        </div>
    </main>
    </body>";

    include 'footer.html';
}else {
    header('Location: index.php');
}

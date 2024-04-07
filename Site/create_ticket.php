<?php

echo "<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width'>
    <title>Tickets</title>
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

if (isset($_SESSION['login'])) {
    $utilisateur = $_SESSION['login'];
    if (isset($_POST['nature_pb'], $_POST['niveau'], $_POST['salle'], $_POST['demandeur'], $_POST['pers_conc'], $_POST['description'])){
        $clean_nature = strip_tags($_POST['nature_pb']);
        $clean_niveau = strip_tags($_POST['niveau']);
        $clean_salle = strip_tags($_POST['salle']);
        $clean_demandeur = strip_tags($_POST['demandeur']);
        $clean_pers_conc = strip_tags($_POST['pers_conc']);
        $clean_description = strip_tags($_POST['description']);

        //on crée le ticket
        $result = creer_ticket($clean_nature, $clean_niveau, $clean_salle, $clean_demandeur, $clean_pers_conc, $clean_description);

        if ($result) {
            header('Location: index.php');
        } else {
            header('Location: create_ticket.php?error=1');
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
                <h1 class='highlight'>Vous êtes sur la page création de tickets</h1>
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
                            <h2 class='highlight2'>Créer un ticket</h2>
                        </div>
                        <form action='' method='post' class='formulaire'>
                        <blockquote>Pour creer un ticket merci de préciser la nature du problème, le niveau d’urgence estimée par le demandeur, la salle, le demandeur, la personne concernée par le problème et une description (300 caracteres) si nécessaire. </blockquote>
                        
                        <div class='left'>
                            <div class='nature_pb'>
                                <label for='nature_pb'>Nature du probleme :</label>
                                <select name='nature_pb' id='nature_pb' required>
                                    <option>Problèmes de périphériques </option>
                                    <option>Problèmes de logiciel</option>
                                    <option>Problèmes de connectivité</option>
                                    <option>Problèmes de matériel </option>
                                    <option value = 'Non specifie'> Autre ... </option>
                                </select>
                            </div>
                            
                            <div class='niveau'>
                                <label for='niveau'>Niveau de probleme estimée :</label>
                                <select name='niveau' id='niveau'>
                                    <option value='1'>Niveau 1</option>
                                    <option value='2'>Niveau 2</option>
                                    <option value='3'>Niveau 3</option>
                                    <option value='4'>Niveau 4</option>
                                </select>
                            </div>
                            
                            <div class='salle'>
                                <label for='salle'>Salle où se situe le problème :</label>
                                <select name='salle' id='salle'>";
    $get_salle = mysqli_query($conn, 'SELECT * FROM salle');

    while ($row = mysqli_fetch_assoc($get_salle)) {
        $num_salle = htmlspecialchars($row['salle']);
        // Générer chaque option à l'intérieur du select
        echo "<option>$num_salle</option>";
    }

    echo "
                            </select>
                            </div>
                            
                            <div class='demandeur'>
                                <label for='demandeur'>NOM et prénom du demandeur :</label>
                                <input type='text' name='demandeur' id='demandeur' required>
                            </div>
                            
                            <div class='pers_conc'>
                                <label for='pers_conc'>NOM et prénom de la personne concerné :</label>
                                <input type='text' name='pers_conc' id='pers_conc' required>
                            </div>
                        </div>
                        
                        <div class='right'>
                            <br>                                                                  
                            <div class='description'>
                                    <label for='description'>Description du problème</label>
                                    <textarea id='description' name='description' maxlength='400'></textarea>                     
                            </div>
                        </div>
                        <div class='submit_ticket'>
                            <input type='submit' id='confirmer' value='Confirmer'>
                            <input type='reset' id='annuler' value='Reset'>
                        </div>
                    </form>
                    <div class='error'>";
    if (!empty($_GET["error"]) && $_GET['error'] == 1) {
        echo "<p>Erreur lors de la création du ticket</p>";
    }
    echo "                    </div>
                    </div>
                </div>
            </div>        
        </div>
    </main>
    </body>";

    include 'footer.html';
} else {
    header('Location: index.php');
}
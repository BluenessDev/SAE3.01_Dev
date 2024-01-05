<style>
    #tab {
        overflow: hidden;
    }

    .tablinks {
        float: left;
        background-color:  (#969291 38.89%, #B2ABA5 87.78%);
        border: none;
        padding: 14px 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .tablinks:hover {
        background-color: #969291;
    }

    .tablinks.active {
        background-color: #ccc;
    }

    .tabcontent {
        display: none;
        padding: 20px;
    }

    .tabcontent.show {
        display: block;
    }
</style>


<?php

echo "<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <script src=\"JavaScript/TabsTickets.js\"></script>
    
</head>";

$host = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($host, $username, $password) or die("erreur de connexion");

$namedb = "sae";
$db = mysqli_select_db($conn, $namedb) or die("erreur de connexion base");

$table = "tickets";


if (isset($_SESSION['login'])) {
    $utilisateur = $_SESSION['login'];
    include 'functions.php';

    //Requete pour récuperer les tickets de l'utilisateur
    $requete_recup_ticket = "SELECT nature, date, etat FROM $table WHERE login=? ORDER BY id DESC LIMIT 15";
    $reqpre_recup_ticket = mysqli_prepare($conn, $requete_recup_ticket);

    mysqli_stmt_bind_param($reqpre_recup_ticket, "s", $utilisateur);
    mysqli_stmt_execute($reqpre_recup_ticket);

    mysqli_stmt_bind_result($reqpre_recup_ticket, $nature, $date, $etat); // Liaison des variables pour stocker les résultats

    while (mysqli_stmt_fetch($reqpre_recup_ticket)) {
        //Pour chaque ligne recuperer on creer un tableau comprenant toutes les valeurs
        $resultats[] = array("nature" => $nature, "date" => $date, "etat" => $etat);
    }

    echo "
<main role='main'>
      <div class='article'>
        <div class='main-article'>
          <div class='content'>
            <div class='ligne' id='col'>
              <br>
              <div class='ligne'>
                <a href='profil.php'><div class='button'>
                  <h2>Accéder au profil</h2>
                </div></a>
              </div>
              <div class='ligne'>
                <a href='create_ticket.php'><div class='button'>
                  <h2>Ouvrir un ticket</h2>
                </div></a>
              </div>
              <div class='ligne'>
                <a href='log.php'><div class='button'>
                  <h2>Voir les logs</h2>
                </div></a>
              </div>
            </div>
            <div class='ligne' id='col'>
              <div class='subarticle'>
                <div class='titre'>
                  <h2>Mes derniers tickets ouverts :</h2>
                </div>
                <div id='alltabs'>
                    <div id='tab'>
                       <button class='tablinks' id='button1' data-content-id='ouvert' onclick='(\"ouvert\")'>Ouverts</button>
                       <button class='tablinks' id='button2' data-content-id='en_cours' onclick='(\"en_cours\")'>En cours</button>
                       <button class='tablinks' id='button3' data-content-id='fini' onclick='(\"fini\")'>Fini</button></div>
                    <div id='ouvert' class='tabcontent'>
                    <h3>Tableau des tickets ouverts</h3>";
                    afficherTickets($utilisateur, 'ouvert');
                echo "
                    </div>
                    <div id='en_cours' class='tabcontent'>
                        <h3>Tableau des tickets en cours de réparation</h3>";
                        afficherTickets($utilisateur, 'en_cours');
                        echo "
                        </div>
                    <div id='fini' class='tabcontent'>
                        <h3>Tableau des tickets fini</h3>";
                        afficherTickets($utilisateur, 'fini' );
                        echo "
                        
                    </div>
                </div>
                <div id='tableau'>
                <br>
                <br>
                <h3>Tableau des tickets de tout type </h3>";
                        afficherTickets($utilisateur,null);
                        echo"               
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>";
}
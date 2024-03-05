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
        width: ;
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
$password = "root";

$conn = mysqli_connect($host, $username, $password) or die("erreur de connexion");

$namedb = "sae";
$db = mysqli_select_db($conn, $namedb) or die("erreur de connexion base");

$table = "tickets";
$users_table = "users";


if (isset($_SESSION['login'])) {
    $utilisateur = $_SESSION['login'];
    include 'functions.php';
    $requete_role = "SELECT role FROM $users_table WHERE login=?";
    $reqpre_role = mysqli_prepare($conn, $requete_role);
    mysqli_stmt_bind_param($reqpre_role, "s", $utilisateur);
    mysqli_stmt_execute($reqpre_role);
    $result_role = mysqli_stmt_get_result($reqpre_role);
    $row_role = mysqli_fetch_assoc($result_role);
    $role_utilisateur = $row_role['role'];  // Rôle de l'utilisateur

    mysqli_stmt_close($reqpre_role);

    echo "
<main role='main'>
    <div class='article'>
        <div class='main-article'>
            <div class='content'>
                <div class='ligne' id='col'>
                    <br>
                    <div class='ligne'>
                        <a href='profil.php'>
                            <div class='button'>
                                <h2>Accéder au profil</h2>
                            </div>
                        </a>
                    </div>";

// Display de 'create_ticket' div ni pour 'adminReseau' ni pour 'technicien'
    if ($role_utilisateur == "utilisateur") {
        echo "<div class='ligne'>
            <a href='create_ticket.php'>
                <div class='button'>
                    <h2>Ouvrir un ticket</h2>
                </div>
            </a>
        </div>
        </div>
                <div class='ligne' id='col'>
                    <div class='subarticle'>
                        <div class='titre'>
                            <h2>Mes derniers tickets ouverts :</h2>
                        </div>";
    }

// Display de 'log' div uniquement pour l'adminReseau
    if ($role_utilisateur == "adminReseau") {
        echo "<div class='ligne'>
            <a href='log.php'>
                <div class='button'>
                    <h2>Voir les logs</h2>
                </div>
            </a>
        </div>
        </div>
                <div class='ligne' id='col'>
                    <div class='subarticle'>
                        <div class='titre'>
                            <h2>Mes derniers logs :</h2>
                        </div>";
    }

    if ($role_utilisateur == "admin"){
        echo "<div class='ligne'>
            <a href='assigner_role.php'>
                <div class='button'>
                    <h2>Voir les rôles User</h2>
                </div>
            </a>
        </div>
        </div>
                <div class='ligne' id='col'>
                    <div class='subarticle'>
                        <div class='titre'>
                            <h2>Les derniers tickets ouverts :</h2>
                        </div>";
    }

    if ($role_utilisateur == "technicien") {
        echo "
</div>
                <div class='ligne' id='col'>
                    <div class='subarticle active'>
                        <div class='titre'>
                            <h2>Mes derniers tickets assignés :</h2>
                        </div>";
    }



// Display tabs pour les users non techniciens
    if ($role_utilisateur == "adminReseau") {
        echo "<div id='tableau'>
    <br>
    <br>";
        afficherLogs();
        echo "</div>
                </div>
            </div>
        </div>
    </div>
</main>";
    } else {
        if ($role_utilisateur != "technicien") {
            echo "<div id='alltabs'>
            <div id='tab'>
                <button class='tablinks' id='button1' data-content-id='ouvert' onclick='(\"ouvert\")'>Ouverts</button>
                <button class='tablinks' id='button2' data-content-id='assigne' onclick='(\"assigne\")'>Assignés</button>
                <button class='tablinks' id='button3' data-content-id='ferme' onclick='(\"ferme\")'>Fermés</button>
            </div>
            <div id='ouvert' class='tabcontent'>
                <br>
                <br>
                <h3>Tableau des tickets ouverts</h3>";
            afficherTickets($utilisateur, 'Ouvert', $role_utilisateur);
            echo "</div>
            <div id='assigne' class='tabcontent'>
                <br>
                <br>
                <h3>Tableau des tickets assignés à un technicien</h3>";
            afficherTickets($utilisateur, 'Assigné', $role_utilisateur);
            echo "</div>
            <div id='ferme' class='tabcontent'>
                <br>
                <br>
                <h3>Tableau des tickets fermés</h3>";
            afficherTickets($utilisateur, 'Fermé', $role_utilisateur);
            echo "</div>
        </div>"; // Fermeture 'alltabs' div
        }
        echo "
<div id='tableau'>
    <br>
    <br>
    <h3>Tableau des tickets de tout type </h3>";
        afficherTickets($utilisateur, null, $role_utilisateur);
        //echo $role_utilisateur;  // Test pour voir le role user
        echo "</div>
                </div>
            </div>
        </div>
    </div>
</main>";
    }
}

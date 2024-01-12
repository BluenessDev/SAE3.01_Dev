<?php

echo "<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width'>
    <title>Informations du Ticket</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN' crossorigin='anonymous'>
    <link href='assets/style.css' rel='stylesheet' type='text/css'/>
    <link href='assets/logo.png' rel='icon'>
    
</head>";

// Connexion à la base de données
$host = "localhost";
$username = "root";
$password = "";
$dbname = "sae";
$conn = mysqli_connect($host, $username, $password, $dbname) or die("erreur de connexion");

session_start();

if (isset($_SESSION['login'])) {
    $utilisateur = $_SESSION['login'];
    include 'functions.php';

    if (isset($_GET['id'])) {
        $ticketId = $_GET['id'];

        $requete = "SELECT * FROM tickets WHERE id=?";
        $reqpre = mysqli_prepare($conn, $requete);

        if ($reqpre) {
            mysqli_stmt_bind_param($reqpre, "i", $ticketId);
            mysqli_stmt_execute($reqpre);
            $result = mysqli_stmt_get_result($reqpre);

            if (mysqli_num_rows($result) > 0) {
                $ticket = mysqli_fetch_assoc($result);

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
                        <div class='custom-container'>
                            <div class='custom-bg-color rounded shadow'>
                                <h2 class='text-center highlight2'>Information du ticket</h2>
                                <div class='row'> <!-- Utilisation du système de grille de Bootstrap -->
                                    
                                    <!-- Colonne pour les informations du ticket -->
                                    <div class='col-md-6'> <!-- Colonne de 6 colonnes sur 12 (pour les grands écrans) -->
                                        <div class='article'>
                                                <p><strong>ID:</strong> " . $ticket['id'] . "</p>
                                                <p><strong>Nature:</strong> " . $ticket['nature'] . "</p>
                                                <p><strong>Niveau:</strong> " . $ticket['niveau'] . "</p>
                                                <p><strong>Salle:</strong> " . $ticket['salle'] . "</p>
                                                <p><strong>Demandeur:</strong> " . $ticket['demandeur'] . "</p>
                                                <p><strong>Concerne:</strong> " . $ticket['concerne'] . "</p>
                                                <p><strong>Etat:</strong> " . $ticket['etat'] . "</p>
                                                <p><strong>Date:</strong> " . $ticket['date'] . "</p>
                                        </div>
                                    </div>

                                    <!-- Colonne pour la description du problème -->
                                    <div class='col-md-6'> <!-- Colonne de 6 colonnes sur 12 (pour les grands écrans) -->
                                        <div class='card' style='margin-top: auto'>
                                            <div class='card-body' style='width: 50%'>
                                                <h5 class='card-title'>Description du problème</h5>
                                                <p class='card-text'>" .$ticket['description'] ."</p>
                                            </div>
                                        </div>";
                                if($utilisateur == 'admin') {
                                    $sql = "SELECT login FROM users WHERE role = 'technicien'";
                                    $resultTechniciens = mysqli_query($conn, $sql);

                                    if ($resultTechniciens) {
                                        echo "<h5 class='card-title'>Sélectionner un technicien</h5>";
                                        echo "<form action='' method='post'>";
                                        echo "<div class='mb-3'>";
                                        echo "<label for='technicienSelect' class='form-label'>Technicien :</label>";
                                        echo "<select class='form-select' id='technicienSelect' name='technicien'>";

                                        while ($row = mysqli_fetch_assoc($resultTechniciens)) {
                                            $login = htmlspecialchars($row['login']);
                                            echo "<option value='$login'>$login</option>";
                                        }

                                        echo "</select>";
                                        echo "</div>";
                                        echo "<input type='submit' value='Assigner' class='btn btn-primary'>";
                                        echo "</form>";

                                    } else {
                                        echo "Erreur lors de la récupération des techniciens: " . mysqli_error($conn);
                                    }
                                    if (isset($_POST['technicien'])) {
                                        $ticketId = $_GET['id'];

                                        // Récupérez le technicien sélectionné
                                        $technicienLogin = $_POST['technicien'];

                                        // Mettre à jour le ticket dans la base de données avec le technicien sélectionné
                                        $requete_update = "UPDATE tickets SET technicien_login = ?, etat = 'en_cours' WHERE id = ?";
                                        $reqpre_update = mysqli_prepare($conn, $requete_update);
                                        mysqli_stmt_bind_param($reqpre_update, "si", $technicienLogin, $ticketId);
                                        mysqli_stmt_execute($reqpre_update);

                                        if (mysqli_stmt_affected_rows($reqpre_update) > 0) {
                                            echo "<p>Le technicien a été assigné avec succès au ticket.</p>";

                                            // Mettre à jour l'état du ticket
                                            $requete_update_etat = "UPDATE tickets SET etat = 'en_cours' WHERE id = ?";
                                            $reqpre_update_etat = mysqli_prepare($conn, $requete_update_etat);
                                            mysqli_stmt_bind_param($reqpre_update_etat, "i", $ticketId);
                                            mysqli_stmt_execute($reqpre_update_etat);

                                            //echo "<p>Nombre de lignes affectées pour l'état : " . mysqli_stmt_affected_rows($reqpre_update_etat) . "</p>";

                                            if (mysqli_stmt_affected_rows($reqpre_update_etat) >= 0) {
                                                echo "<p>L'état du ticket a été mis à jour avec succès.</p>";
                                            } else {
                                                echo "<p>Erreur lors de la mise à jour de l'état du ticket.</p>";
                                            }
                                        } else {
                                            echo "<p>Erreur lors de l'assignation du technicien au ticket.</p>";
                                        }
                                    }

                                }
                                else{
                                    echo " <p><strong>Technicien:</strong> " . $ticket['technicien_login'] . "</p>";
                                }


                                    echo "</div> <!-- Fin de la row -->

                                <!-- Boutons de retour -->
                                <form action='index.php' method='post'>
                                <div class='submit_ticket d-flex justify-content-center mt-3'>
                                    <input type='submit' id='retour' value='Retour' class='btn btn-primary mr-2'>
                                </div>
                                </form>

                            </div>
                        </div>
                    </main>

                <footer class='bg-dark text-white text-center py-3 fixed-bottom''>";
                 include 'footer.html';
                echo "</footer>";


            } else {
                echo "<p>Aucun ticket trouvé avec cet ID.</p>";
            }
        } else {
            die("Erreur dans la préparation de la requête: " . mysqli_error($conn));
        }
    } else {
        echo "<p>Aucun ID de ticket spécifié.</p>";
    }
} else {
    echo "<p>Veuillez vous connecter pour accéder à cette page.</p>";
}

echo "</body>
</html>";








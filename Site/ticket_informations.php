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
$password = "root";
$dbname = "sae";
$conn = mysqli_connect($host, $username, $password, $dbname) or die("erreur de connexion");

session_start();

if (isset($_SESSION['login'])) {
    $utilisateur = $_SESSION['login'];
    include 'functions.php';

    // Récupérer le rôle de l'utilisateur
    $requete_role = "SELECT role FROM users WHERE login = ?";
    $reqpre_role = mysqli_prepare($conn, $requete_role);

    if ($reqpre_role) {
        mysqli_stmt_bind_param($reqpre_role, "s", $utilisateur);
        mysqli_stmt_execute($reqpre_role);
        $result_role = mysqli_stmt_get_result($reqpre_role);

        if (mysqli_num_rows($result_role) > 0) {
            $row = mysqli_fetch_assoc($result_role);
            $roleUtilisateur = $row['role'];

            // Récupérer les informations du ticket
            if (isset($_GET['id'])) {
                $ticketId = $_GET['id'];
                $requete_ticket = "SELECT * FROM tickets WHERE id=?";
                $reqpre_ticket = mysqli_prepare($conn, $requete_ticket);

                if ($reqpre_ticket) {
                    mysqli_stmt_bind_param($reqpre_ticket, "i", $ticketId);
                    mysqli_stmt_execute($reqpre_ticket);
                    $result_ticket = mysqli_stmt_get_result($reqpre_ticket);

                    if (mysqli_num_rows($result_ticket) > 0) {
                        $ticket = mysqli_fetch_assoc($result_ticket);

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
                                <h1 class='highlight'>Vous êtes sur la page d'info de tickets</h1>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                    </header>
                    <main role='main'>
                      <div class='article'>
                        <div class='main-article'>
                            <div class ='subarticle'>
                                <div class='title' id='formtit'>
                                    <h2 class='highlight'>Information du ticket</h2>
                                </div>

                                <div class='container'>
                                <br>
                                <br>
                                <br>
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
                                                <p class='card-text'>" . $ticket['description'] . "</p>
                                            </div>
                                        </div>";
                        if ($roleUtilisateur == 'admin') {
                            displayTechnicianSelection($conn, $_GET['id']);
                            assignTechnicianToTicket($conn, $_GET['id']);
                        } elseif ($roleUtilisateur == 'technicien') {
                            echo "<div class='text-center mt-3'>";
                            echo "<form action='' method='post'>";
                            echo "<input type='hidden' name='ticket_id' value='" . $ticket['id'] . "'>";
                            echo "<button  type='submit' name='finir_ticket' class='btn btn-primary mr-2'>Marquer comme fini</button>";
                            echo "</form>";
                            echo "</div>";

                            if (isset($_POST['finir_ticket'])) {
                                $ticketId = $_POST['ticket_id'];
                                $requete_update_etat = "UPDATE tickets SET etat = 'fini' WHERE id = ?";
                                $reqpre_update_etat = mysqli_prepare($conn, $requete_update_etat);
                                mysqli_stmt_bind_param($reqpre_update_etat, "i", $ticketId);

                                if (mysqli_stmt_execute($reqpre_update_etat)) {
                                    echo "<p>Le ticket a été marqué comme fini avec succès.</p>";
                                } else {
                                    echo "<p>Erreur lors de la mise à jour de l'état du ticket.</p>";
                                }
                            }
                        } else {
                            echo "<p><strong>Technicien:</strong> " . $ticket['technicien_login'] . "</p>";
                        }
                        echo "</div> <!-- Fin de la row -->

                                <!-- Boutons de retour -->
                                <form action='index.php' method='post'>
                                <div class='submit_ticket d-flex justify-content-center mt-3'>
                                    <input type='submit' id='confirmer' value='Retour' class='btn btn-primary mr-2' >
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
    } else {
        echo "Erreur lors de la préparation de la requête pour récupérer le rôle.";
    }

    echo "</body>
</html>";
}
else {
    header('Location: index.php');
}








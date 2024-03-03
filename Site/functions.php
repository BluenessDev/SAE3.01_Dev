<?php

function getIp(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function afficherTickets($utilisateur, $etat, $role)
{
    global $conn;

    if ($role === 'admin') {
        if ($etat === null) {
            $requete = "SELECT id, nature, date, etat, technicien_login FROM tickets ORDER BY id DESC LIMIT 15";
            $reqpre = mysqli_prepare($conn, $requete);
        } else {
            $requete = "SELECT id, nature, date, etat, technicien_login FROM tickets WHERE etat=? ORDER BY id DESC LIMIT 15";
            $reqpre = mysqli_prepare($conn, $requete);
            mysqli_stmt_bind_param($reqpre, "s", $etat);
        }
    } elseif ($role === 'technicien') {
        if ($etat === null) {
            $requete = "SELECT id, nature, date, etat, technicien_login FROM tickets WHERE technicien_login=? ORDER BY id DESC LIMIT 15";
            $reqpre = mysqli_prepare($conn, $requete);
            mysqli_stmt_bind_param($reqpre, "s", $utilisateur);
        } else {
            $requete = "SELECT id, nature, date, etat, technicien_login FROM tickets WHERE technicien_login=? AND etat=? ORDER BY id DESC LIMIT 15";
            $reqpre = mysqli_prepare($conn, $requete);
            mysqli_stmt_bind_param($reqpre, "ss", $utilisateur, $etat);
        }
    } else {
        if ($etat === null) {
            $requete = "SELECT id, nature, date, etat FROM tickets WHERE login=? ORDER BY id DESC";
            $reqpre = mysqli_prepare($conn, $requete);
            mysqli_stmt_bind_param($reqpre, "s", $utilisateur);
        } else {
            $requete = "SELECT id, nature, date, etat, technicien_login FROM tickets WHERE login=? AND etat=? ORDER BY id DESC";
            $reqpre = mysqli_prepare($conn, $requete);
            mysqli_stmt_bind_param($reqpre, "ss", $utilisateur, $etat);
        }
    }

    if ($reqpre) {
        mysqli_stmt_execute($reqpre);
        $result = mysqli_stmt_get_result($reqpre);

        echo "<table>";
        echo "<thead>
                  <tr>
                    <th><strong>Problème</strong></th>
                    <th><strong>Date</strong></th>
                    <th><strong>Etat</strong></th>
                    <th><strong>Technicien</strong></th>
                  </tr>
              </thead>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr class='lignetableau'>";

            // Faire de chaque cellule une cellule de lien
            echo "<td><a href='ticket_informations.php?id=" . urlencode($row['id']) . "&nature=" . urlencode($row['nature']) . "'>" . $row['nature'] . "</a></td>";
            echo "<td><a href='ticket_informations.php?id=" . urlencode($row['id']) . "&date=" . urlencode($row['date']) . "'>" . $row['date'] . "</a></td>";
            echo "<td><a href='ticket_informations.php?id=" . urlencode($row['id']) . "&etat=" . urlencode($row['etat']) . "'>" . $row['etat'] . "</a></td>";
            if ($row['technicien_login'] != null) {
                echo "<td><a href='ticket_informations.php?id=" . urlencode($row['id']) . "&technicien_login=" . urlencode($row['technicien_login']) . "'>" . $row['technicien_login'] . "</a></td>";
            }
            else {
                echo "<td>-</td>";
            }

            echo "</tr>";
        }

        // Complétez avec des lignes vides si moins de 15 lignes sont affichées
        for ($i = 0; $i < (15 - mysqli_num_rows($result)); $i++) {
            echo "<tr>";
            echo "<td>-</td>";
            echo "<td>-</td>";
            echo "<td>-</td>";
            echo "<td>-</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        die("Erreur dans la préparation de la requête: " . mysqli_error($conn));
    }
}


function afficherUtilisateurs() {
    $host = "localhost";
    $username = "root";
    $password = "root";

    $conn = mysqli_connect($host, $username, $password) or die("erreur de connexion");

    $namedb = "sae";

    $db = mysqli_select_db($conn, $namedb) or die("erreur de connexion base");

    $table = "users";

    // Requête pour récupérer tous les utilisateurs ayant les rôles 'technicien' ou 'utilisateur'
    $requete = "SELECT login, email, role FROM $table WHERE role IN ('technicien', 'utilisateur') ORDER BY login DESC";
    $reqpre = mysqli_prepare($conn, $requete);

    if ($reqpre) {
        mysqli_stmt_execute($reqpre);
        $result = mysqli_stmt_get_result($reqpre);

        echo "<table>";
        echo "<thead>
                  <tr>
                    <th><strong>Login</strong></th>
                    <th><strong>Email</strong></th>
                    <th><strong>Role</strong></th>
                  </tr>
              </thead>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['login'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>";
            echo "<form action='' method='post'>";
            echo "<select name='role'>";
            echo "<option value='" . $row['role'] . "'>" . $row['role'] . "</option>"; // Sélectionnez le rôle actuel par défaut
            if ($row['role'] == 'technicien') {
                echo "<option value='utilisateur'>utilisateur</option>";
            } else {
                echo "<option value='technicien'>technicien</option>";
            }
            echo "</select>";
            echo "<input type='hidden' name='login' value='" . $row['login'] . "'>";
            echo "<input type='submit' value='Mettre à jour le rôle'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }

        if (isset($_POST['role']) && isset($_POST['login'])) {
            $nouveauRole = $_POST['role'];
            $loginUtilisateur = $_POST['login'];

            // Requête pour mettre à jour le rôle de l'utilisateur dans la base de données
            $requete_update_role = "UPDATE users SET role = ? WHERE login = ?";
            $reqpre_update_role = mysqli_prepare($conn, $requete_update_role);

            // Liez les paramètres à la requête préparée
            mysqli_stmt_bind_param($reqpre_update_role, "ss", $nouveauRole, $loginUtilisateur);

            // Exécutez la requête préparée
            mysqli_stmt_execute($reqpre_update_role);

            // Vérifiez le nombre de lignes affectées pour confirmer la mise à jour
            if (mysqli_stmt_affected_rows($reqpre_update_role) > 0) {
                echo "<p>Le rôle de $loginUtilisateur a été mis à jour en $nouveauRole avec succès.</p>";
            }
            else {
                echo "<p>Erreur lors de la mise à jour du rôle de l'utilisateur.</p>";
            }
        }

        echo "</table>";
    } else {
        die("Erreur dans la préparation de la requête: " . mysqli_error($conn));
    }
}


function displayTechnicianSelection($conn, $ticketId) {
    $sql = "SELECT login FROM users WHERE role = 'technicien'";
    $resultTechniciens = mysqli_query($conn, $sql);

    if ($resultTechniciens) {
        echo "<h5 class='card-title'>Sélectionner un technicien</h5>";
        echo "<form action='' method='post'>";
        echo "<div class='mb-3' >";
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
}

function assignTechnicianToTicket($conn, $ticketId) {
    #1
    if (isset($_POST['technicien'])) {
        #2
        $technicienLogin = $_POST['technicien'];
        $requete_update = "UPDATE tickets SET technicien_login = ?, etat = 'Assigné' WHERE id = ?";
        $reqpre_update = mysqli_prepare($conn, $requete_update);
        mysqli_stmt_bind_param($reqpre_update, "si", $technicienLogin, $ticketId);
        mysqli_stmt_execute($reqpre_update);
        #3
        if (mysqli_stmt_affected_rows($reqpre_update) > 0) {
            #4
            echo "<p>$technicienLogin a été assigné avec succès au ticket.</p>";
            updateTicketStatus($conn, $ticketId);
        } else {
            #5
            echo "<p>Erreur lors de l'assignation du technicien au ticket.</p>";
        }
    }
}

function updateTicketStatus($conn, $ticketId) {
    $requete_update_etat = "UPDATE tickets SET etat = 'Assigné' WHERE id = ?";
    $reqpre_update_etat = mysqli_prepare($conn, $requete_update_etat);
    mysqli_stmt_bind_param($reqpre_update_etat, "i", $ticketId);
    mysqli_stmt_execute($reqpre_update_etat);
    echo "<p>L'état du ticket a été mis à jour avec succès.</p>";
}

function afficherLogs() {
    echo "<table>
                   <thead>
                        <tr>
                            <th>Téléchargement</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>";
        $nombrefichiers = glob('logs/*.log');
        for ($i = count($nombrefichiers); $i > 0; $i--) {
            $fichier = str_replace('logs/', '', $nombrefichiers[$i - 1]);
            $date = str_replace('.log', '', $fichier);
            echo "<tr>
                            <td><a href='logs/$fichier'>Télecharger</a></td>
                            <td>$date</td>
                        </tr>";
        }
        echo "</tbody>
                    </table>";
}

function logEvent($message){
    $date = date('d-m-Y');
    $log_file = fopen("logs/$date.log", "a");
    fwrite($log_file, "[" . date('d/m/Y H:i:s') . "] " . $message . "\n");
    fclose($log_file);
}
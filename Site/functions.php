<?php

$host = "localhost";
$username = "root";
$password = "root";

$conn = mysqli_connect($host, $username, $password) or die("erreur de connexion");

$namedb = "sae";
$db = mysqli_select_db($conn, $namedb) or die("erreur de connexion base");

function getIp(): mixed
{
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function afficherTickets($utilisateur, $etat, $role): void
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

        echo "<table class='menu'>";
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
            if (array_key_exists('technicien_login', $row)) {
                if ($row['technicien_login'] != null) {
                    echo "<td><a href='ticket_informations.php?id=" . urlencode($row['id']) . "&technicien_login=" . urlencode($row['technicien_login']) . "'>" . $row['technicien_login'] . "</a></td>";
                } else {
                    echo "<td>-</td>";
                }
            } else {
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


function afficherUtilisateurs(): void
{
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


function displayTechnicianSelection($conn, $ticketId): void
{
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

function assignTechnicianToTicket($conn, $ticketId): void
{
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

function updateTicketStatus($conn, $ticketId): void
{
    $requete_update_etat = "UPDATE tickets SET etat = 'Assigné' WHERE id = ?";
    $reqpre_update_etat = mysqli_prepare($conn, $requete_update_etat);
    mysqli_stmt_bind_param($reqpre_update_etat, "i", $ticketId);
    mysqli_stmt_execute($reqpre_update_etat);
    echo "<p>L'état du ticket a été mis à jour avec succès.</p>";
}

function afficherLogs(): void
{
    echo "<table>
                   <thead>
                        <tr>
                            <th>Téléchargement</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>";
    $nombrefichiers = glob('logs/*.log');
    $nombrefichiers = array_slice($nombrefichiers, 0, 15); // Get the first 15 files
    for ($i = count($nombrefichiers); $i > 0; $i--) {
        $fichier = str_replace('logs/', '', $nombrefichiers[$i - 1]);
        $date = str_replace('.log', '', $fichier);
        echo "<tr>
                            <td><a href='logs/$fichier'>Télecharger</a></td>
                            <td>$date</td>
                        </tr>";
    }
    // If there are less than 15 logs, add additional rows with "-"
    for ($i = count($nombrefichiers); $i < 15; $i++) {
        echo "<tr>
                            <td>-</td>
                            <td>-</td>
                        </tr>";
    }
    echo "</tbody>
                    </table>";
}

function logEvent($message): void
{
    $date = date('d-m-Y');
    $log_file = fopen("logs/$date.log", "a");
    fwrite($log_file, "[" . date('d/m/Y H:i:s') . "] " . $message . "\n");
    fclose($log_file);
}

function processInscription($email, $login, $password, $confpassword, $verification): int
{
    global $conn;

    $clean_email = strip_tags($email);
    $clean_login = strip_tags($login);
    $clean_password = strip_tags($password);
    $clean_confpassword = strip_tags($confpassword);
    $email = $clean_email;
    $login = $clean_login;
    $mdp = chiffrement_RC4($clean_password);
    $confmdp = chiffrement_RC4($clean_confpassword);
    $table = "users";

    $requete1 = "SELECT * FROM $table WHERE login=?";
    $reqpre1 = mysqli_prepare($conn, $requete1);
    mysqli_stmt_bind_param($reqpre1, "s", $login);
    mysqli_stmt_execute($reqpre1);
    if ($result1 = mysqli_stmt_get_result($reqpre1) and $login != "" and $mdp != "" and $email != "") {
        if (mysqli_num_rows($result1) == 0) {
            if ($mdp == $confmdp) {
                if ($verification == $_SESSION['capcha']) {
                    $requete2 = "INSERT INTO $table (email, login, password) VALUES (?, ?, ?)";
                    $reqpre2 = mysqli_prepare($conn, $requete2);
                    mysqli_stmt_bind_param($reqpre2, "sss", $email, $login, $mdp);
                    mysqli_stmt_execute($reqpre2);
                    $requete3 = "SELECT * FROM $table WHERE login=? AND password=?";
                    $reqpre3 = mysqli_prepare($conn, $requete3);
                    mysqli_stmt_bind_param($reqpre3, "ss", $login, $mdp);
                    mysqli_stmt_execute($reqpre3);
                    if ($result3 = mysqli_stmt_get_result($reqpre3)) {
                        session_start();
                        unset($_SESSION['captcha']);
                        $_SESSION['login'] = $login;
                        $ip = getIp();
                        logEvent("Inscription réussie de l'adresse IP " . $ip . " avec le login " . $_SESSION['login']);
                        return 0; // Success
                    } else {
                        $ip = getIp();
                        logEvent("Erreur lors de la création du compte de l'adresse IP " . $ip . " avec le login " . $login);
                        return 4; // Error during account creation
                    }
                } else {
                    $ip = getIp();
                    logEvent("Inscription échouée de l'adresse IP " . $ip . " avec le login " . $login . " : La vérification est incorrecte");
                    return 3; // Verification incorrect
                }
            } else {
                $ip = getIp();
                logEvent("Inscription échouée de l'adresse IP " . $ip . " avec le login " . $login . " : Les mots de passe ne correspondent pas");
                return 1; // Passwords do not match
            }
        } else {
            $ip = getIp();
            logEvent("Inscription échouée de l'adresse IP " . $ip . " avec le login " . $login . " : Login déjà utilisé");
            return 2; // Login already used
        }
    } else {
        $ip = getIp();
        logEvent("Inscription échouée de l'adresse IP " . $ip . " avec le login " . $login . " : Champs vides");
        return 5; // Empty fields
    }
}

function processConnexion($login, $password): int
{
    global $conn;

    $clean_login = strip_tags($login);
    $clean_password = strip_tags($password);
    $login = $clean_login;
    $mdp = chiffrement_RC4($clean_password);
    $table = "users";

    $requete = "SELECT * FROM $table WHERE login=? AND password=?";
    $reqpre = mysqli_prepare($conn, $requete);
    mysqli_stmt_bind_param($reqpre, "ss", $login, $mdp);
    mysqli_stmt_execute($reqpre);

    if ($result = mysqli_stmt_get_result($reqpre)) {
        if (mysqli_num_rows($result) == 1) {
            session_start();
            $_SESSION['login'] = $login;
            $ip = getIp();
            logEvent("Connexion réussie de l'adresse IP " . $ip . " avec le login " . $_SESSION['login']);
            return 0; // Success
        } else {
            $ip = getIp();
            logEvent("Tentative de connexion échouée de l'adresse IP " . $ip . " avec le login " . $login);
            // Log the failed login attempt
            $logEntry = "$ip - Failed login attempt for user $login at " . date('Y-m-d H:i:s') . "\n";
            file_put_contents('/var/log/myapp/login_attempts.log', $logEntry, FILE_APPEND);
            return 1; // Incorrect password
        }
    } else {
        return 2; // Error during execution
    }
}

function creer_ticket($nature_pb, $niveau, $salle, $demandeur, $pers_conc, $description): bool
{
    global $conn;

    $table = "tickets";

    $allowed_natures = ['Problèmes de périphériques', 'Problèmes de logiciel', 'Problèmes de connectivité', 'Problèmes de matériel'];
    $allowed_niveaux = [1, 2, 3, 4];

    // Récupérer les salles autorisées de la base de données
    $requete_salles = "SELECT * FROM salle";
    $result_salles = mysqli_query($conn, $requete_salles);
    $allowed_salles_assoc = mysqli_fetch_all($result_salles, MYSQLI_ASSOC);

    $allowed_salles = array_map(function($salle) {
        return $salle['salle'];
    }, $allowed_salles_assoc);

    if (isset($_SESSION['login'])) {
        $utilisateur = $_SESSION['login'];
        if ($nature_pb != "" && $niveau != "" && $salle != "" && $demandeur != "" && $pers_conc != "" && $description != "" && (in_array($nature_pb, $allowed_natures) && in_array($niveau, $allowed_niveaux) && in_array($salle, $allowed_salles))) {
            //initialisation des champs du ticket pour le log
            $ip = getIp();
            logEvent("Création d'un ticket de l'adresse IP " . $ip . " avec le login " . $_SESSION['login'] . " : \n" . "\t\t\t\tNature du problème : " . $nature_pb . "\n" . "\t\t\t\tNiveau du problème : " . $niveau . "\n" . "\t\t\t\tSalle : " . $salle . "\n" . "\t\t\t\tDemandeur : " . $demandeur . "\n" . "\t\t\t\tPersonne concernée : " . $pers_conc . "\n" . "\t\t\t\tDescription : " . $description);
            //Insertion du ticket cree dans la BD
            $requete_ticket = "INSERT INTO $table (nature, niveau, salle, demandeur, concerne, description, login) values (?, ?, ?, ?, ?, ?, ?)";
            $reqpre_ticket = mysqli_prepare($conn, $requete_ticket); //Prépare la requete requete_ticket.
            mysqli_stmt_bind_param($reqpre_ticket, "sisssss", $nature_pb, $niveau, $salle, $demandeur, $pers_conc, $description, $utilisateur); // Permet de lier les valeurs aux marqueurs de position (?) dans la requête préparée.
            mysqli_stmt_execute($reqpre_ticket); //Execute la requete
            return true;
        } else {
            $ip = getIp();
            logEvent("Création d'un ticket échouée de l'adresse IP " . $ip . " avec le login " . $_SESSION['login'] . " : Champs vides");
            return false;
        }
    } else {
        return false;
    }
}


function changeEmail($conn, $email, $password, $login): string
{
    $clean_email = strip_tags($email);
    $email = $clean_email;
    $mdp = chiffrement_RC4($password);
    $requete2 = "SELECT * FROM users WHERE login=? AND password=?";
    $reqpre2 = mysqli_prepare($conn, $requete2);
    mysqli_stmt_bind_param($reqpre2, "ss", $login, $mdp);
    mysqli_stmt_execute($reqpre2);
    $result2 = mysqli_stmt_get_result($reqpre2);
    if (mysqli_num_rows($result2) == 1) {
        $requete = "UPDATE users SET email=? WHERE login=? AND password=?";
        $reqpre = mysqli_prepare($conn, $requete);
        mysqli_stmt_bind_param($reqpre, "sss", $email, $login, $mdp);
        $result = mysqli_stmt_execute($reqpre);
        if (mysqli_stmt_affected_rows($reqpre) == 1 and $email != "") {
            $ip = getIp();
            logEvent("Changement d'email réussi de l'adresse IP " . $ip . " avec le login " . $login);
            return "Email changé";
        } else {
            $ip = getIp();
            logEvent("Erreur lors du changement d'email de l'adresse IP " . $ip . " avec le login " . $login);
            return "Erreur lors du changement d'email";
        }
    } else {
        return "Mot de passe incorrect";
    }
}

function changePassword($conn, $newPassword, $confirmPassword, $currentPassword, $login): string
{
    $newmdp = chiffrement_RC4($newPassword);
    $confmdp = chiffrement_RC4($confirmPassword);
    $mdp = chiffrement_RC4($currentPassword);
    if ($newmdp == $confmdp) {
        $requete2 = "SELECT * FROM users WHERE login=? AND password=?";
        $reqpre2 = mysqli_prepare($conn, $requete2);
        mysqli_stmt_bind_param($reqpre2, "ss", $login, $mdp);
        mysqli_stmt_execute($reqpre2);
        $result2 = mysqli_stmt_get_result($reqpre2);
        if (mysqli_num_rows($result2) == 1) {
            $requete = "UPDATE users SET password=? WHERE login=? AND password=?";
            $reqpre = mysqli_prepare($conn, $requete);
            mysqli_stmt_bind_param($reqpre, "sss", $newmdp, $login, $mdp);
            $result = mysqli_stmt_execute($reqpre);
            if (mysqli_stmt_affected_rows($reqpre) == 1) {
                $ip = getIp();
                logEvent("Changement de mot de passe réussi de l'adresse IP " . $ip . " avec le login " . $login);
                return "Mot de passe changé";
            } else {
                $ip = getIp();
                logEvent("Erreur lors du changement de mot de passe de l'adresse IP " . $ip . " avec le login " . $login);
                return "Erreur lors du changement de mot de passe";
            }
        } else {
            $ip = getIp();
            logEvent("Erreur lors du changement de mot de passe de l'adresse IP " . $ip . " avec le login " . $login . " : Ancien mot de passe incorrect");
            return "Ancien mot de passe incorrect";
        }
    } else {
        $ip = getIp();
        logEvent("Erreur lors du changement de mot de passe de l'adresse IP " . $ip . " avec le login " . $login . " : Les mots de passe ne correspondent pas");
        return "Les mots de passe ne correspondent pas";
    }
}

function isBanned($ip): bool
{
    // Commande pour obtenir la liste des IP bannies par le jail sshd
    $command = "sudo fail2ban-client status sshd | grep 'Banned IP list:'";
    // Exécute la commande et stocke la sortie dans $output
    exec($command, $output);
    // La liste des IP bannies est à la fin de la sortie
    $bannedIps = end($output);
    // Supprime "Banned IP list:" de la chaîne
    $bannedIps = str_replace("Banned IP list:", "", $bannedIps);
    // Convertit la chaîne en tableau
    $bannedIps = explode(" ", $bannedIps);
    // Vérifie si l'IP de l'utilisateur est dans le tableau
    return in_array($ip, $bannedIps);
}
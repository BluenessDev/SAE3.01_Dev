<?php
function afficherTickets($utilisateur, $etat, $role)
{
    global $conn;

    if ($role === 'admin') {
        if ($etat === null) {
            $requete = "SELECT id, nature, date, etat FROM tickets ORDER BY id DESC LIMIT 15";
            $reqpre = mysqli_prepare($conn, $requete);
        } else {
            $requete = "SELECT id, nature, date, etat FROM tickets WHERE etat=? ORDER BY id DESC LIMIT 15";
            $reqpre = mysqli_prepare($conn, $requete);
            mysqli_stmt_bind_param($reqpre, "s", $etat);
        }
    } elseif ($role === 'technicien') {
        if ($etat === null) {
            $requete = "SELECT id, nature, date, etat FROM tickets WHERE  technicien_login=? ORDER BY id DESC LIMIT 15";
            $reqpre = mysqli_prepare($conn, $requete);
            mysqli_stmt_bind_param($reqpre, "s", $utilisateur);
        } else {
            $requete = "SELECT id, nature, date, etat FROM tickets WHERE technicien_login=? AND etat=? ORDER BY id DESC LIMIT 15";
            $reqpre = mysqli_prepare($conn, $requete);
            mysqli_stmt_bind_param($reqpre, "ss", $utilisateur, $etat);
        }
    } else {
        if ($etat === null) {
            $requete = "SELECT id, nature, date, etat FROM tickets WHERE login=? ORDER BY id DESC";
            $reqpre = mysqli_prepare($conn, $requete);
            mysqli_stmt_bind_param($reqpre, "s", $utilisateur);
        } else {
            $requete = "SELECT id, nature, date, etat FROM tickets WHERE login=? AND etat=? ORDER BY id DESC";
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
                  </tr>
              </thead>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";

            // Faire de chaque cellule une cellule de lien
            echo "<td><a href='ticket_informations.php?id=" . urlencode($row['id']) . "&nature=" . urlencode($row['nature']) . "'>" . $row['nature'] . "</a></td>";
            echo "<td><a href='ticket_informations.php?id=" . urlencode($row['id']) . "&date=" . urlencode($row['date']) . "'>" . $row['date'] . "</a></td>";
            echo "<td><a href='ticket_informations.php?id=" . urlencode($row['id']) . "&etat=" . urlencode($row['etat']) . "'>" . $row['etat'] . "</a></td>";

            echo "</tr>";
        }

        // Complétez avec des lignes vides si moins de 15 lignes sont affichées
        for ($i = 0; $i < (15 - mysqli_num_rows($result)); $i++) {
            echo "<tr>";
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
    global $conn;

    // Requête pour récupérer tous les utilisateurs ayant les rôles 'technicien' ou 'utilisateur'
    $requete = "SELECT login, email, role FROM users WHERE role IN ('technicien', 'utilisateur') ORDER BY login DESC";
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
                echo "<option value='utilisateur'>Utilisateur</option>";
            } else {
                echo "<option value='technicien'>Technicien</option>";
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



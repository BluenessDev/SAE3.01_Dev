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





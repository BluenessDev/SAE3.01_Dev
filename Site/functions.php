<?php
function afficherTickets($utilisateur, $etat)
{
    global $conn;

    if ($etat === null) {
        $requete = "SELECT id, nature, date, etat FROM tickets WHERE login=? ORDER BY id DESC LIMIT 15";
        $reqpre = mysqli_prepare($conn, $requete);
        mysqli_stmt_bind_param($reqpre, "s", $utilisateur);
    } else {
        $requete = "SELECT id, nature, date, etat FROM tickets WHERE login=? AND etat=? ORDER BY id DESC LIMIT 15";
        $reqpre = mysqli_prepare($conn, $requete);
        mysqli_stmt_bind_param($reqpre, "ss", $utilisateur, $etat);
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

        $rowsCount = mysqli_num_rows($result);

        if ($rowsCount > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";

                // Faire de chaque cellule une cellule de lien
                echo "<td><a href='ticket_informations.php?id=" . urlencode($row['id']) . "&nature=" . urlencode($row['nature']) . "'>" . $row['nature'] . "</a></td>";
                echo "<td><a href='ticket_informations.php?id=" . urlencode($row['id']) . "&date=" . urlencode($row['date']) . "'>" . $row['date'] . "</a></td>";
                echo "<td><a href='ticket_informations.php?id=" . urlencode($row['id']) . "&etat=" . urlencode($row['etat']) . "'>" . $row['etat'] . "</a></td>";

                echo "</tr>";
            }

            for ($i = $rowsCount; $i < 15; $i++) {
                echo "<tr>";
                echo "<td>-</td>";
                echo "<td>-</td>";
                echo "<td>-</td>";
                echo "</tr>";
            }
        } else {
            for ($i = 0; $i < 15; $i++) {
                echo "<tr>";
                echo "<td>-</td>";
                echo "<td>-</td>";
                echo "<td>-</td>";
                echo "</tr>";
            }
        }

        echo "</table>";
    } else {
        die("Erreur dans la préparation de la requête: " . mysqli_error($conn));
    }
}



<?php

function ticketOuvert($utilisateur) {
    global $conn; // Accédez à la variable $conn définie dans db_connect.php

    $requete_ouverts = "SELECT nature, date, etat FROM tickets WHERE login=? AND etat='Ouvert' ORDER BY id DESC LIMIT 15";
    $reqpre_ouverts = mysqli_prepare($conn, $requete_ouverts);

    if ($reqpre_ouverts) {
        mysqli_stmt_bind_param($reqpre_ouverts, "s", $utilisateur);
        mysqli_stmt_execute($reqpre_ouverts);
        $result = mysqli_stmt_get_result($reqpre_ouverts);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['nature'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            echo "<td>" . $row['etat'] . "</td>";
            echo "</tr>";
        }
    } else {
        die("Erreur dans la préparation de la requête: " . mysqli_error($conn));
    }
}
?>

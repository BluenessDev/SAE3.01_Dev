<?php

$host = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($host, $username, $password) or die("erreur de connexion");

$namedb = "sae";
$db = mysqli_select_db($conn, $namedb) or die("erreur de connexion base");

$table = "tickets";

if (isset($_SESSION['login'])) {
    $utilisateur = $_SESSION['login'];

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

    echo "<main role='main'>
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
                <table>
                  <thead>
                  <tr>
                    <th>Problème</th>
                    <th>Date</th>
                    <th>Etat</th>
                  </tr>
                  </thead>
                  <tbody>";
                    //On recupere les 15 derniers tickets.
                    for ($i = 0; $i < 15; $i++) {
                        echo "<tr>";
                        if (isset($resultats[$i])) {
                            echo "<td>" . $resultats[$i]['nature'] . "</td>";
                            echo "<td>" . $resultats[$i]['date'] . "</td>";
                            echo "<td>" . $resultats[$i]['etat'] . "</td>";
                        } else {
                            echo "<td>-</td>
                                  <td>-</td>
                                  <td>-</td>";
                        }
                        echo "</tr>";
                    }
                  echo "</tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>";
}
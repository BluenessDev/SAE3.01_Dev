<?php

$host = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($host, $username, $password) or die("erreur de connexion");

$namedb = "sae";
$db = mysqli_select_db($conn, $namedb) or die("erreur de connexion base");

$table = "tickets";

//Requete pour récuperer les tickets
$requete_recup_ticket = "SELECT salle, nature, niveau, etat FROM $table ORDER BY id DESC LIMIT 10";
$reqpre_recup_ticket = mysqli_prepare($conn, $requete_recup_ticket);
mysqli_stmt_execute($reqpre_recup_ticket);

mysqli_stmt_bind_result($reqpre_recup_ticket, $salle, $nature, $niveau, $etat); // Liaison des variables pour stocker les résultats

while (mysqli_stmt_fetch($reqpre_recup_ticket)) {
    //Pour chaque ligne recuperer on creer un tableau comprenant toutes les valeurs
    $resultats[] = array("salle" => $salle, "nature" => $nature, "niveau" => $niveau,"etat" => $etat);
}

echo "<main role='main'>
  <div class='article'>
    <div class='main-article'>
      <div class='ligne'>
        <div class='subarticle' id='texte'>
          <div class='titre'>
            <h2>Explications :</h2>
          </div>
          <blockquote>
            Cette application web vous permet d'ouvrir des tickets en ligne afin d'informer la direction d'un éventuel problème au niveau des machines de l'UVSQ.
            Un administrateur se chargera d'assigner votre ticket à un technicien compétent.
            <br>
            <br>
            Pour retourner à l'accueil, il vous suffit de cliquer sur le logo de l'application.
          </blockquote>
        </div>
      </div>
    </div>
  </div>
  <div class='article'>
    <div class='main-article'>
      <div class='ligne'>
        <div class='subarticle'>
          <div class='titre'>
            <h2>Vidéo démonstation :</h2>
          </div>
          <iframe width='560' height='327' src='https://www.youtube.com/embed/dQw4w9WgXcQ?si=XnewCymXkF8B3f2f'
                  title='YouTube video player' frameborder='0'
                  allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share'
                  allowfullscreen></iframe>
        </div>
        <div class='subarticle'>
          <div class='titre'>
            <h2>Tableau 10 derniers tickets :</h2>
          </div>
          <table>
            <thead>
            <tr>
              <th>Salle</th>
              <th>Problème</th>
              <th>Niveau</th>
              <th>Etat</th>
            </tr>
            </thead>
            <tbody>";
            //On recupere les 10 derniers tickets.
            for ($i = 0; $i < 10; $i++) {
                echo "<tr>";
                if (isset($resultats[$i])) {
                    echo "<td>" . $resultats[$i]['salle'] . "</td>";
                    echo "<td>" . $resultats[$i]['nature'] . "</td>";
                    echo "<td>" . $resultats[$i]['niveau'] . "</td>";
                    echo "<td>" . $resultats[$i]['etat'] . "</td>";
                } else {
                    echo "<td>-</td>
                          <td>-</td>
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
</main>";
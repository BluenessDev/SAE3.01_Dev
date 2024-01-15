<?php
session_start();
$utilisateur = $_SESSION['login'];

if (isset($_SESSION['login'])) {
    echo "<!DOCTYPE html>
<html lang='fr' class='inscription'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width'>
    <title>Logs</title>
    <link href='assets/style.css' rel='stylesheet' type='text/css'/>
    <link href='assets/logo.png' rel='icon'>
</head>
<body>
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
      <h1 class='highlight'>Vous êtes sur la page des logs</h1>
    </div>
  </div>
  <br>
  <br>
  <br>
</header>
<main role='main'>
    <div class='article'>
        <div class='main-article'>
            <div class='ligne'>
                <div class='subarticle'>
                    <div class='titre'>
                        <h2>Liste des logs :</h2>
                    </div>
                    <table>
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
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>";
    include 'footer.html';
} else {
    header('Location: index.php');
}

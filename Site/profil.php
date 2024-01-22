<?php

include 'functions.php';
include 'Crypto.php';

echo "<!DOCTYPE html>
<html lang='fr' class='inscription'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width'>
    <title>Profil</title>
    <link href='assets/style.css' rel='stylesheet' type='text/css'/>
    <link href='assets/logo.png' rel='icon'>
</head>
<body>";

$host = "localhost";
$username = "root";
$password = "root";

$conn = mysqli_connect($host, $username, $password) or die("erreur de connexion");

$namedb = "sae";
$db = mysqli_select_db($conn, $namedb) or die("erreur de connexion base");

session_start();

$table = "users";

if (!empty($_POST)) {
    if (isset($_POST['email'], $_POST['password'])) {
        $email = $_POST['email'];
        $mdp = chiffrement_RC4($_POST['password']);
        $utilisateur = $_SESSION['login'];
        $requete2 = "SELECT * FROM $table WHERE login=? AND password=?";
        $reqpre2 = mysqli_prepare($conn, $requete2);
        mysqli_stmt_bind_param($reqpre2, "ss", $utilisateur, $mdp);
        mysqli_stmt_execute($reqpre2);
        $result2 = mysqli_stmt_get_result($reqpre2);
        if (mysqli_num_rows($result2) == 1) {
            $requete = "UPDATE $table SET email='$email' WHERE login=? AND password=?";
            $reqpre = mysqli_prepare($conn, $requete);
            mysqli_stmt_bind_param($reqpre, "ss", $utilisateur, $mdp);
            $result = mysqli_stmt_execute($reqpre);
            if (mysqli_stmt_affected_rows($reqpre) == 1) {
                session_start();
                $ip = getIp();
                $date = date('d-m-Y');
                $log_file = fopen("logs/$date.log", "a");
                fwrite($log_file, "[" . date('d/m/Y H:i:s') . "] Changement d'email de l'adresse IP " . $ip . " avec le login " . $_SESSION['login'] . "\n");
                fclose($log_file);
                header('Location: profil.php?id=emchange');
            } else {
                $ip = getIp();
                $date = date('d-m-Y');
                $log_file = fopen("logs/$date.log", "a");
                fwrite($log_file, "[" . date('d/m/Y H:i:s') . "] Erreur lors du changement d'email de l'adresse IP " . $ip . " avec le login " . $_SESSION['login'] . " : Mot de passe incorrect" . "\n");
                fclose($log_file);
                header('Location: profil.php?id=emerror');
            }
        } else {
            header('Location: profil.php?id=emerror');
        }
    } else if (isset($_POST['newpassword'], $_POST['confpassword'], $_POST['password'])) {
        $newmdp = chiffrement_RC4($_POST['newpassword']);
        $confmdp = chiffrement_RC4($_POST['confpassword']);
        $mdp = chiffrement_RC4($_POST['password']);
        $utilisateur = $_SESSION['login'];
        if ($newmdp == $confmdp) {
            $requete2 = "SELECT * FROM $table WHERE login=? AND password=?";
            $reqpre2 = mysqli_prepare($conn, $requete2);
            mysqli_stmt_bind_param($reqpre2, "ss", $utilisateur, $mdp);
            mysqli_stmt_execute($reqpre2);
            $result2 = mysqli_stmt_get_result($reqpre2);
            if (mysqli_num_rows($result2) == 1) {
                $requete = "UPDATE $table SET password=? WHERE login=? AND password=?";
                $reqpre = mysqli_prepare($conn, $requete);
                mysqli_stmt_bind_param($reqpre, "sss", $newmdp, $utilisateur, $mdp);
                $result = mysqli_stmt_execute($reqpre);
                if (mysqli_stmt_affected_rows($reqpre) == 1) {
                    $ip = getIp();
                    $date = date('d-m-Y');
                    $log_file = fopen("logs/$date.log", "a");
                    fwrite($log_file, "[" . date('d/m/Y H:i:s') . "] Changement de mot de passe réussi de l'adresse IP " . $ip . " avec le login " . $_SESSION['login'] . "\n");
                    fclose($log_file);
                    header('Location: profil.php?id=mdpchange');
                } else {
                    $ip = getIp();
                    $date = date('d-m-Y');
                    $log_file = fopen("logs/$date.log", "a");
                    fwrite($log_file, "[" . date('d/m/Y H:i:s') . "] Erreur lors du changement de mot de passe de l'adresse IP " . $ip . " avec le login " . $_SESSION['login'] . " : Erreur" . "\n");
                    header('Location: profil.php?id=mdperror');
                }
            }
        } else {
            $ip = getIp();
            $date = date('d-m-Y');
            $log_file = fopen("logs/$date.log", "a");
            fwrite($log_file, "[" . date('d/m/Y H:i:s') . "] Erreur lors du changement de mot de passe de l'adresse IP " . $ip . " avec le login " . $_SESSION['login'] . " : Ancien mot de passe incorrect" . "\n");
            header('Location: profil.php?id=mdperror2');
        }
    } else {
        $ip = getIp();
        $date = date('d-m-Y');
        $log_file = fopen("logs/$date.log", "a");
        fwrite($log_file, "[" . date('d/m/Y H:i:s') . "] Erreur lors du changement de mot de passe de l'adresse IP " . $ip . " avec le login " . $_SESSION['login'] . " : Les mots de passe ne correspondent pas" . "\n");
        header('Location: profil.php?id=mdperror2');
    }
}

if (isset($_SESSION['login'])) {
    $utilisateur = $_SESSION['login'];
    $requete = "SELECT email FROM $table WHERE login='$utilisateur'";
    $requete2 = "SELECT role FROM $table WHERE login ='$utilisateur'";
    $result = mysqli_query($conn, $requete);
    $result2 = mysqli_query($conn, $requete2);
    $email = mysqli_fetch_row($result);
    $role = mysqli_fetch_row($result2);
    echo "<header role='banner'>
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
      <h1 class='highlight'>Vous êtes sur la page profil</h1>
    </div>
  </div>
  <br>
  <br>
  <br>
</header>
<main role='main'>
    <div class='main'>
        <div class='article'>
            <div class='main-article'>
                <div class='subarticle'>
                    <div class='titre' id='formtit'>
                        <h2 class='highlight'>Informations personnelles :</h2>
                    </div>
                    <ligne
                    <div class='ligne'>
                    <div class='left'>
                    <p>Login : $utilisateur</p>
                    <p>Email : $email[0]</p>
                    <p>Role : $role[0]</p>
                    </div>
                    <div class='right'>
                    <table>
                        <thead>
                        <tr>
                            <th>Nombre de tickets créés</th>
                            <th>Nombre de tickets résolus</th>
                        </tr>
                        </thead>
                        <tbody>";
$requete = "SELECT COUNT(*) FROM tickets WHERE login='$utilisateur'";
$result = mysqli_query($conn, $requete);
$nb_tickets = mysqli_fetch_row($result);
$requete = "SELECT COUNT(*) FROM tickets WHERE login='$utilisateur' AND etat='fini'";
$result = mysqli_query($conn, $requete);
$nb_tickets_resolus = mysqli_fetch_row($result);
echo "<tr>
                            <td>$nb_tickets[0]</td>
                            <td>$nb_tickets_resolus[0]</td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
    <div class='article'>
        <div class='main-article'>
            <div class='ligne'>
                <div class='subarticle' id='form'>
                    <div class='titre' id='formtit'>
                        <h2 class='highlight2'>Changer l'email</h2>
                    </div>
                    <form action='' method='post' class='formulaire'>
                        <p>Votre email actuel : <strong>$email[0]</strong></p>
                        <div class='email'>
                            <label for='email'>Nouvel email :</label>
                            <input type='email' name='email' id='email' required>
                        </div>
                        <br>
                        <div class='password'>
                            <label for='password'>Mot de passe :</label>
                            <input type='password' name='password' id='password' required>
                        </div>";
    if (!empty($_GET["id"]) && $_GET['id'] == 'emchange') {
        echo "<p style='color: green'>Email changé</p>";
    } else if (!empty($_GET["id"]) && $_GET['id'] == 'emerror') {
        echo "<p style='color: red'>Mot de passe incorrect</p>";
    } else {
        echo "<br>";
        echo "<br>";
    }
    echo "
                        <br>
                        <div class='submit'>
                            <input type='submit' id='connect' value='Changer'>
                        </div>
                    </form>
                </div>
                <div class='subarticle' id='form'>
                    <div class='titre' id='formtit'>
                        <h2 class='highlight2'>Changer le mot de passe</h2>
                    </div>
                    <div>
                        <form action='' method='post' class='formulaire'>
                            <div class='password'>
                                <label for='password'>Ancien mot de passe :</label>
                                <input type='password' name='password' id='password' required>
                            </div>
                            <br>
                            <div class='newpassword'>
                                <label for='password'>Nouveau mot de passe :</label>
                                <input type='password' name='newpassword' id='newpassword' required>
                            </div>
                            <br>
                            <div class='confpassword'>
                                <label for='confpassword'>Confirmer le mot de passe :</label>
                                <input type='password' name='confpassword' id='confpassword' required>
                            </div>";
    if (!empty($_GET["id"]) && $_GET['id'] == 'mdpchange') {
        echo "<p style='color: green'>Mot de passe changé</p>";
    } else if (!empty($_GET["id"]) && $_GET['id'] == 'mdperror') {
        echo "<p style='color: red'>Erreur lors du changement de mot de passe</p>";
    } else if (!empty($_GET["id"]) && $_GET['id'] == 'mdperror2') {
        echo "<p style='color: red'>Les mots de passe ne correspondent pas</p>";
    } else {
        echo "<br>";
        echo "<br>";
    }
    echo "                        <div class='submit'>
                                <input type='submit' id='connect' value='Changer'>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>
</main>";
    include 'footer.html';
} else {
    header('Location: index.php');
}

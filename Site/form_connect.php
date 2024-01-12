<?php

include 'functions.php';

$host = "localhost";
$username = "root";
$password = "root";

$conn = mysqli_connect($host, $username, $password) or die("erreur de connexion");

$namedb = "sae";
$db = mysqli_select_db($conn, $namedb) or die("erreur de connexion base");

$table = "users";

if (isset($_POST['login'], $_POST['password'])) {
    $login = $_POST['login'];
    $mdp = md5($_POST['password']);
    $requete = "SELECT * FROM $table WHERE login=? AND password=?";
    $reqpre = mysqli_prepare($conn, $requete);

    mysqli_stmt_bind_param($reqpre, "ss", $login, $mdp);

    mysqli_stmt_execute($reqpre);

    if ($result = mysqli_stmt_get_result($reqpre)) {
        if (mysqli_num_rows($result) == 1) {
            session_start();
            $_SESSION['login'] = $login;
            $ip = getIp();
            $date = date('d-m-Y');
            $log_file = fopen("logs/$date.log", "a");
            fwrite($log_file, "[" . date('d/m/Y H:i:s') . "] Connexion réussie de l'adresse IP " . $ip . " avec le login " . $_SESSION['login'] . "\n");
            fclose($log_file);
            header('Location: index.php');
        } else {
            $ip = getIp();
            $date = date('d-m-Y');
            $log_file = fopen("logs/$date.log", "a");
            fwrite($log_file, "[" . date('d/m/Y H:i:s') . "] Connexion échouée de l'adresse IP " . $ip . " avec le login " . $login . "\n");
            fclose($log_file);
            header('Location: form_connect.php?error=1');
        }
    }
} else if (isset($_SESSION['login'])) {
    header('Location: index.php');
}

echo "<!DOCTYPE html>
<html lang='fr' class='inscription'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width'>
    <title>Connexion</title>
    <link href='assets/style.css' rel='stylesheet' type='text/css'/>
    <link href='assets/logo.png' rel='icon'>
</head>
<body>";

include 'banner.html';

echo "<main role='main'>
    <div class='article'>
        <div class='main-article'>
            <div class='ligne'>
                <img src='assets/imgconnexion.png'
                     alt='photo du batiment Mermoz de uvsq de Velizy-Villacoublay'>
                <div class='subarticle' id='form'>
                    <div class='titre' id='formtit'>
                        <h2 class='highlight2'>Se connecter</h2>
                    </div>
                    <br>
                    <form action='' method='post' class='formulaire'>
                        <div class='login'>
                            <label for='login'>Login :</label>
                            <input type='text' name='login' id='login' required>
                        </div>
                        <br>
                        <br>
                        <div class='password'>
                            <label for='password'>Mot de passe :</label>
                            <input type='password' name='password' id='password' required>
                        </div>
                        <div class='iforgor'>
                            <a href='forgot.html'>Mot de passe oublié ?</a>
                        </div>";
if (!empty($_GET["error"]) && $_GET['error'] == 1) {
    echo "<p style='color: red'>Mot de passe incorrect</p>";
} else {
    echo "<br>";
    echo "<br>";
}
echo "
                        <br>
                        <br>
                        <div class='submit'>
                            <input type='submit' id='connect' value='Connexion'>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>";

include 'footer.html';

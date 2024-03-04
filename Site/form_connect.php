<?php

include 'functions.php';
include 'Crypto.php';

echo "<!DOCTYPE html>
<html lang='fr' class='inscription'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width'>
    <title>Connexion</title>
    <link href='assets/style.css' rel='stylesheet' type='text/css'/>
    <script src='JavaScript/FormInscr.js'></script>
    <link href='assets/logo.png' rel='icon'>
</head>
<body>";

if (isset($_POST['login'], $_POST['password'])) {
    $result = processConnexion($_POST['login'], $_POST['password']);
    if ($result === 0) {
        header('Location: index.php');
    } else {
        header('Location: form_connect.php?error=' . $result);
    }
} else if (isset($_SESSION['login'])) {
    header('Location: index.php');
}

include 'banner.html';

echo "<script>document.addEventListener('DOMContentLoaded', clearChamps);</script>";
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
                        </div>";
if (!empty($_GET["error"]) && $_GET['error'] == 1) {
    echo "<p style='color: red'>Mot de passe incorrect</p>";
} else {
    echo "<br>";
    echo "<br>";
}
echo "
                        <br>
                        <div class='submit'>
                            <input type='submit' id='connect' value='Connexion'>
                        </div>
                        <br>
                        <div class='iforgor'>
                            <a href='forgot.html'>Mot de passe oublié ?</a>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>";

include 'footer.html';
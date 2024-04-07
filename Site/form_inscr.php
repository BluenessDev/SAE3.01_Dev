<?php

include 'functions.php';
include 'Crypto.php';

session_start();

$operande1 = rand(1, 10);
$operande2 = rand(1, 10);

if (isset($_POST['email'], $_POST['login'], $_POST['creapassword'], $_POST['confpassword'], $_POST['verification'])) {
    $result = processInscription($_POST['email'], $_POST['login'], $_POST['creapassword'], $_POST['confpassword'], $_POST['verification']);
    if ($result === 0) {
        header('Location: index.php');
    } else {
        header('Location: form_inscr.php?error=' . $result);
    }
} else if (isset($_SESSION['login'])) {
    header('Location: index.php');
}

$_SESSION['capcha'] = $operande1 + $operande2;

echo "<!DOCTYPE html>
<html lang='fr' class='inscription'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width'>
    <title>Inscription</title>
    <link href='assets/style.css' rel='stylesheet' type='text/css'/>
    <link href='assets/logo.png' rel='icon'>
    <script src='JavaScript/FormInscr.js'></script>
</head>
<body>";

include 'banner.html';

echo "<main role='main'>
    <div class='article'>
        <div class='main-article'>
            <div class='ligne'>
                <img src='assets/imginscription.png'
                     alt='photo du batiment administratif de UVSQ à Vélizy-Villacoublay'>
                <div class='subarticle' id='form'>
                    <div class='titre' id='formtit'>
                        <h2 class='highlight2'>Créer un compte</h2>
                    </div>
                    <br>
                    <form action='' method='post' class='formulaire' onsubmit='conserverChamps();'>
                        <div class='email'>
                            <label for='email'>Email :</label>
                            <input type='email' name='email' id='email' required>
                        </div>
                        <br>
                        <br>
                        <div class='login'>
                            <label for='login'>Login :</label>
                            <input type='text' name='login' id='login' maxlength='10' required>
                        </div>
                        <br>
                        <br>
                        <div class='creapassword'>
                            <label for='creapassword'>Mot de passe :</label>
                            <input type='password' name='creapassword' id='creapassword' required>
                        </div>
                        <br>
                        <br>
                        <div class='confpassword'>
                            <label for='confpassword'>Confirmer le mot de passe :</label>
                            <input type='password' name='confpassword' id='confpassword' required>
                        </div>
                        <br>
                        <br>
                        <div class='verif'>
                            <label for='verification'>Vérification : Que fait $operande1 + $operande2 ?</label>
                            <input type='number' min='0' max='20' name='verification' id='verification' required>
                        </div>";
if (!empty($_GET["error"]) && $_GET['error'] == 1) {
    echo "<p style='color: red'>Les mots de passe ne correspondent pas</p>";
} elseif (!empty($_GET["error"]) && $_GET['error'] == 2) {
    echo "<p style='color: red'>Ce login est déjà utilisé</p>";
} elseif (!empty($_GET["error"]) && $_GET['error'] == 3) {
    echo "<p style='color: red'>La vérification est incorrecte</p>";
} else if (!empty($_GET["error"]) && $_GET['error'] == 4) {
    echo "<p style='color: red'>Erreur lors de la création de votre compte</p>";
} else if (!empty($_GET["error"]) && $_GET['error'] == 5) {
    echo "<p style='color: red'>Veuillez remplir tous les champs</p>";
} else {
    echo "<br>";
    echo "<br>";
    echo "<br>";
}
echo "                  <br>
                        <br>
                        <br>
                        <div class='submit'>
                            <input type='submit' id='accountcreate' value='Créer un compte'>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>";

include 'footer.html';
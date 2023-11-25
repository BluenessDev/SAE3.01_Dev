<?php
echo "<!DOCTYPE html>
<html lang='fr' class='inscription'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width'>
    <title>Inscription</title>
    <link href='assets/style.css' rel='stylesheet' type='text/css'/>
    <link href='assets/logo.png' rel='icon'>
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
                    <form action='creation.php' method='post' class='formulaire'>
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
                        </div>";
if (!empty($_GET["error"]) && $_GET['error'] == 1) {
    echo "<p style='color: red'>Les mots de passe ne correspondent pas</p>";
}
elseif (!empty($_GET["error"]) && $_GET['error'] == 2) {
    echo "<p style='color: red'>Ce login est déjà utilisé</p>";
}
else {
    echo "<br>";
    echo "<br>";
}
echo "                  <br>
                        <br>
                        <br>
                        <br>
                        <br>
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
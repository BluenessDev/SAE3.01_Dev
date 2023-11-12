<?php
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
                    <form action='action.php' method='post' class='formulaire'>
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
}else {
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

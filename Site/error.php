<?php
include 'functions.php';
include 'Crypto.php';

echo "<!DOCTYPE html>
<html lang='fr' class='inscription'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width'>
    <title>Accès Refusé</title>
    <link href='assets/style.css' rel='stylesheet' type='text/css'/>
    <link href='assets/logo.png' rel='icon'>
</head>
<body>";

include 'banner.html';

echo "<main role='main'>
    <div class='article'>
        <div class='main-article'>
            <div class='ligne'>
                <div class='subarticle' id='form'>
                    <div class='titre' id='formtit'>
                        <h2 class='highlight2'>Accès Refusé</h2>
                    </div>
                    <br>
                    <p>Votre adresse IP a été bannie et vous ne pouvez plus accéder à ce site.</p>
                    <p style='padding-bottom: 90px'>Si vous pensez que c'est une erreur, veuillez contacter l'administrateur du site.</p>
                </div>
            </div>
        </div>
    </div>
</main>";

include 'footer.html';

echo "</body>
</html>";

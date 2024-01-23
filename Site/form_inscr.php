<?php

include 'functions.php';
include 'Crypto.php';

session_start();

$host = "localhost";
$username = "root";
$password = "root";

$operande1 = rand(1, 10);
$operande2 = rand(1, 10);

$conn = mysqli_connect($host, $username, $password) or die("erreur de connexion");

$namedb = "sae";
$db = mysqli_select_db($conn, $namedb) or die("erreur de connexion base");

$table = "users";

if (isset($_POST['email'], $_POST['login'], $_POST['creapassword'], $_POST['confpassword'], $_POST['verification'])) {
    $clean_email = strip_tags($_POST['email']);
    $clean_login = strip_tags($_POST['login']);
    $clean_password = strip_tags($_POST['creapassword']);
    $clean_confpassword = strip_tags($_POST['confpassword']);
    $email = $clean_email;
    $login = $clean_login;
    $mdp = chiffrement_RC4($clean_password);
    $confmdp = chiffrement_RC4($clean_confpassword);
    $requete1 = "SELECT * FROM $table WHERE login=?";
    $reqpre1 = mysqli_prepare($conn, $requete1);
    mysqli_stmt_bind_param($reqpre1, "s", $login);
    mysqli_stmt_execute($reqpre1);
    if ($result1 = mysqli_stmt_get_result($reqpre1) and $login != "" and $mdp != "" and $email != "") {
        if (mysqli_num_rows($result1) == 0) {
            if ($mdp == $confmdp) {
                $verification = intval($_POST['verification']);
                if ($verification == $_SESSION['capcha']) {
                    $requete2 = "INSERT INTO $table (email, login, password) VALUES (?, ?, ?)";
                    $reqpre2 = mysqli_prepare($conn, $requete2);
                    mysqli_stmt_bind_param($reqpre2, "sss", $email, $login, $mdp);
                    mysqli_stmt_execute($reqpre2);
                    $requete3 = "SELECT * FROM $table WHERE login=? AND password=?";
                    $reqpre3 = mysqli_prepare($conn, $requete3);
                    mysqli_stmt_bind_param($reqpre3, "ss", $login, $mdp);
                    mysqli_stmt_execute($reqpre3);
                    if ($result3 = mysqli_stmt_get_result($reqpre3)) {
                        session_start();
                        unset($_SESSION['captcha']);
                        $_SESSION['login'] = $login;
                        $_SESSION['date'] = date('d/m/Y');
                        $ip = getIp();
                        $date = date('d-m-Y');
                        $log_file = fopen("logs/$date.log", "a");
                        fwrite($log_file, "[" . date('d/m/Y H:i:s') . "] Inscription réussie de l'adresse IP " . $ip . " avec le login " . $login . "\n");
                        fclose($log_file);
                        header('Location: index.php');
                    } else {
                        $ip = getIp();
                        $date = date('d-m-Y');
                        $reason = "Erreur lors de la création du compte";
                        $log_file = fopen("logs/$date.log", "a");
                        fwrite($log_file, "[" . date('d/m/Y H:i:s') . "] Inscription échouée de l'adresse IP " . $ip . " avec le login " . $login . " : $reason\n");
                        fclose($log_file);
                        header('Location: form_inscr?error=4.php');
                    }
                } else {
                    $ip = getIp();
                    $date = date('d-m-Y');
                    $reason = "Capcha incorrect";
                    $log_file = fopen("logs/$date.log", "a");
                    fwrite($log_file, "[" . date('d/m/Y H:i:s') . "] Inscription échouée de l'adresse IP " . $ip . " avec le login " . $login . " : $reason\n");
                    fclose($log_file);
                    header('Location: form_inscr.php?error=3');
                }
            } else {
                $ip = getIp();
                $date = date('d-m-Y');
                $reason = "Mots de passe différents";
                $log_file = fopen("logs/$date.log", "a");
                fwrite($log_file, "[" . date('d/m/Y H:i:s') . "] Inscription échouée de l'adresse IP " . $ip . " avec le login " . $login . " : $reason\n");
                fclose($log_file);
                header('Location: form_inscr.php?error=1');
            }
        } else {
            $ip = getIp();
            $date = date('d-m-Y');
            $reason = "Login déjà utilisé";
            $log_file = fopen("logs/$date.log", "a");
            fwrite($log_file, "[" . date('d/m/Y H:i:s') . "] Inscription échouée de l'adresse IP " . $ip . " avec le login " . $login . " : $reason\n");
            fclose($log_file);
            header('Location: form_inscr.php?error=2');
        }
    } else {
        $ip = getIp();
        $date = date('d-m-Y');
        $reason = "Champs vides";
        $log_file = fopen("logs/$date.log", "a");
        fwrite($log_file, "[" . date('d/m/Y H:i:s') . "] Inscription échouée de l'adresse IP " . $ip . " avec le login " . $login . " : $reason\n");
        fclose($log_file);
        header('Location: form_inscr.php?error=5');
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
                    <form action='' method='post' class='formulaire'>
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
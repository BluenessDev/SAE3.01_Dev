<?php
$host = "localhost";
$username = "root";
$password = "root";

$conn = mysqli_connect($host, $username, $password) or die("erreur de connexion");

$namedb = "tpsession";
$db = mysqli_select_db($conn, $namedb) or die("erreur de connexion base");

$table = "users";

if (isset($_POST['email'], $_POST['login'], $_POST['creapassword'], $_POST['confpassword'])) {
    $email = $_POST['email'];
    $login = $_POST['login'];
    $mdp = md5($_POST['creapassword']);
    $confmdp = md5($_POST['confpassword']);
    $requete1 = "SELECT * FROM $table WHERE login=?";
    $reqpre1 = mysqli_prepare($conn, $requete1);
    mysqli_stmt_bind_param($reqpre1, "s", $login);
    mysqli_stmt_execute($reqpre1);
    if ($result1 = mysqli_stmt_get_result($reqpre1)) {
        if (mysqli_num_rows($result1) == 0) {
            if ($mdp == $confmdp) {
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
                    $_SESSION['login'] = $login;
                    $_SESSION['date'] = date('d/m/Y');
                    header('Location: index.php');
                } else {
                    header('Location: form_inscr.php');
                }
            } else {
                header('Location: form_inscr.php?error=1');
            }
        } else {
            header('Location: form_inscr.php?error=2');
        }
    } else {
        header('Location: form_inscr.php');
    }
} else {
    header('Location: index.php');
}

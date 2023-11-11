<?php
$host = "localhost";
$username = "root";
$password = "root";

$conn = mysqli_connect($host, $username, $password) or die("erreur de connexion");

$namedb = "tpsession";
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
            $_SESSION['date'] = date('d/m/Y');
            header('Location: index.php');
        } else {
            header('Location: form_connect.php?error=1');
        }
    }
} else {
    header('Location: form_connect.php?error=1');
}

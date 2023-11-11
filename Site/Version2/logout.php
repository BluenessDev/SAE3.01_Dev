<?php
session_start();
if (isset($_GET['out'])) {
    unset($_SESSION['login'], $_SESSION['date']);
    session_destroy();
    header('Location: index.php');
} else {
    header('Location: index.php');
}

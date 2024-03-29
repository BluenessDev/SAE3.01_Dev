<?php

echo "<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width'>
    <title>Tickets</title>
    <link href='assets/style.css' rel='stylesheet' type='text/css'/>
    <link href='assets/logo.png' rel='icon'>
</head>";

include 'functions.php';

$host = "localhost";
$username = "root";
$password = "root";

$conn = mysqli_connect($host, $username, $password) or die("erreur de connexion");

$namedb = "sae";
$db = mysqli_select_db($conn, $namedb) or die("erreur de connexion base");

session_start();

$table = "tickets";

if (isset($_SESSION['login'])) {
    $utilisateur = $_SESSION['login'];
    if (isset($_POST['nature_pb'], $_POST['niveau'], $_POST['salle'], $_POST['demandeur'], $_POST['pers_conc'], $_POST['description'])){
        //initialisation des champs du ticket pour la BD
        $clean_nature = strip_tags($_POST['nature_pb']);
        $clean_niveau = strip_tags($_POST['niveau']);
        $clean_salle = strip_tags($_POST['salle']);
        $clean_demandeur = strip_tags($_POST['demandeur']);
        $clean_pers_conc = strip_tags($_POST['pers_conc']);
        $clean_description = strip_tags($_POST['description']);
        $nature_pb = $clean_nature;
        $niveau = $clean_niveau;
        $salle = $clean_salle;
        $demandeur = $clean_demandeur;
        $pers_conc = $clean_pers_conc;
        $description = $clean_description;
        if ($nature_pb != "" && $niveau != "" && $salle != "" && $demandeur != "" && $pers_conc != "" && $description != "") {
            //initialisation des champs du ticket pour le log
            $ip = getIp();
            $date = date('d-m-Y');
            $log_file = fopen("logs/$date.log", "a");
            fwrite($log_file, "[" . date('d/m/Y H:i:s') . "] Création d'un ticket de l'adresse IP " . $ip . " avec le login " . $_SESSION['login'] . " : \n" . "\t\t\t\tNature du problème : " . $nature_pb . "\n" . "\t\t\t\tNiveau du problème : " . $niveau . "\n" . "\t\t\t\tSalle : " . $salle . "\n" . "\t\t\t\tDemandeur : " . $demandeur . "\n" . "\t\t\t\tPersonne concernée : " . $pers_conc . "\n" . "\t\t\t\tDescription : " . $description . "\n");
            fclose($log_file);
            //Insertion du ticket cree dans la BD
            $requete_ticket = "INSERT INTO $table (nature, niveau, salle, demandeur, concerne, description, login) values (?, ?, ?, ?, ?, ?, ?)";
            $reqpre_ticket = mysqli_prepare($conn, $requete_ticket); //Prépare la requete requete_ticket.
            mysqli_stmt_bind_param($reqpre_ticket, "sisssss", $nature_pb, $niveau, $salle, $demandeur, $pers_conc, $description, $utilisateur); // Permet de lier les valeurs aux marqueurs de position (?) dans la requête préparée.
            mysqli_stmt_execute($reqpre_ticket); //Execute la requete
            header('Location: index.php');
        } else {
            $ip = getIp();
            $date = date('d-m-Y');
            $log_file = fopen("logs/$date.log", "a");
            fwrite($log_file, "[" . date('d/m/Y H:i:s') . "] Création d'un ticket échouée de l'adresse IP " . $ip . " avec le login " . $_SESSION['login'] . " : \n" . "\t\t\t\tNature du problème : " . $nature_pb . "\n" . "\t\t\t\tNiveau du problème : " . $niveau . "\n" . "\t\t\t\tSalle : " . $salle . "\n" . "\t\t\t\tDemandeur : " . $demandeur . "\n" . "\t\t\t\tPersonne concernée : " . $pers_conc . "\n" . "\t\t\t\tDescription : " . $description . "\n");
            fclose($log_file);
            header('Location: create_ticket.php');
        }
    }
    echo "<body>
    <header role='banner'>
        <nav role='navigation'>
            <ul class='nav-list'>
                <li><a href='logout.php?out' class='goldnav-button'>Se déconnecter</a></li>
            </ul>
        </nav>
        <br>
        <br>
        <div class='inheader'>
            <a href='index.php'><img src='assets/logo.png' alt='logo du site tickimoa'></a>
            <div class='title'>
                <h1>Ravi de vous revoir <span style='text-transform:uppercase'>$utilisateur</span></h1>
                <h1 class='highlight'>Vous êtes sur la page Création De Tickets</h1>
            </div>
        </div>
        <br>
        <br>
        <br>
    </header>
    <main role='main'>
        <div class='main'>
            <div class='article'>
                 <div class='main-article'>
                    <div class='subarticle' id='form'>
                        <div class='titre' id='formtit'>
                            <h2 class='highlight2'>Créer un ticket</h2>
                        </div>
                        <form action='' method='post' class='formulaire'>
                        <blockquote>Pour creer un ticket merci de préciser la nature du problème, le niveau d’urgence estimée par le demandeur, la salle, le demandeur, la personne concernée par le problème et une description (300 caracteres) si nécessaire. </blockquote>
                        
                        <div class='left'>
                            <div class='nature_pb'>
                                <label for='nature_pb'>Nature du probleme :</label>
                                <select name='nature_pb' id='nature_pb' required>
                                    <option>Problèmes de périphériques </option>
                                    <option>Problèmes de logiciel</option>
                                    <option>Problèmes de connectivité</option>
                                    <option>Problèmes de matériel </option>
                                </select>
                            </div>
                            
                            <div class='niveau'>
                                <label for='niveau'>Niveau de probleme estimée :</label>
                                <select name='niveau' id='niveau'>
                                    <option value='1'>Niveau 1</option>
                                    <option value='2'>Niveau 2</option>
                                    <option value='3'>Niveau 3</option>
                                    <option value='4'>Niveau 4</option>
                                </select>
                            </div>
                            
                            <div class='salle'>
                                <label for='salle'>Salle ou se situe le problème</label>
                                <select name='salle' id='salle'>
                                <option>E46</option>
                                <option>E47</option>
                                <option>E49</option>
                                <option>E50</option>
                                <option>E51</option>
                                <option>E52</option>
                                <option>E53</option>
                                <option>E54</option>
                                <option>E57</option>
                                <option>E58</option>
                                <option>E59</option>
                                <option>G21</option>
                                <option>G22</option>
                                <option>G23</option>
                                <option>G24</option>
                                <option>G25</option>
                                <option>G26</option>
                                <option>G31</option>
                                <option>G32</option>
                                <option>G33</option>
                                <option>G34</option>
                                <option>G35</option>
                                <option>G51</option>
                                <option>G52</option>
                                <option>G53</option>
                                <option>G54</option>
                                <option>H11</option>
                                <option>H21</option>
                                <option>H22</option>
                                <option>H23</option>
                                <option>H24</option>
                                <option>H31</option>
                                <option>H32</option>
                                <option>H33</option>
                                <option>H41</option>
                                <option>H42</option>
                                <option>H44</option>
                                <option>H45</option>
                                <option>H61</option>
                                <option>H62</option>
                                <option>I03</option>
                                <option>I21</option>
                                <option>I22</option>
                                <option>I23</option>
                                <option>I24</option>
                                </select>
                            </div>
                            
                            <div class='demandeur'>
                                <label for='demandeur'>NOM et prénom du demandeur :</label>
                                <input type='text' name='demandeur' id='demandeur' required>
                            </div>
                            
                            <div class='pers_conc'>
                                <label for='pers_conc'>NOM et prénom de la personne concerné :</label>
                                <input type='text' name='pers_conc' id='pers_conc' required>
                            </div>
                        </div>
                        
                        <div class='right'>
                            <br>                                                                  
                            <div class='description'>
                                    <label for='description'>Description du problème</label>
                                    <textarea id='description' name='description' maxlength='400'></textarea>                     
                            </div>
                        </div>
                        <div class='submit_ticket'>
                            <input type='submit' id='confirmer' value='Confirmer'>
                            <input type='reset' id='annuler' value='Reset'>
                        </div>
                    </form>
                    </div>
                </div>
            </div>        
        </div>
    </main>
    </body>";

    include 'footer.html';
}else {
    header('Location: index.php');
}
## Documentation de la page index.php

Le code suivant est un exemple de génération de page HTML dynamique en PHP, basé sur l'état de la session utilisateur.

### Structure HTML Générée

#### Section `<head>`
- Déclaration du doctype, de l'encodage, et de la langue.
- Inclusion de feuilles de style CSS et de l'icône du site.

#### Section `<body>`
- Connexion à une base de données MySQL.
- Démarrage de la session PHP.
- Affichage conditionnel :
  - Si un utilisateur est connecté, affichage d'un en-tête avec des informations spécifiques à l'utilisateur.
  - Sinon, affichage d'un contenu alternatif pour les utilisateurs non connectés.

### Parties Principales Expliquées :

1. **Connexion à la base de données** :
    ```php
    $host = "localhost";
    $username = "root";
    $password = "root";

    $conn = mysqli_connect($host, $username, $password) or die("erreur de connexion");
    $namedb = "sae";
    $db = mysqli_select_db($conn, $namedb) or die("erreur de connexion base");
    ```
    - Les variables `$host`, `$username`, `$password` contiennent les informations de connexion à la base de données MySQL.
    - La fonction `mysqli_connect()` établit la connexion.
    - La base de données sélectionnée est `sae`.

2. **Gestion de session** :
    ```php
    session_start();

    if (isset($_SESSION['login'])) {
        // ... code exécuté si l'utilisateur est connecté ...
    } else {
        // ... code exécuté si aucun utilisateur n'est connecté ...
    }
    ```
    - `session_start()` démarre la session PHP.
    - La condition `isset($_SESSION['login'])` vérifie si l'utilisateur est connecté en cherchant la variable de session `'login'`.

3. **Affichage conditionnel de contenu** :
    - Si un utilisateur est connecté, affichage d'un en-tête spécifique avec des détails sur l'utilisateur.
    - Si aucun utilisateur n'est connecté, affichage d'une bannière et d'un contenu principal alternatif.

4. **Inclusion de fichiers HTML** :
    - Les fichiers HTML (`dashboard.html`, `banner.html`, `main.html`, `footer.html`) sont inclus dans la page en fonction de l'état de la session utilisateur.
    - Ils contiennent probablement du contenu HTML à afficher en conséquence.

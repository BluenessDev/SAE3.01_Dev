## Documentation de la page main.php

Cette page est principalement responsable de l'affichage du contenu principal du site. Elle récupère les 10 derniers tickets de la base de données et les affiche dans un tableau. Elle affiche également une vidéo de démonstration et une explication du site.

### Connexion à la base de données :

- Les informations de connexion à la base de données sont définies (`$host`, `$username`, `$password`).
- Une connexion à la base de données est établie en utilisant `mysqli_connect()`.
- La base de données `sae` est sélectionnée en utilisant `mysqli_select_db()`.

### Récupération des tickets :

- Une requête SQL est préparée pour récupérer les 10 derniers tickets de la table `tickets`.
- La requête est exécutée en utilisant `mysqli_stmt_execute()`.
- Les résultats sont liés à des variables en utilisant `mysqli_stmt_bind_result()`.
- Les résultats sont récupérés dans une boucle `while` en utilisant `mysqli_stmt_fetch()`. Chaque ligne de résultat est stockée dans un tableau `$resultats`.

### Affichage du contenu :

- Un bloc `<main>` est affiché, qui contient le contenu principal de la page.
- Une section d'explication du site est affichée, qui contient un texte d'explication sur l'utilisation du site.
- Une section de vidéo de démonstration est affichée, qui contient une vidéo intégrée de YouTube.
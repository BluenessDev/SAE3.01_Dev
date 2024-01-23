## Documentation de la page log.php

Cette page est principalement responsable de l'affichage des logs du site pour les utilisateurs ayant le rôle "adminReseau". Elle récupère tous les fichiers de logs disponibles et les affiche dans un tableau avec des liens pour les télécharger.

### Connexion à la base de données :

- Les informations de connexion à la base de données sont définies (`$host`, `$username`, `$password`).
- Une connexion à la base de données est établie en utilisant `mysqli_connect()`.
- La base de données `sae` est sélectionnée en utilisant `mysqli_select_db()`.

### Vérification du rôle de l'utilisateur :

- Une requête SQL est préparée pour récupérer le rôle de l'utilisateur connecté de la table `users`.
- La requête est exécutée en utilisant `mysqli_stmt_execute()`.
- Le rôle est récupéré en utilisant `mysqli_stmt_fetch()`.

### Affichage du contenu :

- Si l'utilisateur a le rôle "adminReseau", le contenu principal de la page est affiché.
- Un bloc `<main>` est affiché, qui contient le contenu principal de la page.
- Une section de tableau des logs est affichée, qui contient un tableau HTML. Tous les fichiers de logs disponibles sont affichés dans ce tableau avec des liens pour les télécharger.
- Si l'utilisateur n'a pas le rôle "adminReseau" ou n'est pas connecté, il est redirigé vers la page `index.php`.

### Récupération des fichiers de logs :

- Tous les fichiers de logs disponibles sont récupérés en utilisant la fonction `glob()`.
- Pour chaque fichier de log, le nom du fichier est nettoyé pour ne garder que la date et affiché dans le tableau.
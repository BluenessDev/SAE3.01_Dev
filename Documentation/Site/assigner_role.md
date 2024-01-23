## Documentation de la page assigner_role.php

Cette page est principalement responsable de l'affichage de la liste des utilisateurs et des techniciens pour les administrateurs. Elle permet à l'administrateur de voir et de modifier les rôles des utilisateurs.

### Connexion à la base de données :

- Les informations de connexion à la base de données sont définies (`$host`, `$username`, `$password`).
- Une connexion à la base de données est établie en utilisant `mysqli_connect()`.
- La base de données `sae` est sélectionnée en utilisant `mysqli_select_db()`.

### Vérification de l'utilisateur :

- La session de l'utilisateur est vérifiée pour s'assurer qu'un utilisateur est connecté.
- Le rôle de l'utilisateur est récupéré de la base de données.

### Affichage du contenu :

- Un bloc `<main>` est affiché, qui contient le contenu principal de la page.
- Si l'utilisateur est un administrateur, la liste des utilisateurs et des techniciens est affichée en utilisant la fonction `afficherUtilisateurs()`.
- Un bouton est fourni pour retourner à la page `index.php`.

### Redirection :

- Si l'utilisateur n'est pas un administrateur, il est redirigé vers la page `index.php`.
- Si aucun utilisateur n'est connecté, il est également redirigé vers la page `index.php`.
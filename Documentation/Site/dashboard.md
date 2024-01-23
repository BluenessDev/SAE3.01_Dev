## Documentation de la page dashboard.php

Cette page est principalement responsable de l'affichage du tableau de bord pour les utilisateurs. Elle affiche différents boutons et tableaux en fonction du rôle de l'utilisateur.

### Connexion à la base de données :

- Les informations de connexion à la base de données sont définies (`$host`, `$username`, `$password`).
- Une connexion à la base de données est établie en utilisant `mysqli_connect()`.
- La base de données `sae` est sélectionnée en utilisant `mysqli_select_db()`.

### Vérification de l'utilisateur :

- La session de l'utilisateur est vérifiée pour s'assurer qu'un utilisateur est connecté.
- Le rôle de l'utilisateur est récupéré de la base de données.

### Affichage du contenu :

- Un bloc `<main>` est affiché, qui contient le contenu principal de la page.
- En fonction du rôle de l'utilisateur, différents boutons sont affichés pour accéder au profil, ouvrir un ticket, voir les logs, voir les rôles des utilisateurs.
- Pour les utilisateurs non techniciens, des onglets sont affichés pour filtrer les tickets par état (ouverts, en cours, finis).
- Les tickets sont affichés dans un tableau HTML en utilisant la fonction `afficherTickets()`.

### Récupération des données :

- Des requêtes SQL sont préparées et exécutées pour récupérer les tickets en fonction du rôle et de l'état.
- Les tickets récupérés sont utilisés pour remplir les tableaux affichés sur la page.
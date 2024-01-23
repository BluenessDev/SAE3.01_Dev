## Documentation de la page create_ticket.php

Cette page est principalement responsable de la création de tickets par les utilisateurs. Elle affiche un formulaire pour saisir les détails du ticket et les enregistre dans la base de données.

### Connexion à la base de données :

- Les informations de connexion à la base de données sont définies (`$host`, `$username`, `$password`).
- Une connexion à la base de données est établie en utilisant `mysqli_connect()`.
- La base de données `sae` est sélectionnée en utilisant `mysqli_select_db()`.

### Vérification de l'utilisateur :

- La session de l'utilisateur est vérifiée pour s'assurer qu'un utilisateur est connecté.

### Création de tickets :

- Si le formulaire de création de ticket est soumis, les détails du ticket sont récupérés à partir des données POST.
- Les détails du ticket sont nettoyés pour éviter les injections SQL et XSS.
- Si tous les détails du ticket sont fournis, un nouveau ticket est créé dans la base de données.
- Les détails du ticket sont également enregistrés dans un fichier de log.

### Affichage du contenu :

- Un bloc `<main>` est affiché, qui contient le contenu principal de la page.
- Un formulaire est affiché pour saisir les détails du ticket, y compris la nature du problème, le niveau d'urgence, la salle, le demandeur, la personne concernée et une description.
- Si le ticket est créé avec succès, l'utilisateur est redirigé vers la page `index.php`. Sinon, l'utilisateur est redirigé vers la page `create_ticket.php`.
## Documentation du fichier profil.php

### Établissement de la connexion à la base de données :

- Les informations de connexion à la base de données MySQL sont définies (`$host`, `$username`, `$password`).
- La connexion est établie en utilisant `mysqli_connect()`.
- La base de données spécifique est sélectionnée avec `mysqli_select_db()`.

### Traitement du formulaire de profil :

1. **Vérification des données postées** :
   - Vérifie si la variable `$_POST` n'est pas vide, ce qui indique qu'une action a été déclenchée depuis le formulaire.
   - Vérifie les différents cas en fonction des champs reçus (`email`, `password`, `newpassword`, `confpassword`).

2. **Requêtes SQL pour la modification du profil** :
   - Utilisation de requêtes préparées (`mysqli_prepare()`, `mysqli_stmt_bind_param()`, `mysqli_stmt_execute()`) pour éviter les attaques par injection SQL.
   - Vérifie l'existence de l'utilisateur et de son mot de passe dans la table des utilisateurs.
   - Pour le changement d'email :
     - Met à jour l'email dans la base de données si le mot de passe correspond.
   - Pour le changement de mot de passe :
     - Vérifie si les nouveaux mots de passe correspondent avant de mettre à jour le mot de passe dans la base de données.

3. **Gestion des redirections** :
   - Redirige vers différentes pages (`profil.php?id=...`) selon le résultat de l'opération (changement d'email réussi, erreur de mot de passe, etc.).

4. **Affichage du formulaire de modification** :
   - Affiche le formulaire de modification de l'email et du mot de passe.
   - Affiche les messages de confirmation ou d'erreur lors des changements d'email ou de mot de passe.

5. **Vérification de la session** :
   - Vérifie si l'utilisateur est connecté en utilisant `$_SESSION['login']`.
   - Si oui, affiche le contenu de la page profil.
   - Si non, redirige vers `index.php`.

### Points à noter :

- Le code utilise des requêtes préparées pour sécuriser les interactions avec la base de données.
- Les redirections sont utilisées pour informer l'utilisateur sur les résultats des actions effectuées.
- Les messages de succès ou d'erreur sont affichés en fonction des opérations réalisées.
- La modification de l'email et du mot de passe se fait sous conditions strictes de vérification des identifiants actuels.

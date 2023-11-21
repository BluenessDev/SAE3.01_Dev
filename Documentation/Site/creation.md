## Documentation du fichier creation.php

### Établissement de la connexion à la base de données :

- Les informations de connexion à la base de données MySQL sont définies (`$host`, `$username`, `$password`).
- La connexion est établie en utilisant `mysqli_connect()`.
- La base de données spécifique est sélectionnée avec `mysqli_select_db()`.

### Traitement du formulaire d'inscription :

1. **Validation des données postées** :
   - Vérifie si les champs requis (`email`, `login`, `creapassword`, `confpassword`) sont définis dans la requête POST.
   - Récupère ces valeurs et applique la fonction `md5()` au mot de passe pour le crypter avant de l'insérer dans la base de données.

2. **Requêtes SQL** :
   - Utilisation de requêtes préparées (`mysqli_prepare()`, `mysqli_stmt_bind_param()`, `mysqli_stmt_execute()`) pour éviter les attaques par injection SQL.
   - Vérifie d'abord si le login existe déjà dans la table des utilisateurs (`SELECT * FROM $table WHERE login=?`).
   - Si le login n'existe pas, vérifie si les mots de passe saisis correspondent.
   - Si les mots de passe correspondent, insère les données (`INSERT INTO $table`) dans la table des utilisateurs.
   - Ensuite, effectue une vérification en utilisant les identifiants nouvellement créés (`SELECT * FROM $table WHERE login=? AND password=?`).

3. **Gestion des redirections** :
   - En cas de succès de l'inscription et de la vérification, démarre une session (`session_start()`), stocke les informations de session (`$_SESSION['login']`, `$_SESSION['date']`) et redirige vers `index.php`.
   - En cas d'échec pour diverses raisons (login existant, mots de passe non correspondants, échec des requêtes SQL), redirige vers `form_inscr.php` avec un paramètre d'erreur spécifique dans l'URL (`error=1`, `error=2`).

4. **Flux conditionnels** :
   - Le code vérifie également si les champs requis ne sont pas définis dans la requête POST ou redirige directement vers `index.php`.

### Points à noter :

- Le code utilise des fonctions de gestion de bases de données `mysqli` pour effectuer des opérations sécurisées sur la base de données.
- Il utilise des requêtes préparées pour empêcher les attaques par injection SQL.
- Les mots de passe sont cryptés avant d'être stockés dans la base de données.

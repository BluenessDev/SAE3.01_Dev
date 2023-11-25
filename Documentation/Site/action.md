## Documentation du fichier action.php

### Établissement de la connexion à la base de données :
- Les informations de connexion (`$host`, `$username`, `$password`) à la base de données MySQL sont définies.
- La connexion est initiée via `mysqli_connect()` et la base de données spécifique est sélectionnée avec `mysqli_select_db()`.

### Traitement du formulaire de connexion :
1. **Validation des données postées** :
   - Vérifie si les champs requis (`login`, `password`) sont définis dans la requête POST.

2. **Requête SQL pour l'authentification** :
   - Utilisation d'une requête préparée (`mysqli_prepare()`, `mysqli_stmt_bind_param()`, `mysqli_stmt_execute()`) pour éviter les attaques par injection SQL.
   - Vérifie la correspondance des informations de connexion (`login` et `password`) avec la base de données via une requête SQL (`SELECT * FROM $table WHERE login=? AND password=?`).

3. **Gestion des résultats de la requête** :
   - Si la requête retourne un seul enregistrement correspondant, démarre une session PHP (`session_start()`).
   - Stocke les informations de session (`$_SESSION['login']`, `$_SESSION['date']`) et redirige vers `index.php`.
   - En cas d'échec d'authentification, redirige vers `form_connect.php?error=1` pour afficher un message d'erreur spécifique.

4. **Flux conditionnels** :
   - Si les champs requis ne sont pas définis dans la requête POST, redirige également vers `form_connect.php?error=1`.

### Points à noter :
- Utilisation de méthodes sécurisées pour interagir avec la base de données à l'aide des fonctions `mysqli`.
- Utilisation de requêtes préparées pour éviter les risques d'injection SQL.
- Utilisation de l'algorithme de hachage `md5()` pour stocker les mots de passe.

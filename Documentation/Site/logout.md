## Documentation du fichier logout.php

Ce fichier est dédié à la gestion de la déconnexion d'un utilisateur de votre application.

### Processus de déconnexion :

1. **Démarrage de la session** :
   - Démarre ou récupère une session existante en utilisant `session_start()`.

2. **Vérification de la requête GET** :
   - Vérifie si la clé `out` est présente dans la requête GET ($_GET['out']).
   - Si oui :
      - Supprime les variables de session associées à la connexion de l'utilisateur (`$_SESSION['login']`, `$_SESSION['date']`) à l'aide de `unset()`.
      - Détruit la session avec `session_destroy()`.
      - Redirige l'utilisateur vers la page d'accueil (`index.php`) après la déconnexion en utilisant `header()` et `Location`.

3. **Flux conditionnels** :
   - Si la clé `out` n'est pas présente dans la requête GET, l'utilisateur est redirigé vers la page d'accueil (`index.php`).

### Points à noter :

- Ce fichier est utilisé pour gérer la déconnexion des utilisateurs de votre application.
- Il vérifie la présence de la clé 'out' dans la requête GET pour déclencher le processus de déconnexion.
- Une fois la déconnexion effectuée, l'utilisateur est redirigé vers la page d'accueil de votre application.

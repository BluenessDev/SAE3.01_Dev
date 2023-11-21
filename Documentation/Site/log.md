## Documentation du fichier log.php

Ce fichier est responsable de l'affichage de la page des logs pour un utilisateur connecté.

### Affichage de la page des logs :

1. **Démarrage de la session** :
   - Commence ou restaure une session existante en utilisant `session_start()`.

2. **Récupération de l'identifiant de l'utilisateur** :
   - Récupère l'identifiant de l'utilisateur connecté depuis la variable de session `$_SESSION['login']` et le stocke dans la variable `$utilisateur`.

3. **Vérification de la session utilisateur** :
   - Vérifie si l'utilisateur est connecté en vérifiant si la clé `$_SESSION['login']` est définie.
   - Si l'utilisateur est connecté :
      - Affiche une structure HTML pour la page des logs avec les éléments suivants :
         - Doctype HTML et métadonnées pour la configuration de la page.
         - Liens vers des fichiers CSS et l'icône du site.
         - En-tête de la page avec une barre de navigation contenant un lien pour la déconnexion (`logout.php?out`).
         - Affiche le nom de l'utilisateur connecté et indique qu'il est sur la page des logs.
         - Inclut le contenu de la page des logs à partir du fichier `log.html`.
         - Inclut le contenu du pied de page à partir du fichier `footer.html`.

4. **Redirection en cas d'utilisateur non connecté** :
   - Si l'utilisateur n'est pas connecté (la session n'est pas active), l'utilisateur est redirigé vers la page d'accueil (`index.php`) en utilisant `header()` et `Location`.

### Points à noter :

- Ce fichier est destiné à afficher la page des logs pour un utilisateur connecté.
- Il vérifie la présence d'une session active pour l'utilisateur avant d'afficher le contenu de la page.
- En cas d'absence de session, l'utilisateur est redirigé vers la page d'accueil.

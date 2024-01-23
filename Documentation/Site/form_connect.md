## Structure de la page form_connect.php :

### Établissement de la connexion à la base de données :
- Les informations de connexion (`$host`, `$username`, `$password`) à la base de données MySQL sont définies.
- La connexion est initiée via `mysqli_connect()` et la base de données spécifique est sélectionnée avec `mysqli_select_db()`.

#### Section `<head>` :
- Déclaration du doctype, de l'encodage et de la langue.
- Inclusion d'une feuille de style CSS et de l'icône du site.

#### Section `<body>` :
- Inclusion du contenu de `banner.html`.
- Section `<main>` contenant un formulaire de connexion.
  - Le formulaire a des champs pour le login et le mot de passe.
  - Un lien pour réinitialiser le mot de passe (`forgot.html`) est inclus.
  - Un message d'erreur est affiché si le paramètre `error` dans l'URL est présent et a la valeur 1 (Mot de passe incorrect).
- Inclusion du contenu de `footer.html`.

### Explication détaillée des parties importantes :

1. **Inclusion de fichiers HTML** :
   - `banner.html` est inclus au début de la page, pour afficher des éléments communs à plusieurs pages.
   - `footer.html` est inclus à la fin de la page, pour afficher le pied de page commun à plusieurs pages.

2. **Formulaire de connexion** :
   - Le formulaire est composé de champs de saisie pour le login et le mot de passe.
   - Un lien est fourni pour réinitialiser le mot de passe (`forgot.html`).

3. **Gestion des erreurs** :
   - Si le paramètre `error` est présent dans l'URL et est égal à 1, un message d'erreur "Mot de passe incorrect" est affiché en rouge.

4. **Balises et Classes CSS** :
   - Le code HTML utilise des balises sémantiques comme `<main>`, `<div>`, `<form>`, `<input>`, etc., pour structurer la page.
   - Des classes CSS (`article`, `main-article`, `ligne`, `subarticle`, `titre`, `login`, `password`, `iforgor`, `submit`) sont utilisées pour la mise en page et la stylisation via des règles CSS.

### Traitement du formulaire de connexion :
1. **Validation des données postées** :
    - Vérifie si les champs requis (`login`, `password`) sont définis dans la requête POST.

2. **Requête SQL pour l'authentification** :
    - Nettoyage des eventuelles injections HTML avec `strip_tags()`
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
- Utilisation de l'algorithme de hachage `Chiffrement_RC4()` pour stocker les mots de passe dans la base de données.

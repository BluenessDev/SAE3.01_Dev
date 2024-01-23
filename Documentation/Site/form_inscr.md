## Structure de la page form_inscr.php :

### Établissement de la connexion à la base de données :
- Les informations de connexion à la base de données MySQL sont définies (`$host`, `$username`, `$password`).
- La connexion est établie en utilisant `mysqli_connect()`.
- La base de données spécifique est sélectionnée avec `mysqli_select_db()`.

### Affichage du formulaire d'inscription :

#### Section `<head>` :
- Déclaration du doctype, de l'encodage et de la langue.
- Inclusion d'une feuille de style CSS et de l'icône du site.

#### Section `<body>` :
- Inclusion du contenu de `banner.html`.
- Section `<main>` contenant un formulaire d'inscription.
  - Le formulaire a des champs pour l'email, le login, le mot de passe et la confirmation du mot de passe ainsi qu'un captcha.
  - Un message d'erreur est affiché dans les cas suivants :
    - Si les mots de passe ne correspondent pas (paramètre `error` = 1).
    - Si le login est déjà utilisé (paramètre `error` = 2).
- Inclusion du contenu de `footer.html`.

### Explication détaillée des parties importantes :

1. **Inclusion de fichiers HTML** :
   - `banner.html` est inclus au début de la page, pour afficher des éléments communs à plusieurs pages.
   - `footer.html` est inclus à la fin de la page, pour afficher le pied de page commun à plusieurs pages.

2. **Formulaire d'inscription** :
   - Le formulaire est composé de champs de saisie pour l'email, le login, le mot de passe et la confirmation du mot de passe.
   - Lors de la soumission, le formulaire est dirigé vers `creation.php`.
   - Des messages d'erreur sont affichés si les paramètres `error` dans l'URL correspondent à certaines conditions (mots de passe non correspondants ou login déjà utilisé).

3. **Balises et Classes CSS** :
   - Le code HTML utilise des balises sémantiques comme `<main>`, `<div>`, `<form>`, `<input>`, etc., pour structurer la page.
   - Des classes CSS (`article`, `main-article`, `ligne`, `subarticle`, `titre`, `email`, `login`, `creapassword`, `confpassword`, `submit`) sont utilisées pour la mise en page et la stylisation via des règles CSS.

4. **Fonctionnement du capcha** : 
   - Le capcha est généré aléatoirement à l'aide de la fonction `rand()`.
   - Le capcha est stocké dans une variable de session (`$_SESSION['capcha']`).
   - Le capcha est affiché dans le formulaire d'inscription.
   - Lors de la soumission du formulaire, le capcha est vérifié en comparant la valeur du champ `capcha` avec la valeur de la variable de session `$_SESSION['capcha']`.
   - Si les valeurs correspondent, le formulaire est soumis normalement.
   - Si les valeurs ne correspondent pas, le formulaire est redirigé vers `form_inscr.php?error=3` pour afficher un message d'erreur spécifique.
   
### Traitement du formulaire d'inscription :
1. **Validation des données postées** :
   - Nettoyage des éventuelles injections HTML avec `strip_tags()`.
   - Verifie si apres le nettoyage des injections HTML, le champ login n'est pas vide.
   - Vérifie si les champs requis (`email`, `login`, `creapassword`, `confpassword`) sont définis dans la requête POST.
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

- Le code utilise des requêtes préparées pour sécuriser les interactions avec la base de données.
- Les redirections sont utilisées pour informer l'utilisateur sur les résultats des actions effectuées.
- Les messages de succès ou d'erreur sont affichés en fonction des opérations réalisées.
- La modification de l'email et du mot de passe se fait sous conditions strictes de vérification des identifiants actuels.

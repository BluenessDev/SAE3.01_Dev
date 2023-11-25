### Structure de la page form_inscr.php :

#### Section `<head>` :
- Déclaration du doctype, de l'encodage et de la langue.
- Inclusion d'une feuille de style CSS et de l'icône du site.

#### Section `<body>` :
- Inclusion du contenu de `banner.html`.
- Section `<main>` contenant un formulaire d'inscription.
  - Le formulaire a des champs pour l'email, le login, le mot de passe et la confirmation du mot de passe.
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

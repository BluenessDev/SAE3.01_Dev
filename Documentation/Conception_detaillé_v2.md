# Conception détaillé  

## Introduction

### Objectifs du Site Web dynamique

L'Objectif de cette deuxième version est d'ajouter du code PHP au site web statique présenté dans la version 1. Pour cela, nous allons garder les figures présenter dans la version 1 auxquels noua allons rajouter celles de la version 2. 
Cette deuxième version permettra ainsi aux client de pouvoir s'inscrire et se connecter afin de pouvoir acceder a leurs pages personnel tel que la page "Index_connected" et "profil". Pour cela le code PHP aura accès a une base de donnée contenant les utilisateur inscrit.

#### Portée du Projet

C'est un site dynamique qui permettra d'inscrire des utilisateur et de se connecter en plus de visualiser les fonctionnalité furtur de l'application web.

### Methode de Conception

Les pages du site web ainsi que les fichiers PHP seront défini en tant que composant d'un plus grand composant qui est le site Web (Domaine du problème).
Un deuxième composant sera la base de données a l'interieur de ce composant il y aura deux autres composant qui sont users et tickets représentant les tables de la base de données.

### Fonctionnalité et relation

#### Version avec Inscription/Connexion

- Page d'accueil (index.html) : Contenant une vidéo, un texte explicatif et des boutons de redirection vers les pages de formulaire de connexion (form_connect.html) et d'inscription (form_inscr.html).
- Page de formulaire de connexion (form_connect.html) : Contenant un formulaire permettant a l'utilisateur d'accéder à la page "Index_connected" via la base de données "users".
- Page de formulaire d'inscription (form_inscr.html) : Contenant un formulaire permettant a l'utilisateur de se creer un compte puis acceder à la page "Index_connected" en créant cet utilisateurs dan la base de données "users".

#### Version avec un Accès au Profil

- Page d'accueil connecté (index_connected.html) : Présentant une vidéo, un texte explicatif, le tableau des 10 dernières demandes et un bouton de redirection vers la page de profil (profil.html).
- Page de profil (profil.html) : Présentant un formulaire de modification du mot de passe, de l'adresse e-mail, l'affichage d'informations sur le profil de l'utilisateur et un tableau de bord pour les tickets.
- Page de faux logs (log.html) : En construction, pour des connexions factices contenant un tableaux avec des faux logs.

Pour cette version, nous avons choisis la maquette 1 du site web. Le projet évoluera au fil du temps pour inclure des fonctionnalités plus avancées, conformément au planning établi.
De plus, dans la base de données la table tickets a été créée mais est une table vide. Elle est présente pour anticiper son utilisation a venir. 

### Abstraction du Domaine

| Composant           | État                      | Comportement|
|---------------------|---------------------------|----------------------------------------------|
| Page d'accueil avec l'inscription et connexion  |                | - Afficher vidéo, texte explicatif, accès au formulaire d'inscrition et de connection           |
| Page d'accueil avec profil | Accès au Profil    | - Afficher vidéo, texte explicatif, accès au profil et la page de faux logs|
| Page de formulaire de connexion |       | - En construction, accessible depuis la page d'accueil |
| Page de formulaire d'inscription |        | - En construction, accessible depuis la page d'accueil |
| Page de profil      |                | - En construction, affiche les informations sur le profil, permet la modification du mot de passe et de l'adresse e-mail, affiche le tableau de bord pour les tickets |
| Page de faux logs   |               | - En construction, pour des connexions factices |
| Charte graphique 1 et 2                |                | - Définit les styles pour l'ensemble du site web |
| Base de données users | Contient les utilisateurs inscrit |                                    |
| Base de données tickets |                       |                                              |
| Système de conexion au profil |      | Se connecter a son comptes |
| Systeme d'inscription sur le site |                        | Créer un nouvel utilisateur |
| Systeme de déconnexion de l'utilisateur |                 |  Déconnecter l'utilisateur  |
 
**Figure 1 :** Abstraction du domaine du problème.

Création du composant **Index** pour l'abstraction de Page d'accueil avec inscritpion et connexion

Création du composant **Form_inscr** pour l'abstraction du formulaire d'inscription

Création du composant **Form_connect** pour l'abstraction du formulaire de connexion

Création du composant **Index_connected** pour l'abstraction de Page d'accueil avec Profil

Création du composant **Logs** pour l'abstraction de Page de faux logs

Création du composant **Profil** pour l'abstraction de Page de profil

Création du composant **style** pour l'abstraction de charte graphique 1 et 2

Création du composant **action** pour l'abstraction de la gestion de la connexion.

Création du composant **creation** pour l'abstraction de la gestion de l'inscription.

Création du composant **logout** pour l'abstraction de la déconnexion de l'utilisateur.

Création du composant **users** pour l'abstraction de la table users de la base de donnée.

Création du composant **tickets** pour l'abstraction de la table tickets de la base de donnée.

<img src="https://cdn.discordapp.com/attachments/1148278381767569508/1165323728851320892/Diagramme_de_Composants.jpg?ex=65466f4b&is=6533fa4b&hm=08c0d0e2fe92f25e64b4b1f73f4f07f32aab368d927e18d424bfd1a39ebfa774&">

**Figure 2 :** Diagramme UML des composants du site web statique

### Spécification des composants

**Index**

1. **En-tête (Header)** :
   - Composants :
     - `<header>` contenant la barre de navigation (`<nav>`) et le contenu de l'en-tête.
     - Barre de navigation (`<nav>`) avec deux liens (Connexion et Inscription).
     - Logo du site (`<img>`) et les titres ("Bienvenue sur TICKIMOA" et "Votre site de ticketing").
   - Relation : La barre de navigation contiendra des liens vers d'autres pages du site (Connexion et Inscription). Le logo et les titres serviront d'éléments de branding du site.

2. **Contenu Principal (Main)** :
   - Composants :
     - Deux sections distinctes d'articles (`<div class="article">`) avec des éléments de contenu.
     - La première section comportera un titre ("Explications") et un paragraphe explicatif.
     - La deuxième section comprendra un titre ("Vidéo démonstration") et une vidéo YouTube, ainsi qu'un tableau présentant les 10 derniers tickets.
   - Relation : Les deux sections d'articles seront indépendantes, chacune présentant un contenu différent. Cependant, elles seront regroupées sous la balise `<main>` pour indiquer qu'il s'agit du contenu principal de la page.

3. **Pied de page (Footer)** :
   - Composants :
     - Balise `<footer>` contenant des informations sur la plateforme de ticketing (SAÉ 3.01) et le logo de l'UVSQ.
   - Relation : Le pied de page contiendra des informations sur la plateforme et inclura le logo de l'UVSQ pour la crédibilité et la marque.

**index_connected**

1. **En-tête (Header)** :
   - Composants :
     - Balise `<header>` qui contient la barre de navigation (`<nav>`) et le contenu de l'en-tête.
     - Barre de navigation (`<nav>`) avec un lien (Se déconnecter).
     - Logo du site avec un lien de retour à la page d'accueil.
     - Titres dynamiques ("Ravi de vous revoir CYRIL" et "Vous êtes sur la page d'accueil").
   - Relation : La barre de navigation permet de se déconnecter. Le logo renvoie à la page d'accueil. Les titres varient en fonction de la session utilisateur.

2. **Contenu Principal (Main)** :
   - Composants :
     - Deux sections distinctes d'articles (`<div class="article">`) avec des éléments de contenu.
     - La première section comporte trois boutons avec des liens vers différentes pages (Accéder au profil, Ouvrir un ticket, Voir les logs).
     - La deuxième section inclut un titre ("Mes derniers tickets ouverts") et un tableau affichant les derniers tickets.
   - Relation : Les boutons permettent à l'utilisateur de naviguer vers différentes sections du site. Le tableau présente les derniers tickets de l'utilisateur.

3. **Pied de page (Footer)** :
   - Composants :
     - Balise `<footer>` contenant des informations sur la plateforme de ticketing (SAÉ 3.01) et le logo de l'UVSQ.
   - Relation : Le pied de page affiche des informations sur la plateforme et inclut le logo de l'UVSQ pour la crédibilité et la marque.

**Form_connect**

1. **En-tête (Header)** :
   - Composants :
     - Balise `<header>` qui contient la barre de navigation (`<nav>`) et le contenu de l'en-tête.
     - Barre de navigation (`<nav>`) avec deux liens (Connexion et Inscription).
     - Logo du site avec un lien de retour à la page d'accueil.
     - Titres ("Bienvenue sur TICKIMOA" et "Votre site de ticketing").
   - Relation : La barre de navigation contient des liens vers d'autres pages du site (Connexion et Inscription). Le logo permet de revenir à la page d'accueil.

2. **Contenu Principal (Main)** :
   - Composants :
     - Une image représentant le bâtiment Mermoz de l'UVSQ de Velizy-Villacoublay.
     - Une section de formulaire pour la connexion, avec un titre "Se connecter".
     - Le formulaire comporte des champs pour le login et le mot de passe, ainsi qu'un lien "Mot de passe oublié ?".
   - Relation : Les éléments du formulaire permettent aux utilisateurs de se connecter au site. Le lien "Mot de passe oublié ?" offre une option de récupération du mot de passe.

3. **Pied de page (Footer)** :
   - Composants :
     - Balise `<footer>` contenant des informations sur la plateforme de ticketing (SAÉ 3.01) et le logo de l'UVSQ.
   - Relation : Le pied de page fournit des informations sur la plateforme et inclut le logo de l'UVSQ pour la crédibilité et la marque.

**Form_inscr**

1. **En-tête (Header)** :
   - Composants :
     - Balise `<header>` qui contient la barre de navigation (`<nav>`) et le contenu de l'en-tête.
     - Barre de navigation (`<nav>`) avec deux liens (Connexion et Inscription).
     - Logo du site avec un lien de retour à la page d'accueil.
     - Titres ("Bienvenue sur TICKIMOA" et "Votre site de ticketing").
   - Relation : La barre de navigation contient des liens vers d'autres pages du site (Connexion et Inscription). Le logo permet de revenir à la page d'accueil.

2. **Contenu Principal (Main)** :
   - Composants :
     - Une image représentant le bâtiment administratif de l'UVSQ à Vélizy-Villacoublay.
     - Une section de formulaire pour l'inscription, avec un titre "Créer un compte".
     - Le formulaire comporte des champs pour l'email, le login, le mot de passe, et la confirmation du mot de passe.
   - Relation : Les éléments du formulaire permettront aux utilisateurs de créer un compte sur le site.

3. **Pied de page (Footer)** :
   - Composants :
     - Balise `<footer>` contenant des informations sur la plateforme de ticketing (SAÉ 3.01) et le logo de l'UVSQ.
   - Relation : Le pied de page fournit des informations sur la plateforme et inclut le logo de l'UVSQ pour la crédibilité et la marque.

**Logs**

1. **En-tête (Header)** :
   - Composants :
     - Balise `<header>` qui contient la barre de navigation (`<nav>`) et le contenu de l'en-tête.
     - Barre de navigation (`<nav>`) avec un lien (Se déconnecter).
     - Logo du site avec un lien de retour à la page d'accueil.
     - Titres dynamiques ("Ravi de vous revoir CYRIL" et "Vous êtes sur la page des logs").
   - Relation : La barre de navigation permet de se déconnecter. Le logo renvoie à la page d'accueil. Les titres varient en fonction de la session utilisateur.

2. **Contenu Principal (Main)** :
   - Composants :
     - Une section de liste de logs avec un titre "Liste des logs".
     - Un tableau affichant les logs avec des colonnes pour les noms de logs et les dates.
   - Relation : Le tableau affiche une liste de logs avec leurs dates associées.

3. **Pied de page (Footer)** :
   - Composants :
     - Balise `<footer>` contenant des informations sur la plateforme de ticketing (SAÉ 3.01) et le logo de l'UVSQ.
   - Relation : Le pied de page fournit des informations sur la plateforme et inclut le logo de l'UVSQ pour la crédibilité et la marque.

**Profil**

1. **En-tête (Header)** :
   - Composants :
     - Balise `<header>` qui contient la barre de navigation (`<nav>`) et le contenu de l'en-tête.
     - Barre de navigation (`<nav>`) avec un lien (Se déconnecter).
     - Logo du site avec un lien de retour à la page d'accueil.
     - Titres dynamiques ("Ravi de vous revoir CYRIL" et "Vous êtes sur la page profil").
   - Relation : La barre de navigation permet de se déconnecter. Le logo renvoie à la page d'accueil. Les titres varient en fonction de la session utilisateur.

2. **Contenu Principal (Main)** :
   - Composants :
     - Deux sections distinctes pour changer l'email et le mot de passe.
     - Chaque section a un titre ("Changer l'email" et "Changer le mot de passe").
     - Formulaires pour changer l'email et le mot de passe, avec des champs correspondants.
   - Relation : Les sections permettent à l'utilisateur de changer son email et son mot de passe.

3. **Pied de page (Footer)** :
   - Composants :
     - Balise `<footer>` contenant des informations sur la plateforme de ticketing (SAÉ 3.01) et le logo de l'UVSQ.
   - Relation : Le pied de page fournit des informations sur la plateforme et inclut le logo de l'UVSQ pour la crédibilité et la marque.

**Style**

**Voir le documents de la spécification de la charte graphique et les maquettes 1 et 2**


### Conclusion
Ce document de conception détaillée expose la structure et la hiérarchie des composants de notre site web statique. Il décrit les différentes pages du site, y compris les pages d'accueil, les pages de formulaire d'inscription et de connexion, la page du profil, la page des logs, et les chartes graphiques associées. Il identifie les principaux composants de chaque page, tels que l'en-tête, le contenu principal et le pied de page, ainsi que les éléments spécifiques à chaque page.

# Conception détaillée  

## Introduction

### Objectifs du Site Web dynamique

L'Objectif de cette deuxième version est d'ajouter du code PHP au site web statique présenté dans la version 1. Pour cela, nous allons garder les figures présenter dans la version 1 auxquels noua allons rajouter celles de la version 2. 
Cette deuxième version permettra ainsi aux clients de pouvoir s'inscrire et se connecter afin de pouvoir accéder à leurs pages personnel tel que la page "Index_connected" et "profil". Pour cela, le code PHP aura accès à une base de donnée contenant les utilisateurs inscrit.

#### Portée du Projet

C'est un site dynamique qui permettra d'inscrire des utilisateurs et de se connecter en plus de visualiser les fonctionnalités futures de l'application web.

### Méthode de Conception

Les pages du site web ainsi que les fichiers PHP seront définis en tant que composant d'un plus grand composant qui est le site Web (Domaine du problème).
Un deuxième composant sera la base de données, à l'intérieur de ce composant, il y aura deux autres composants qui sont users et tickets représentant les tables de la base de données.

### Fonctionnalité et relation

#### Version avec Inscription/Connexion

- Page d'accueil (index.html) : Contenant une vidéo, un texte explicatif et des boutons de redirection vers les pages de formulaire de connexion (form_connect.html) et d'inscription (form_inscr.html).
- Page de formulaire de connexion (form_connect.html) : Contenant un formulaire permettant à l'utilisateur d'accéder à la page "Index_connected" via la base de données "users".
- Page de formulaire d'inscription (form_inscr.html) : Contenant un formulaire permettant à l'utilisateur de se créer un compte puis accéder à la page "Index_connected" en créant cet utilisateur dans la base de données "users".

#### Version avec un Accès au Profil

- Page d'accueil connecté (index_connected.html) : Présentant une vidéo, un texte explicatif, le tableau des 10 dernières demandes et un bouton de redirection vers la page de profil (profil.html).
- Page de profil (profil.html) : Présentant un formulaire de modification du mot de passe, de l'adresse e-mail, l'affichage d'informations sur le profil de l'utilisateur et un tableau de bord pour les tickets.
- Page de faux logs (log.html) : En construction, pour des connexions factices contenant un tableau avec des faux logs.

Pour cette version, nous avons choisi la maquette 1 du site web. Le projet évoluera au fil du temps pour inclure des fonctionnalités plus avancées, conformément au planning établi.
De plus, dans la base de données, la table tickets a été créée, mais est une table vide. Elle est présente pour anticiper son utilisation à venir. 

### Abstraction du Domaine

| Composant           | État                      | Comportement|
|---------------------|---------------------------|----------------------------------------------|
| Page d'accueil avec l'inscription et connexion  |                | - Afficher la vidéo, texte explicatif, accès au formulaire d'inscription et de connexion           |
| Page d'accueil avec profil | Accès au Profil    | - Afficher vidéo, texte explicatif, accès au profil, selon le role de l'utilisateur le profil changera et certains accès seront bloqué|
| Page de formulaire de connexion |       | -  accessible depuis la page d'accueil |
| Page de formulaire d'inscription |        | accessible depuis la page d'accueil |
| Page de profil      |                | -  affiche les informations sur le profil, permet la modification du mot de passe et de l'adresse e-mail, affiche le tableau de bord pour les tickets |
| Page de logs   |               | - acces aux information de connexions|
| Charte graphique 1 et 2                |                | - Définit les styles pour l'ensemble du site web |
| Base de données users | Contient les utilisateurs inscrits ainsi que leur roles|                                    |
| Base de données tickets |                       |Contient les informations obtenue à partir de la page de création des tickets|
| Système de connexion au profil |      | Se connecter à son compte |
| Système d'inscription sur le site |                        | Créer un nouvel utilisateur |
| Système de déconnexion de l'utilisateur |                 |  Déconnecter l'utilisateur  |
| page de gestions des rôles |   changement possible entre Utilisateur et Techniciens  |  changer les rôles des utilisateurs |
| page d'information des tickets|   3 états possible du tickets ouvert/en cours/fini |  selon le role on peut ajouter un techniciens à un ticket dans le cas de l'administrateur web, qui changera aussi l'état en "en cours" et pour le techniciens on 
 pourras changer l'etat en "fini" si le tickets est fini |
| page de création de ticket |  a la création le ticket sera libellé en "ouvert" | permet de créer un ticket avec la nature, le niveau d'urgence, la salle, le demandeur, la personne concernée et le descriptif |
| page php functions |     |  page php, fonction qui permettra d'aérer le les pages php avec moins de fonction pour une meilleurs compréhension|
| page de Dashboard |   include dans l'index  | Tableau de bord de l'utilisateur ainsi que des boutons des différentes pages   tel que page de création de tickets, accès des logs, accès profil, et les information tickets|
| page de javascript TabsTicket |                |   changement des tableaux des dashboards selon l'etat du ticket   |
 
**Figure 1 :** Abstraction du domaine du problème.

Création du composant **Index** pour l'abstraction de Page d'accueil avec inscription et connexion

Création du composant **Form_inscr** pour l'abstraction du formulaire d'inscription

Création du composant **Form_connect** pour l'abstraction du formulaire de connexion

Création du composant **Index_connected** pour l'abstraction de Page d'accueil avec Profil

Création du composant **Logs** pour l'abstraction de Page de faux logs

Création du composant **Profil** pour l'abstraction de Page de profil

Création du composant **CSS** pour l'abstraction de la maquette.

Création du composant **action** pour l'abstraction de la gestion de la connexion.

Création du composant **creation** pour l'abstraction de la gestion de l'inscription.

Création du composant **logout** pour l'abstraction de la déconnexion de l'utilisateur.

Création du composant **users** pour l'abstraction de la table users de la base de donnée.

Création du composant **tickets** pour l'abstraction de la table tickets de la base de donnée.

Création du composant **create_ticket** pour l'abstraction de la page de création de ticket.

Création du composant **dashboard** pour l'abstraction de la page de Dashboard.

Création du composant **ticket_informations** pour l'abstraction de la page d'information des tickets.

Création du composant **functions** pour l'abstraction de la page php page de function.

Création du composant **assigner_role** pour l'abstraction de la page de gestions des rôles.

Création du composant **TabsTicket** pour l'abstraction de la page de javascript TabsTicket.

<img src="https://cdn.discordapp.com/attachments/688468048985849886/1198712308285853706/image.png?ex=65bfe6d5&is=65ad71d5&hm=391fb2c469b35ab2f06355aa1151d3431aa01fae7d65a3c2270877e0a6f3dd3b&">

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
     - La deuxième section comprendra un titre ("Vidéo démonstration") et une vidéo YouTube, ainsi qu'un include de la page de Dashboard.
   - Relation : Les deux sections d'articles seront indépendantes, chacune présentant un contenu différent. Cependant, elles seront regroupées sous la balise `<main>` pour indiquer qu'il s'agit du contenu principal de la page.

3. **Pied de page (Footer)** :
   - Composants :
     - Balise `<footer>` contenant des informations sur la plateforme de ticketing (SAÉ 3.01) et le logo de l'UVSQ.
   - Relation : Le pied de page contiendra des informations sur la plateforme et inclura le logo de l'UVSQ pour la crédibilité et la marque.

**Dashboard**

**1. En-tête (Header):**
   - *Composants:*
      - `<header>` contenant la barre de navigation (`<nav>`) et le contenu de l'en-tête.
      - Logo du site (`<img>`) et les titres ("Bienvenue sur TICKIMOA" et "Votre site de ticketing").

**2. Contenu Principal (Main):**
   - *Composants:*
      - Deux sections distinctes d'articles (`<div class="article">`) avec des éléments de contenu.
      - avec tout les boutons des différentes pages avec des accès différent selon les rôles 
      - Le dashboard avec les différents tickets et les boutons ouvert, en cours et fini, les tickets sont des liens qui mènes à leur informations
   - *Relation :* Les deux sections d'articles seront indépendantes, chacune présentant un contenu différent. Cependant, elles seront regroupées sous la balise `<main>` pour indiquer qu'il s'agit du contenu principal de la page.

**3. Pied de page (Footer):**
   - *Composants:*
      - Balise `<footer>` contenant des informations sur la plateforme de ticketing (SAÉ 3.01) et le logo de l'UVSQ.
   - *Relation :* Le pied de page contiendra des informations sur la plateforme et inclura le logo de l'UVSQ pour la crédibilité et la marque.

**TabsTicket**

1. **Fonction `init`:**
   - La fonction `init` est associée à l'événement `window.onload`, ce qui signifie qu'elle est appelée lorsque la page est entièrement chargée.
   - À l'intérieur de la fonction, une requête XMLHttpRequest est créée et ouverte pour récupérer le contenu de "dashboard.php".
   - La fonction `traitementReponse` est définie comme gestionnaire d'événements pour le changement d'état de la requête.

2. **Fonction `traitementReponse`:**
   - Cette fonction est appelée chaque fois que l'état de la requête change.
   - Si l'état est 4 (requête terminée) et le statut est 200 (OK), la fonction effectue les opérations suivantes :
     - Cache tous les éléments avec la classe "tabcontent".
     - Associe un gestionnaire d'événements à chaque enfant de l'élément avec l'ID "tab". Lorsque ces éléments sont cliqués, la fonction `openTicketButton` est appelée.
   - Elle prépare l'interface pour interagir avec les onglets.

3. **Fonction `openTicketButton`:**
   - Cette fonction gère l'ouverture et la fermeture des onglets.
   - Elle prend un objet d'événement en paramètre (evt) et récupère l'ID du contenu associé à l'onglet cliqué.
   - Elle gère également la logique pour afficher ou masquer le contenu de l'onglet et ajuste l'affichage en conséquence.
   - La variable `dernierOngletClique` est utilisée pour suivre le dernier onglet cliqué afin de gérer les cas où le même onglet est cliqué deux fois.
   - Les classes "tabcontent" et "tablinks" sont ajustées pour refléter l'état actif de l'onglet sélectionné.

**Functions**

1. **Afficher Tickets**
   - Fonction qui affiche les tickets en fonction du rôle de l'utilisateur et de leur état.

2. **Afficher Utilisateurs**
   - Fonction affichant une liste d'utilisateurs avec la possibilité de mettre à jour leur rôle.

3. **Sélection du Technicien**
   - Fonction affichant un formulaire pour sélectionner un technicien lors de la création ou de la modification d'un ticket.

4. **Assignation du Technicien au Ticket**
   - Fonction assignant un technicien à un ticket et mettant à jour son état.

5. **Mise à Jour de l'État du Ticket**
   - Fonction mettant à jour l'état d'un ticket, généralement appelée après l'assignation d'un technicien.

**create_ticket**

**1. En-tête (Header):**
   - *Composants:*
      - `<header>` contenant la barre de navigation (`<nav>`) et le contenu de l'en-tête.
      - Logo du site (`<img>`) et les titres ("Bienvenue sur TICKIMOA" et "Votre site de ticketing").

**2. Contenu Principal (Main):**
   - *Composants:*
      - Deux sections distinctes d'articles (`<div class="article">`) avec des éléments de contenu.
      - première section à droite avec le type de problème, le niveau, la salle, le demandeur et la personne concernée
      - Block de texte pour ajouter une description au problème 
   - *Relation :* Les deux sections d'articles seront indépendantes, chacune présentant un contenu différent. Cependant, elles seront regroupées sous la balise `<main>` pour indiquer qu'il s'agit du contenu principal de la page.
    
  **3. Pied de page (Footer):**
   - *Composants:*
      - Balise `<footer>` contenant des informations sur la plateforme de ticketing (SAÉ 3.01) et le logo de l'UVSQ.
   - *Relation :* Le pied de page contiendra des informations sur la plateforme et inclura le logo de l'UVSQ pour la crédibilité et la marque.

**ticket_informations**

 **1. En-tête (Header):**
   - *Composants:*
      - `<header>` contenant la barre de navigation (`<nav>`) et le contenu de l'en-tête.
      - Logo du site (`<img>`) et les titres ("Bienvenue sur TICKIMOA" et "Votre site de ticketing").

 **2. Contenu Principal (Main):**
   - *Composants:*
      - Deux sections distinctes d'articles (`<div class="article">`) avec des éléments de contenu.
      - première section à droite avec le type de problème, le niveau d'urgence, la salle, le demandeur et la personne concernée
      - deuxième section à gauche Block avec la description donnée du ticket
      - Si admin il y aura un bouton déroulant avec tout les techniciens et un boutons assigner, pour assigner un technicien
      - si technicien bouton marquer comme finir pour marquer le ticket comme fini 
   - *Relation :* Les deux sections d'articles seront indépendantes, chacune présentant un contenu différent. Cependant, elles seront regroupées sous la balise `<main>` pour indiquer qu'il s'agit du contenu principal de la page.
    
**3. Pied de page (Footer):**
   - *Composants:*
      - Balise `<footer>` contenant des informations sur la plateforme de ticketing (SAÉ 3.01) et le logo de l'UVSQ.
   - *Relation :* Le pied de page contiendra des informations sur la plateforme et inclura le logo de l'UVSQ pour la crédibilité et la marque.


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

**CSS**

**Voir le document de la spécification de la charte graphique et la maquette 1 **

**Action**
   - Composant :
     - Code PHP peremettant la connexion d'un utilisateur à son compte.
   - Relation : Vérifie si l'utilisateur et le mot de passe existe dans la base de données. Puis accedes a l'index connécté de l'utilisateur.

 **Creation**
   - Composant :
     - Code PHP permettant de créer un nouvel utilisateur.
   - Relation : Créer un nouvel utilisateur dans la base de données avec les informations du formulaire d'inscription.

**logout**
   - Composant :
     - Code PHP permettant a l'utilisateur de se déconnecter
   - Relation : Supprime la session ouverte par l'utilisateur, il devra se reconnecter la procheine fois qu'il voudra acceder a l'application

**Users**
   - Table de la base de données contenant les utilisateurs inscrits.

**Tickets**
   - Table de la base de données qui contiendra les différents tickets.


### Conclusion
Ce document de conception détaillée expose la structure et la hiérarchie des composants de notre site web dynamique. Il décrit les différentes pages du site, y compris les pages d'accueil, les pages de formulaire d'inscription et de connexion, la page du profil, la page des logs, les pages PHP permettant l'inscription, la connexion et la déconnexion des utilisateurs et la charte graphique associée. Il identifie les principaux composants de chaque page, tels que l'en-tête, le contenu principal et le pied de page, ainsi que les éléments spécifiques à chaque page.



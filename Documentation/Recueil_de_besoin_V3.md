# Recueil de Besoin 3.0

## Introduction

Ce recueil de besoins présente les exigences et spécifications du projet de développement d'une application web statique. L'objectif de cette application est de fournir une interface conviviale aux utilisateurs de l'IUT de Vélizy pour la gestion des demandes de dépannage et des tickets.

Ce document met en évidence les fonctionnalités essentielles de l'application, les acteurs impliqués, les technologies envisagées ainsi que les contraintes et les exigences du projet. Il vise à servir de référence pour l'ensemble de l'équipe de développement et pour tous les intervenants impliqués dans ce projet.

Le projet est basé sur une méthodologie de développement agile, visant à livrer des versions itératives du site. Dans sa première version, le site offrira des fonctionnalités de base telles que l'accès à la page d'accueil, les formulaires de connexion et d'inscription, l'accès au profil et un tableau de bord fictif.

Le présent recueil de besoins sera étoffé et mis à jour au fur et à mesure de l'évolution du projet, intégrant les retours des utilisateurs et les exigences nouvelles émises par le client.

## Glossaire

1. **HTML (HyperText Markup Language)** : Un langage de programmation utilisé pour la mise en page de l'application web.

2. **CSS (Cascading Style Sheets)** : Une technologie utilisée pour embellir la page web en définissant la présentation et le style des éléments HTML.

3. **MySQL** : Un système de gestion de base de données relationnelle utilisé pour stocker et gérer les données de l'application.

4. **Apache** : Un serveur web qui héberge l'application et permet l'accès via le réseau.

5. **GitHub** : Une plateforme de gestion de code source qui héberge la documentation, le code source et les informations du projet.

6. **Serveur RPi 4** : Matériel serveur Raspberry Pi 4, qui sera utilisé pour héberger l'application.

7. **Site web statique** : Un site web dont le contenu ne change pas dynamiquement en fonction des actions de l'utilisateur, il est généralement composé de fichiers HTML, CSS et autres fichiers statiques.

8. **W3C (World Wide Web Consortium)** : Une organisation qui établit des normes pour le World Wide Web, y compris les normes de développement web et d'accessibilité.

9. **Développement agile** : Une méthodologie de développement logiciel itérative qui implique des livraisons fréquentes de versions du logiciel, avec une adaptation aux retours des utilisateurs.

10. **Maquettes de styles** : Des représentations visuelles des conceptions de l'interface utilisateur, généralement utilisées pour planifier la mise en page et le design.

11. **OS Linux (Système d'exploitation Linux)** : Un système d'exploitation open-source basé sur le noyau Linux.

12. **Critères de performance** : Les normes et mesures qui définissent la performance attendue de l'application.

13. **Tests de validation** : Des tests effectués pour vérifier que l'application fonctionne conformément aux spécifications et aux exigences.

14. **Acteur principal** : Le rôle ou l'entité principale impliquée dans un cas d'utilisation ou un processus.

15. **Utilisabilité** : La mesure de la convivialité et de l'efficacité de l'application du point de vue de l'utilisateur.

16. **Version itérative** : Une version du logiciel qui est développée en suivant un processus itératif, où des améliorations sont apportées à chaque itération.




## Tableau OAA+
| Objet                                                  | Acteur                                                 | Action à entreprendre                                                                            |
|--------------------------------------------------------|--------------------------------------------------------|--------------------------------------------------------------------------------------------------|
| Page d'accueil                                         | Visiteur                                               | Visualiser la page d'accueil du site                                                             |
| Formulaire de connexion                                | Utilisateur                                            | Accéder à la page de formulaire de connexion via la page d'accueil                               |
| Formulaire d'inscription                               | Utilisateur                                            | Accéder à la page de formulaire d'inscription via la page d'accueil                              |
| Page de profil                                         | Utilisateur, Administrateur Web et Système, Technicien | Si l'utilisateur est connecté, accéder à la page de profil via la page d'accueil                 |
| Page de faux logs                                      | Administrateur système                                 | Accéder à la page de faux logs via la page d'accueil                                             |
| Tableau de bord                                        | Utilisateur, Administrateur Web et Système, Technicien | Si l'utilisateur est connecté, accéder au tableau de bord fictif via la page d'accueil           |
| Creation de tickets                                    | Utilisateur                                            | Si l'utilisateur est connecté, accéder à la page de création de tickets via son tableau de bord  |
| Affichage des tickets                                  | Utilisateur                                            | Si l'utilisateur est connecté, accéder à la page d'affichage des tickets via son tableau de bord |
| Afficher les 10 derniers tickets sur la page d'accueil | Visiteur                                               | Visualiser les 10 derniers tickets sur la page d'accueil                                         |

## Tableau des differents niveaux

| Niveau 🪁 (Niveau stratégique) ◻️     | Niveau 🌊 (Niveau utilisateur) ◼️ | Niveau 🐟 (Niveau sous-fonction)       |
|---------------------------------------|-----------------------------------|----------------------------------------|
| Gérer un ticket                       | Ouvrir un ticket                  | Se connecter                           |
| Gérer liste libellés                  | Accéder au profil utilisateur     | S’inscrire                             |
| Valider un ticket                     | Changer son email                 | Accéder au tableau de bord             |
| Afficher/gérer l'historique           | Modifier son mot de passe         | Accéder à la page d'accueil            |
| Gérer le niveau d'urgence d'un ticket | Attribuer un technicien           | Accéder à la liste des tickets ouverts |
| Gérer l'état d'un ticket              | Gérer les rôles utilisateurs      | Se déconnecter                         |



## Cas d'utilisation (Voir annexe)

 - Se connecter
 - Se déconnecter
 - Modifier le mot de passe
 - Accéder au profil utilisateur
 - S'inscrire
 - Accéder au tableau de bord
 - Accéder à la liste de tickets
 - Ouvrir un ticket
 - Modifier son email
 - Afficher et gérer l'historique
 - Gérer les tickets
 - Valider un ticket
 - Gérer les libellés
 - Gérer l'état d'un ticket
 - Gérer le niveau d'urgence d'un ticket
 - Gérer les rôles utilisateurs
 - Accéder à la page d'accueil
 - Accéder au profil
 - Attribuer un technicien

## La technologie employée
Les technologies employées pour utiliser ce système sont :

1. Langage de programmation : L'HTML pour la mise en page de l'application web, ainsi que le CSS pour embellir la page.
2. Base de données : MySQL pour stocker et gérer les données de l'application.
3. Serveur web : Apache pour héberger l'application et permettre l'accès via le réseau.
4. Matériel serveur : Pour le moment aucun matériel n'est utilisé.
5. Gestion du projet et du code : Utilisation de GitHub pour héberger la documentation, le code source et les informations du projet.

Ces éléments constituent l'infrastructure de base pour le système que vous envisagez de créer.

Ce système ne sera pas dépendant d’un autre système et fonctionnera en autonomie.

## Autres exigences

### Processus de développement

#### i) Participants au projet
Nous sommes un groupe d’étudiants chargé de développer une application web interne pour l’IUT de Vélizy.

#### ii) Valeurs à privilégier
Le choix de privilégier la simplicité est judicieux, car cela contribuera à rendre l'application web conviviale et efficace pour tous les utilisateurs.

#### iii) Retours et visibilité sur le projet
Les utilisateurs et commanditaires souhaitent un suivi régulier du projet avec des démonstrations et des rapports d'avancement périodiques.

#### iv) Achats, constructions et concurrents
Il est prévu d'acheter le matériel serveur RPi 4. L'application sera construite en interne. Il n'y a pas de concurrents identifiés pour ce projet spécifique.

#### v) Autres exigences du processus
- **Sécurité :** Pour le moment, ce site statique ne déploie aucun protocole de sécurité.
- **Performances :** Nous devons nous assurer que le site statique est dans les critères de beauté du client.
- **Tests et validation :** Effectuer des tests de validation.

#### vi) Dépendances du projet
Le projet est dépendant de l'acquisition du matériel serveur (RPi 4) et de la disponibilité des ressources nécessaires pour le développement et le déploiement. Mais pour ce premier livrable, la seule dépendance requise est de délivrer le site statique sur un OS Linux.

### Performances
Définir les critères de performance pour garantir un fonctionnement efficace de l'application.

### Opérations, sécurité, documentation

#### Opérations
Définir les opérations nécessaires pour assurer le bon fonctionnement de l'application et du serveur.

#### Sécurité
Mettre en place des mesures de sécurité pour protéger les données et les utilisateurs du système.

#### Documentation
Fournir une documentation complète pour l'utilisation du site statique, les maquettes de styles 1 et 2, la documentation des logos et les deux logos du site.

### Utilisation et utilisabilité

#### Utilisation
L'application doit être conviviale et intuitive pour les utilisateurs finaux, avec des fonctionnalités clairement définies.

#### Utilisabilité
Assurer une utilisabilité optimale de l'application en intégrant les retours des utilisateurs et en effectuant des tests d'utilisabilité tout en respectant le W3C.

### Maintenance et portabilité

#### Maintenance
Définir un plan de maintenance pour assurer la pérennité du système et effectuer les mises à jour nécessaires.

## Recours humain, questions juridiques, politiques, organisationnelles

### a) Recours humain au fonctionnement du système
Tout type de personnes peut accéder à ce site statique.

### b) Exigences juridiques et politiques
Privilégier les règles de W3C et d'accessibilité pour livrer ce site statique.

### c) Conséquences humaines de la réalisation du système
Pour le moment, ce système permettra juste au client de visualiser à quoi ressemblera le site au terme du développement.

### d) Besoins en formation
Le fonctionnement de ce système est très simple car nous pourrons juste naviguer dans ce site.

## Annexes

### Cas d'utilisation : Se connecter
- **Nom :** Se connecter
- **Portée :** Site web
- **Niveau :** Sous-fonction
- **Explication :** Ce cas d'utilisation décrit comment les utilisateurs se connectent au site web.
- **Acteur principal :** Utilisateur, Administrateur Web et Système, Technicien
- **Scénario nominal :** L’utilisateur entre son login et son mot de passe
- **Pré-conditions :** L’utilisateur doit être inscrit
- **Extension :**
  - 1.a. L’utilisateur est un enseignant ou un étudiant
    - 1.a.1. L’élève ou l’enseignant peuvent consulter leur tableau de bord et leur profil, ouvrir des tickets, changer leur mot de passe
  - 1.b. L’utilisateur est un technicien
    - 1.b.1. Le technicien consulte les tickets qui lui sont attribués
  - 1.c. L’utilisateur est un administrateur web
    - 1.c.1 L’administrateur gère les techniciens et les tickets
  - 1.d. le client se trompe de login et/ou mot de passe
    - 1.d.1. message d’erreur
- **Post-conditions :** L'utilisateur est connecté

### Cas d'utilisation : Se déconnecter
- **Nom :** Se déconnecter
- **Portée :** Site web
- **Niveau :** Sous-fonction
- **Explication :** Ce cas d'utilisation décrit comment les utilisateurs se déconnectent du site web.
- **Acteur principal :** Utilisateur, Administrateur Web et Système, Technicien
- **Pré-conditions :** L'utilisateur doit être connecté
- **Scénario nominal :** L’utilisateur clique sur le bouton de déconnexion
- **Post-conditions :** L'utilisateur est déconnecté.
- **Extension :**
  - 1.a. L’utilisateur n’est pas connecté
    - 1.a.1. L’utilisateur ne peut pas se déconnecter

### Cas d'utilisation : Modifier le mot de passe
- **Nom :** Modifier le mot de passe
- **Portée :** Site web
- **Niveau :** Utilisateur
- **Explication :** Ce cas d'utilisation décrit comment les utilisateurs modifient leur mot de passe.
- **Acteur principal :** Utilisateur, Administrateur Web et Système, Technicien
- **Pré-conditions :** L'utilisateur doit être connecté
- **Scénario 1 :** C'est un utilisateur
  - L'utilisateur se connecte à son compte
  - L’utilisateur se rend sur son profil
  - L’utilisateur entre son ancien mot de passe, son nouveau mot de passe et le confirme
- **Scénario 2 :** C'est un technicien
  - Le technicien se connecte à son compte
  - Le technicien se rend sur son profil
  - Le technicien entre son ancien mot de passe, son nouveau mot de passe et le confirme
- **Scénario 3 :** C'est un administrateur web
  - L’administrateur web se connecte à son compte
  - L’administrateur web se rend sur son profil
  - L’administrateur web entre son ancien mot de passe, son nouveau mot de passe et le confirme
- **Scénario 4 :** C'est un administrateur système
  - L’administrateur système se connecte à son compte
  - L’administrateur système se rend sur son profil
  - L’administrateur système entre son ancien mot de passe, son nouveau mot de passe et le confirme
  - L'administrateur système peut modifier les mots de passe des autres utilisateurs
- **Post-conditions :** L'utilisateur a modifié son mot de passe.
- **Extension :**
  - 1.a. L’utilisateur n’est pas connecté
    - 1.a.1. L’utilisateur ne peut pas modifier son mot de passe
  - 1.b. L’utilisateur se trompe dans le champ de l’ancien mot de passe
    - 1.b.1. Message d’erreur
  - 1.c. Le nouveau mot de passe et la confirmation du nouveau mot de passe ne sont pas identiques
    - 1.c.1. Message d’erreur

### Cas d'utilisation : Accéder au profil utilisateur
- **Nom :** Accéder au profil utilisateur
- **Portée :** Site web
- **Niveau :** Sous-fonction
- **Explication :** Ce cas d'utilisation décrit comment les utilisateurs accèdent à leur profil.
- **Acteur principal :** Utilisateur, Administrateur Web et Système, Technicien
- **Pré-conditions :** L'utilisateur doit être connecté
- **Scénario 1 :** C'est un utilisateur
  1. L’utilisateur se connecte à son compte
  2. L’utilisateur se rend sur son profil
  3. Il peut modifier son email et son mot de passe
- **Scénario 2 :** C'est un technicien
  1. Le technicien se connecte à son compte
  2. Le technicien se rend sur son profil
  3. Il peut modifier son email et son mot de passe
- **Scénario 3 :** C'est un administrateur web
  1. L’administrateur web se connecte à son compte
  2. L’administrateur web se rend sur son profil
  3. Il peut modifier son email et son mot de passe
- **Scénario 4 :** C'est un administrateur système
  1. L’administrateur système se connecte à son compte
  2. L’administrateur système se rend sur son profil
  3. Il peut modifier son email et son mot de passe
- **Post-conditions :** L'utilisateur accède à son profil.

### Cas d'utilisation : S'inscrire
- **Nom :** S'inscrire
- **Portée :** Site web
- **Niveau :** Sous-fonction
- **Explication :** Ce cas d'utilisation décrit comment les utilisateurs s'inscrivent au site web.
- **Acteur principal :** Visiteur
- **Pré-conditions :** L'utilisateur doit être déconnecté
- **Scénario nominal :** L’utilisateur entre son email, son login, son mot de passe, le confirme et complète le captcha puis clique sur le bouton d’inscription.
- **Post-conditions :** L'utilisateur est inscrit.
- **Extension :**
  - 1.a. Le login existe déja
    - 1.a.1. Message d’erreur
  - 1.b. Le mot de passe et la confirmation du mot de passe ne sont pas identiques
    - 1.b.1. Message d’erreur
  - 1.c. L’utilisateur ne complète pas le captcha ou se trompe dans le captcha
    - 1.c.1. Message d’erreur
  - 1.d. L’utilisateur est déjà connecté
    - 1.d.1. L’utilisateur ne peut pas s’inscrire

### Cas d'utilisation : Accéder au tableau de bord
- **Nom :** Accéder au tableau de bord
- **Portée :** Site web
- **Niveau :** Sous-fonction
- **Explication :** Ce cas d'utilisation décrit comment les utilisateurs accèdent au tableau de bord.
- **Acteur principal :** Utilisateur, Administrateur Web et Système, Technicien
- **Pré-conditions :** L'utilisateur doit être connecté
- **Scénario 1 :** C'est un utilisateur
  1. L’utilisateur se connecte à son compte
  2. L’utilisateur accède à son tableau de bord
  3. L’utilisateur peut ouvrir un ticket
  4. L’utilisateur peut accéder à son profil
  5. L'utilisateur peut accéder à la page d'affichage des tickets
  6. L'utilisateur peut se déconnecter
- **Scénario 2 :** C'est un technicien
  1. Le technicien se connecte à son compte
  2. Le technicien accède à son tableau de bord
  3. Le technicien peut accéder à son profil
  4. Le technicien peut voir les tickets qui lui sont attribués
  5. Le technicien peut se déconnecter
- **Scénario 3 :** C'est un administrateur web
  1. L’administrateur web se connecte à son compte
  2. L’administrateur web accède à son tableau de bord
  3. L’administrateur web peut accéder à son profil
  4. L’administrateur web peut gérer les techniciens
  5. L’administrateur web peut gérer les tickets
  6. L'administrateur web accède à l'historique des tickets
  7. L’administrateur web peut se déconnecter
- **Scénario 4 :** C'est un administrateur système
  1. L’administrateur système se connecte à son compte
  2. L’administrateur système accède à son tableau de bord
  3. L’administrateur système peut accéder à son profil
  4. L’administrateur système peut accéder aux logs
  5. L’administrateur système peut se déconnecter
- **Post-conditions :** L'utilisateur accède au tableau de bord.
- **Extension :**
  - 1.a. Le visiteur n’est pas connecté
    - 1.a.1. Le visiteur est redirigé vers la page d'accueil

### Cas d'utilisation : Accéder à la liste de tickets
- **Nom :** Accéder à la liste de tickets
- **Portée :** Site web
- **Niveau :** Sous-fonction
- **Explication :** Ce cas d'utilisation décrit comment les utilisateurs accèdent à la liste de tickets.
- **Acteur principal :** Utilisateur, Technicien
- **Pré-conditions :** L'utilisateur doit être connecté
- **Scénario 1 :** C'est un utilisateur
  1. L’utilisateur se connecte à son compte
  2. L’utilisateur accède à son tableau de bord
  3. L’utilisateur peut accéder à la liste de tickets
  4. L’utilisateur peut ouvrir un ticket
  5. L’utilisateur voit les tickets qu'il a créés
  6. L'utilisateur peut se déconnecter
- **Scénario 2 :** C'est un technicien
  1. Le technicien se connecte à son compte
  2. Le technicien accède à son tableau de bord
  3. Le technicien peut accéder à la liste de tickets
  4. Le technicien peut accéder à son profil
  5. Le technicien peut voir les tickets qui lui sont attribués
  6. Le technicien peut se déconnecter


### Cas d'utilisation : Ouvrir un ticket
- **Nom :** Ouvrir un ticket
- **Portée :** Site web
- **Niveau :** Utilisateur
- **Explication :** Ce cas d'utilisation décrit comment les utilisateurs ouvrent un ticket.
- **Acteur principal :** Utilisateur
- **Pré-conditions :** L'utilisateur doit être connecté
- **Scénario nominal :** L’utilisateur clique sur le bouton d’ouverture de ticket, entre le titre du ticket, la description du ticket, le niveau d’urgence du ticket, le type de ticket et clique sur le bouton de création de ticket
- **Post-conditions :** L'utilisateur a ouvert un ticket.
- **Extension :**
  - 1.a. L’utilisateur n’est pas connecté
    - 1.a.1. L’utilisateur ne peut pas ouvrir un ticket
  - 1.b. L’utilisateur ne remplit pas tous les champs
    - 1.b.1. Message d’erreur

### Cas d'utilisation : Modifier son email
- **Nom :** Modifier son email
- **Portée :** Site web
- **Niveau :** Utilisateur
- **Explication :** Ce cas d'utilisation décrit comment les utilisateurs modifient leur email.
- **Acteur principal :** Utilisateur, Administrateur Web et Système, Technicien
- **Pré-conditions :** L'utilisateur doit être connecté
- **Scénario 1 :** C'est un utilisateur
  - L'utilisateur se connecte à son compte
  - L’utilisateur se rend sur son profil
  - L’utilisateur entre son nouvel email et le confirme
- **Scénario 2 :** C'est un technicien
  - Le technicien se connecte à son compte
  - Le technicien se rend sur son profil
  - Le technicien entre son nouvel email et le confirme
- **Scénario 3 :** C'est un administrateur web
  - L’administrateur web se connecte à son compte
  - L’administrateur web se rend sur son profil
  - L’administrateur web entre son nouvel email et le confirme
- **Scénario 4 :** C'est un administrateur système
  - L’administrateur système se connecte à son compte
  - L’administrateur système se rend sur son profil
  - L’administrateur système entre son nouvel email et le confirme
  - L'administrateur système peut modifier les emails des autres utilisateurs
- **Post-conditions :** L'utilisateur a modifié son email.
- **Extension :**
  - 1.a. L’utilisateur n’est pas connecté
    - 1.a.1. L’utilisateur ne peut pas modifier son email
  - 1.b. Le nouvel email et la confirmation du nouvel email ne sont pas identiques
    - 1.b.1. Message d’erreur

### Cas d'utilisation : Afficher et gérer l'historique
- **Nom :** Afficher et gérer l'historique
- **Portée :** Site web
- **Niveau :** Stratégique
- **Explication :** Ce cas d'utilisation décrit comment l'administrateur web affiche et gère l'historique.
- **Acteur principal :** Administrateur Web
- **Pré-conditions :** L'utilisateur doit être connecté
- **Scénario nominal :** C'est un administrateur web
  - L’administrateur web se connecte à son compte
  - L’administrateur web accède à son tableau de bord
  - L’administrateur web accède à l'historique des tickets
  - L’administrateur web peut voir les tickets
  - L’administrateur web peut voir les tickets qui sont en attente de validation
  - L’administrateur web peut voir les tickets qui sont en attente de traitement
  - L’administrateur web peut voir les tickets qui sont en cours de traitement
  - L’administrateur web peut voir les tickets qui sont en attente de clôture
  - L’administrateur web peut voir les tickets qui sont fermés
- **Post-conditions :** L'utilisateur a affiché et géré l'historique.

### Cas d'utilisation : Gérer les tickets
- **Nom :** Gérer les tickets
- **Portée :** Site web
- **Niveau :** Stratégique
- **Explication :** Ce cas d'utilisation décrit comment l'administrateur web gère les tickets.
- **Acteur principal :** Administrateur Web
- **Pré-conditions :** L'utilisateur doit être connecté
- **Scénario nominal :** C'est un administrateur web
  - L’administrateur web se connecte à son compte
  - L’administrateur web accède à son tableau de bord
  - L’administrateur web peut gérer les tickets
  - L’administrateur web peut valider un ticket
  - L’administrateur web peut modifier un ticket
  - L’administrateur web peut supprimer un ticket
  - L’administrateur web peut attribuer un ticket à un technicien
  - L’administrateur web peut changer le niveau d'urgence d'un ticket
  - L’administrateur web peut changer le libéllé d'un ticket
  - L’administrateur web peut changer l'état d'un ticket
- **Post-conditions :** L'utilisateur a géré les tickets.

### Cas d'utilisation : Valider un ticket
- **Nom :** Valider un ticket
- **Portée :** Site web
- **Niveau :** Stratégique
- **Explication :** Ce cas d'utilisation décrit comment l'administrateur web valide un ticket.
- **Acteur principal :** Administrateur Web
- **Pré-conditions :** L'utilisateur doit être connecté
- **Scénario nominal :** C'est un administrateur web
  - L’administrateur web se connecte à son compte
  - L’administrateur web accède à son tableau de bord
  - L’administrateur web peut valider un ticket
- **Post-conditions :** L'utilisateur a validé un ticket.

### Cas d'utilisation : Gérer les libellés
- **Nom :** Gérer les libellés
- **Portée :** Site web
- **Niveau :** Stratégique
- **Explication :** Ce cas d'utilisation décrit comment l'administrateur web gère les libellés.
- **Acteur principal :** Administrateur Web
- **Pré-conditions :** L'utilisateur doit être connecté
- **Scénario nominal :** C'est un administrateur web
  - L’administrateur web se connecte à son compte
  - L’administrateur web accède à son tableau de bord
  - L’administrateur web peut gérer les libellés
  - L’administrateur web peut ajouter un libellé
  - L’administrateur web peut modifier un libellé
  - L’administrateur web peut supprimer un libellé
- **Post-conditions :** L'utilisateur a géré les libellés.

### Cas d'utilisation : Gérer l'état d'un ticket
- **Nom :** Gérer l'état d'un ticket
- **Portée :** Site web
- **Niveau :** Stratégique
- **Explication :** Ce cas d'utilisation décrit comment l'administrateur web gère l'état d'un ticket.
- **Acteur principal :** Administrateur Web
- **Pré-conditions :** L'utilisateur doit être connecté
- **Scénario nominal :** C'est un administrateur web
  - L’administrateur web se connecte à son compte
  - L’administrateur web accède à son tableau de bord
  - L’administrateur web peut changer l'état d'un ticket
- **Post-conditions :** L'utilisateur a géré l'état d'un ticket.

### Cas d'utilisation : Gérer le niveau d'urgence d'un ticket
- **Nom :** Gérer le niveau d'urgence d'un ticket
- **Portée :** Site web
- **Niveau :** Stratégique
- **Explication :** Ce cas d'utilisation décrit comment l'administrateur web gère le niveau d'urgence d'un ticket.
- **Acteur principal :** Administrateur Web
- **Pré-conditions :** L'utilisateur doit être connecté
- **Scénario nominal :** C'est un administrateur web
  - L’administrateur web se connecte à son compte
  - L’administrateur web accède à son tableau de bord
  - L’administrateur web peut changer le niveau d'urgence d'un ticket
- **Post-conditions :** L'utilisateur a géré le niveau d'urgence d'un ticket.

### Cas d'utilisation : Gérer les rôles utilisateurs
- **Nom :** Gérer les rôles utilisateurs
- **Portée :** Site web
- **Niveau :** Stratégique
- **Explication :** Ce cas d'utilisation décrit comment l'administrateur web gère les rôles utilisateurs.
- **Acteur principal :** Administrateur Web
- **Pré-conditions :** L'utilisateur doit être connecté
- **Scénario nominal :** C'est un administrateur web
  - L’administrateur web se connecte à son compte
  - L’administrateur web accède à son tableau de bord
  - L’administrateur web peut gérer les rôles utilisateurs
- **Post-conditions :** L'utilisateur a géré les rôles utilisateurs.
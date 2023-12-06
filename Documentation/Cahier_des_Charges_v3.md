# Cahier des charges 3.0

## Introduction

Dans le cadre de notre projet SAE, nous avons opté pour une approche agile, afin de répondre de manière flexible et efficiente aux besoins de notre client. Le présent document, marque la troisième itération de notre SAE 3.01. Dans cette nouvelle version, nous allons finaliser les ajouts faits dans la version précédente.

## Troisième version du projet

Dans cette nouvelle itération, nous nous sommes résolus à intégrer le support intégral de la gestion de tickets ainsi qu'un système de gestion des roles utilisateurs. Nous devons aussi ajouter un système de Captcha lors de la création de nouveaux compte afin de rendre le site plus sécurisé. De plus grace au projet de cryptographie à réaliser en parallèle, nous allons pouvoir sécuriser notre application web en proposant un système de chiffrement alternatif au MD5 qui est utilisé pour l'instant pour les mots de passes de notre application.

### Une application web plus sécurisée

Lors de la précédente version, nous avons mis en place un systeme de login et de logout ainsi que la possibilité aux utilisateurs de changer leurs mots de passe. Cependant, hormis le fait que notre site protege de la fraude en redirigeant les utilisateurs non connectés vers la page d'index et la protection pour toute tentative d'injection SQL, notre site n'est pas encore assez sécurisé. En effet, il est possible pour un utilisateur malveillant de créer un compte et de se connecter à notre site. Pour palier à ce problème, nous allons mettre en place un système de Captcha lors de la création de nouveaux comptes. Nous allons intégrer un nouveau système de chiffrement "fait maison" qui sera plus sécurisé que le MD5 utilisé actuellement.

#### Un système de Captcha lors de la création de compte :
Nous avons réfléchi à mettre en place un simple système de Captcha. En effet, son fonctionnement se fait grace à une simple addition de deux nombres aléatoires. L'utilisateur devra donc rentrer le résultat de cette addition pour pouvoir créer son compte. Ce système est simple à mettre en place et permet de protéger notre site contre les robots.

#### Un nouveau système de chiffrement des mots de passes :
Nous avons décidé de mettre en place un nouveau système de chiffrement des mots de passes. En effet, nous avons décidé de mettre en place un système de chiffrement "fait maison" qui sera plus sécurisé que le MD5. En effet, le MD5 est une fonction de hachage qui est vulnérable aux attaques par dictionnaire. Notre système de chiffrement sera donc plus sécurisé que le MD5. De plus, nous allons mettre en place un système de salage des mots de passes. En effet, le salage est une technique qui consiste à ajouter une chaîne de caractères aléatoire au mot de passe avant de le hacher. Cette technique permet de rendre les attaques par dictionnaire plus difficiles.

### Un système de gestion des tickets

La version 3 de notre application web va mettre en place un système de gestion de tickets. En effet, notre client nous a demandé de mettre en place un système de gestion de tickets. Ce système permettra aux utilisateurs de créer des tickets et de les gérer. De plus, les administrateurs pourront valider les tickets et les techniciens pourront les traiter.

#### Une base de données pour stocker les tickets :
Nous avons décidé de créer une nouvelle table dans notre base de données. Cette table contiendra les informations relatives aux tickets.

#### Une page pour créer des tickets :
Lors de la version 2, l'une des deux dernières pages manquantes était celle de la creation de tickets. Nous avons donc décidé de mettre en place une page pour créer des tickets. En effet, cette page permettra aux utilisateurs de créer des tickets. Cette page contiendra un formulaire qui permettra aux utilisateurs de créer des tickets. Ce formulaire contiendra un champ pour le titre du ticket, un champ pour la description du ticket, un champ pour le niveau d'urgence du ticket et un champ pour le type de ticket. De plus, cette page contiendra un bouton pour créer le ticket.

#### Une page pour afficher les tickets :
La dernière page manquante de la version 2 était celle de l'affichage des tickets. Nous avons donc décidé de mettre en place une page pour afficher les tickets. En effet, cette page permettra aux utilisateurs de voir les tickets qu'ils ont créés. Cette page contiendra un tableau qui affichera les tickets. Ce tableau contiendra les informations suivantes : le titre du ticket, la description du ticket, le niveau d'urgence du ticket, le type de ticket, l'état du ticket et la date de création du ticket. De plus, cette page contiendra un bouton pour modifier le ticket et un bouton pour supprimer le ticket.

### Un système de gestion des roles utilisateurs

Notre nouvelle version va mettre en place un système de gestion des roles utilisateurs. En effet, notre client nous a demandé de mettre en place un système de gestion des roles utilisateurs. Ce système permettra a l'administrateur web de gérer les roles des utilisateurs ainsi que d'assigner des tickets d'utilisateurs a des techniciens et de gérer l'état des tickets. De plus, l'administrateur système pourra acceder à la page des logs qui contiendra les logs de connection de l'application web.

#### Une base de données pour stocker les roles utilisateurs :

Nous avons décidé de modifier la table temporaire que nous utilisions temporairement pour la version 2. En effet, celle-ci ne proposait que 3 champs pour la gestion d'utilisateurs

- Un champ pour le login limité à 8 caractères
- Un champ pour le mot de passe hashé en MD5 possible de changer dans la page de profil
- Un champ pour l'email de l'utilisateur possible de changer dans la page de profil

Cette table ne permettait pas de gérer les roles utilisateurs. Nous avons donc décidé de modifier cette table pour qu'elle puisse gérer les roles utilisateurs. Cette table contiendra les informations suivantes : le login de l'utilisateur, le mot de passe hashé en MD5 de l'utilisateur, l'email de l'utilisateur, le role de l'utilisateur et la date de création de l'utilisateur.

#### Un tableau de bord variable selon le role de l'utilisateur :

Lors de la version 2 de l'application web, nous avons mis en place un tableau de bord pour l'utilisateur quand il est connecté. Cependant, ce tableau de bord est le même pour tous les utilisateurs. Nous avons donc décidé de mettre en place un tableau de bord variable selon le role de l'utilisateur. En effet, le tableau de bord sera différent selon le role de l'utilisateur. De plus, nous allons mettre en place un système de gestion des roles utilisateurs. En effet, l'administrateur web pourra gérer les roles des utilisateurs. De plus, l'administrateur web pourra assigner des tickets d'utilisateurs a des techniciens et gérer l'état des tickets. De plus, l'administrateur système pourra acceder à la page des logs qui contiendra les logs de connection de l'application web.

### Début des ajouts des cas d'utilisations

En effet, maintenant que l'application web est fonctionnelle, nous allons pouvoir commencer à ajouter les cas d'utilisations. Nous allons donc commencer par ajouter les cas d'utilisations suivants :

- Gérer les tickets
- Ouvrir un ticket
- Accéder au tableau de bord
- Valider un ticket
- Ajouter un technicien
- Gérer le niveau d'urgence
- Accéder aux libellés
- Stocker les tickets fermés
- Gérer les roles utilisateurs
- Assigner des tickets d'utilisateurs a des techniciens
- Gérer l'état des tickets
- Créer un compte
- Se connecter
- Se déconnecter
- Modifier le mot de passe
- Accéder au profil utilisateur

## Planning

- Semaine du 16 octobre : Rendu des Maquettes 1 et 2 avec les deux logos ainsi que le site statique  avec le Cas d'utilisation "Navigation du Site"
- Semaine du 20 novembre : Rendu du Site avec la carte SD.
- Les Semaines du 20 Novembre au 16 Décembre: Ajout des Cas d'Utilisation "connections", "Déconnections", "Modification du mot de passe", "Accéder le profil utilisateur", "l'inscription" des 4 types d'utilisateurs et les droits d'utilisateurs, "Gérer les Tickets", "Ouvrir Ticket", "Accès au tableau au bord", "Valider un ticket" et "Ajouter un techniciens"
- Les Semaines du 16 Décembre au 23 Décembre : Ajout des Cas d'Utilisation "Gérer le niveau d'urgence" "Accès aux libellés", "Enregistrer les journal d'activités "Stocker les Tickets fermer" ainsi que la sécurisation de L'Application Web (Encore à discuter avec le client)

Ce planning est susceptible de changer au cours des discussions avec le client.

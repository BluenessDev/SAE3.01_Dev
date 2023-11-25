# Cahier des charges 2.0

## Introduction

Dans le cadre de notre projet SAE, nous avons opté pour une approche agile, afin de répondre de manière flexible et efficiente aux besoins de notre client. Le présent document, marque la deuxième itération de notre SAE 3.01. Dans cette nouvelle versions nous allons ajouter plusieurs fonctionnalité qui rendrons ce site dynamique

## Deuxième version du projet

Dans cette nouvelle itération, nous sommes résolus à faire évoluer notre projet vers une forme dynamique. Notre objectif est d'enrichir le site en ajoutant plusieurs fonctionnalités qui le rendront plus interactif et réactif.

### Site dynamique

Nous avons choisi de stocker ce site dans un serveur apache qui sera stocké sur un raspberry Pi 4. Le client choisira l'une des deux maquette du site données de la précédente version. Après avoir installé le site dans le rasberry PI, nous ajouterons plusieurs fonctionnalités, telles que l'inscription/connexion de l'utilisateur et une page de log pour suivre les connexions dans le site. Toutes ces données seront stockées dans une base de donnée MySQL

**Configuration du Serveur Apache et du Raspberry Pi 4:**
Nous allons Installer dans le Raspberry Pi une pile Lamp, Linux Apache MySQL PHP, nous avons installé une version de Debian 12 sans interface graphique car c'est optimisé et que notre raspberry a juste 1 go ram. Nous avons installé les dernières versions de Apache et MySQL ainsi que la version 8 de PHP

**Maquettes :**
Durant la première version nous avons proposé 2 maquettes selon les codes des 2 logos déposés. et nous avons déposé 2 états du site l'un avec un utilisateur connecté et l'autre lorsqu'il n'y a pas d'utilisateur connecté. Pour la continuitée de notre projet nous allons choisir la maquette numéro 1.

**Inscription/Connexion de l'Utilisateur :**
Spécifiez les exigences de l'inscription et de la connexion des utilisateurs, y compris les champs requis (nom, adresse e-mail, mot de passe, etc.), les règles de validation, les fonctionnalités de récupération de mot de passe, et les messages d'erreur standard.

**Page de Journalisation (Log) :**
Il y aura pour le momenbt qu'une seule page de log, elle stockera, les informations de connections infructueuses, avec l'identifiant donné, l'adresse IP de la machine,la date et le mot de passe tenté

**Base de Données MySQL :**
Nous allons créer une base de donnée qui pour le moment ne contiendra qu'une seule table des Utilisateurs, avec comme une clé primaire id, un identifiant et un mot de passe hashé en md5, par la suite nous implanteront et modifieront si nécéssaire notre base de donnée pour qu'elle soit en accord avec les cas d'utilisations futures.

**Sécurité :**
Nous allons bloquer les accès au niveau URL, c'est-à-dire d'essayer d'acceder à certaine page en modifiant l'url. Nous allons aussi bloquer les injections SQL.

**Tests et Validation :**
Des Test unitaires seront effectué au niveau du code PHP ainsi que des test d'acceptations au niveau du site.

**Ressources Requises :**
Pour cette version nous aurons besoins de compétence en:

* UML
* PHP
* MySQL

### Planning

- Semaine du 16 octobre : Rendu des Maquettes 1 et 2 avec les deux logos ainsi que le site statique  avec le Cas d'utilisation "Navigation du Site"
- Semaine du 26 novembre : Rendu du Site avec la carte SD avec les Cas d'utilisations  "connections", "Déconnections", "Modification du mot de passe", "Accéder le profil utilisateur" ainsi que "l'inscription" des 4 types d'utilisateurs et les droits d'utilisateurs
- Les Semaines du 27 Novembre au 10 Décembre: Ajout des Cas d'Utilisation "Gérer les Tickets", "Ouvrir Ticket", "Accès au tableau au bord", "Valider un ticket" et "Ajouter un techniciens"
- Les Semaines du  10 Décembre au 17 Décembre : Ajout des Cas d'Utilisation "Gérer le niveau d'urgence" "Accès aux libellés", "Enregistrer les journal d'activités "Stocker les Tickets fermer" ainsi que la sécurisation de L'Application Web (Encore à discuter avec le client)

Ce planning est susceptible de changer au cours des discussions avec le client.

# Cahier des charges 3.1

## Introduction

Dans le cadre de notre projet SAE, nous avons opté pour une approche agile, afin de répondre de manière flexible et efficiente aux besoins de notre client. Le présent document, marque la quatrième itération de notre SAE 3.01. Dans cette nouvelle version, nous allons finaliser les ajouts faits dans la version précédente.

## Troisième version du projet

Dans cette nouvelle itération, nous nous sommes résolus à intégrer l'integration de la page des logs ainsi que la sécurisation de l'application web. Nous devons aussi ajouter une page fictive de reinitalisation de mot de passe.

## Une sécurité renforcée

Dans cette nouvelle version, nous allons finaliser la protection du site en mettant en place des protection aux injections XSS et SQL. Nous avons aussi mis en place le service Fail2Ban sur notre serveur afin de bloquer les attaques par force brute.

## Une page de logs

Dans cette nouvelle version, nous avons mis en place une page de logs qui permet de voir les logs de l'application web. Cette page est accessible uniquement par l'administrateurs système.

## Une page de réinitialisation de mot de passe

Dans cette nouvelle version, nous avons mis en place une page de réinitialisation de mot de passe en construction qui permet de réinitialiser le mot de passe d'un utilisateur.

## Les Cas d'Utilisation

Ajout de nouveaux Cas d'Utilisation :
- Accéder à la page des logs
- Réinitialiser le mot de passe

## Planning

- **V1** : Semaine du 16 octobre : Rendu des Maquettes 1 et 2 avec les deux logos ainsi que le site statique  avec le Cas d'utilisation "Navigation du Site"
- **V2** : Semaine du 20 novembre : Rendu du Site avec la carte SD.
- **V3** : Les Semaines du 20 Novembre au 16 Décembre: Ajout des Cas d'Utilisation "connections", "Déconnections", "Modification du mot de passe", "Accéder le profil utilisateur", "l'inscription" des 4 types d'utilisateurs et les droits d'utilisateurs, "Gérer les Tickets", "Ouvrir Ticket", "Accès au tableau au bord", "Valider un ticket" et "Ajouter un techniciens"
- **V3.1** : Les Semaines du 16 Décembre au 20 Janvier : Ajout des Cas d'Utilisation "Gérer le niveau d'urgence" "Accès aux libellés", "Enregistrer les journal d'activités "Stocker les Tickets fermés" ainsi que la sécurisation de L'Application Web

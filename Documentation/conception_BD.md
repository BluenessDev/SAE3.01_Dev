# Conception de la Base de Données pour la Gestion de Tickets

## Introduction

La base de données vise à gérer les utilisateurs et les tickets dans le contexte d'une application de support. Les entités principales sont "Users" (utilisateurs inscrits) et "Tickets" (tickets).

## Tables et Relations

### Schéma

![Schéma représentant la BDD](https://cdn.discordapp.com/attachments/1172662570369433670/1172662595879190609/image.png?ex=65612225&is=654ead25&hm=7828d3c18f14c7dce5e7d91f433dbcd89f96af0371649d618985a8abc84d05b7& "Schéma de la BDD")

Sur le schéma ci-dessus, on peut voir deux tables qui vont être détaillées ci-dessous.

### Table "Users"

- **Users**
  - *<u>login</u>* (Clé primaire et Identifiant de l'utilisateur)
  - *email* (Adresse e-mail de l'utilisateur)
  - *password* (Mot de passe de l'utilisateur, stocké en MD5 pour plus de sécurité)

### Table "Tickets"

- **Tickets**
  - *libellé* (libellé du ticket)
  - *description* (Description détaillée du problème ou de la demande)
  - *statut* (Statut actuel du ticket, par exemple : ouvert, en cours, résolu)
  - *urgence* (Le niveau d'urgence du ticket)
  - *date* (Date à laquelle le ticket a été créé)
  - *#loginU* (Clé étrangère liée à la table Users, indiquant l'utilisateur qui a créé ce ticket)
  - *#loginT* (Clé étrangère liée à la table Users, indiquant le technicien qui prend en charge ce ticket)

### Relations

- La table "Tickets" a une clé étrangère (*loginU*) qui référence la clé primaire de la table "Users". Cela établit une relation entre les deux tables, indiquant quel utilisateur a créé quel ticket.

- La table "Tickets" a une clé étrangère (*loginT*) qui référence la clé primaire de la table "Users". Cela établit une relation entre les deux tables, indiquant quel technicien s'occupe de quel ticket.

## Conclusion

Cette conception est une bonne base pour l'évolution du projet, car elle nous permet déjà d'inscrire des utilisateurs, elle nous permet aussi de commencer la gestion de tickets grâce à la possibilité de créer et de les attribuer à un technicien

*Les tables présentées dans cette première conception sont susceptibles de changer en fonction de l'évolution du projet et des différentes discutions avec le client.*
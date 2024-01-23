# Conception de la Base de Données pour la Gestion de Tickets

## Introduction

La base de données vise à gérer les utilisateurs et les tickets dans le contexte d'une application de support. Les entités principales sont "Users" (utilisateurs inscrits) et "Tickets" (tickets).

## Tables et Relations

### Schéma

![Schéma représentant la BDD](https://cdn.discordapp.com/attachments/688468048985849886/1199297074735353896/image.png?ex=65c20770&is=65af9270&hm=7a959ed0cfa91e48866f559d1e159050c5274c38976069addeee29dd74006655& "Schéma de la BDD")

Sur le schéma ci-dessus, on peut voir deux tables qui vont être détaillées ci-dessous.

### Table "Users"

- **Users**
  - *<u>login</u>* (Clé primaire et Identifiant de l'utilisateur)
  - *email* (Adresse e-mail de l'utilisateur)
  - *password* (Mot de passe de l'utilisateur, chiffré en RC4 pour plus de sécurité)
  - *role* (permet de detecter le role de l'utilisateur pour donner les bonnes permissions aux utilisateurs)

### Table "Tickets"

- **Tickets**
  - *id* (Clé primaire, identifiant numéro du ticket ajouté dans la base de donnée)
  - *nature* (nature du ticket, qui sont des types de problèmes récupéré via un menu déroulant)
  - *niveau* (niveau d'urgence du ticket)
  - *salle* (la salle dans laquelle le problème est apparu)
  - *demandeur* (le personne qui fait la demande pour le ticket)
  - *concerne* (la personne concerné du problème créer)
  - *description* (la description du problème)
  - *etat* (etat actuel du ticket, par exemple : ouvert, en cours, résolu)
  - *#login* (Clé étrangère liée à la table Users, indiquant l'utilisateur qui a créé ce ticket)
  - *date* (Date à laquelle le ticket a été créé)
  - *#technicien_login* (Clé étrangère liée à la table Users, indiquant le technicien qui prend en charge ce ticket)

### Relations

- La table "Tickets" a une clé étrangère (*login*) qui référence la clé primaire de la table "Users". Cela établit une relation entre les deux tables, indiquant quel utilisateur a créé quel ticket.

- La table "Tickets" a une clé étrangère (*technicien_login*) qui référence la clé primaire de la table "Users". Cela établit une relation entre les deux tables, indiquant quel technicien s'occupe de quel ticket.

## Conclusion

Cette conception est une bonne base pour l'évolution du projet, car elle nous permet déjà d'inscrire des utilisateurs, elle nous permet aussi de commencer la gestion de tickets grâce à la possibilité de créer et de les attribuer à un technicien

*Les tables présentées dans cette première conception sont susceptibles de changer en fonction de l'évolution du projet et des différentes discutions avec le client.*

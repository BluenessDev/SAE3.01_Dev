# Conception Architecturale

## Introduction

Le modèle architectural est la suite du modèle de conception détaillée.
Ce projet consiste à développer une Application Web de Ticketing. Cette derniere version montrere presente le site web dans sa version finale avec l'ajout des tickets,de la gestion des utilisateurs, et de la gestion des logs.

## Conception Architecturale

Dans le dossier de conception détaillé, nous avons créé un package de composants `<Site>` qui représente tout le site web, dans ce composant, nous retrouvons un composant `<index>` qui regroupe deux composants index qui représente deux états de l'index différents, l'un avec l'état de connexion et l'autre lorsque personne n'est connecté. Selon l'état d'index, il y a une dépendance spécifique selon l'état. Nous avons les composants `<Logs>` qui repertorie les logs par jour du site et `<Profil>` pour l'état de connexion et `<Form_inscr>` et `<Form_connected>` et ces composants sont tous dépendants du Composant `<style>` qui représente la charte graphique du site. Les composants `<action>` et `<creation>` sont fusionnés désormais a `<form_inscription>` et `<form_connexion>`. Mais aussi `<logout>` pour la déconnexion. De plus, nous avons créé un package de composants `<Base de donnee>` représentant la base de donnée utilisé pour l'application ainsi que les tables `<users>` et `<tickets>`. Les composant `<create_ticket>` et `<tickets_informations>` sont des composants qui permettent de créer un ticket et de voir les informations d'un ticket et pour l'administrateur web de l'attribuer a un technicien donné. Le composant `<attribuer_role>` permet a l'administrateur web d'attribuer un role a un utilisateur donné.

Nous avons donc créer deux Nœuds qui regroupe tous ces composants Clients et qui est regroupé dans un package nommé `<Machine_connecté au reseau de l'IUT>` dans ce package, nous avons un composant `<Navigateur>` qui depends de toute les composantes du site web. Nous pouvons par ailleurs faire un deuxième nœud `<Rasb04(Serveur local)>` contenant le package `<Base de donnée>`, le package `<Services>` qui contient la composante Apache2 et l'interface phpmyadmin. Nous avons enfin le package `<Site>` qui contient les composantes relatives a l'application web.

## Annexe

1. Diagramme de conception architecturale
<img src='https://cdn.discordapp.com/attachments/1148278381767569508/1196880940841054258/ArchitectureVFinale.jpg?ex=65b93d3d&is=65a6c83d&hm=40b987a44a4515c3f1d2884270ee5e2ce1e881abcfce1086b23fcfadf414c1fd&' alt='Image de la conception architecturale'>
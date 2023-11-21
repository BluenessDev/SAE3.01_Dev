# Conception Architecturale 

## Introduction

Le modèle architectural est la suite du modèle de conception détaillée.
Ce projet consiste à développer une Application Web de Ticketing. Cette deuxième version de cette application web présente un site web dynamique qui permet à un utilisateur de se connecter ou de s'inscrire. De plus, cette version montrera les prochaines fonctionnalités qui seront implantées dans l'application web.

## Conception Architecturale  

Dans le dossier de conception détaillé, nous avons créé un composant `<Site Statique>` qui représente tout le site web, dans ce composant, nous retrouvons un composant `<index>` qui regroupe deux composants index qui représente deux états de l'index différents, l'un avec l'état de connexion et l'autre lorsque personne n'est connecté. Selon l'état d'index, il y a une dépendance spécifique selon l'état. Nous avons les composants `<Logs>` et `<Profil>` pour l'état de connexion et `<Form_inscr>` et `<Form_connected>` et ces composants sont tous dépendants du Composant `<style>` qui représente la charte graphique du site. Nous avons également créé les composants `<action>` et `<creation>` qui permettent la connexion, pour le premier, et l'inscription pour le deuxième. Mais aussi `<logout>` pour la déconnexion. De plus, nous avons créé un composant `<Base de donnee>` représentant la base de donnée utilisé pour l'application. Dans ce composant, nous retrouvons le composant `<users>` représentant la table contenants les utilisateurs inscrits, et `<tickets>` qui est la table qui contiendra les tickets qui ont été créés.

Nous pouvons donc créer un Nœud qui regroupe tous ces composants Clients et qui est regroupé dans un package nommé `<Client>` dans ce package, nous avons un composant `<Vue>` dans lequel nous retrouvons le Site Statique. Nous pouvons par ailleurs faire un deuxième nœud `<base de donnée>` contenant les différentes tables.

<img src='[https://cdn.discordapp.com/attachments/1148278381767569508/1176474793810329600/Diagramme_concep_archi_v2.jpg?ex=656f0088&is=655c8b88&hm=706d626c1d68e1d0e14d0828b8bd59da32635b05fc0cd154c238dc1c6da8711d&](https://cdn.discordapp.com/attachments/1148278381767569508/1176474793810329600/Diagramme_concep_archi_v2.jpg?ex=656f0088&is=655c8b88&hm=706d626c1d68e1d0e14d0828b8bd59da32635b05fc0cd154c238dc1c6da8711d&)https://cdn.discordapp.com/attachments/1148278381767569508/1176474793810329600/Diagramme_concep_archi_v2.jpg?ex=656f0088&is=655c8b88&hm=706d626c1d68e1d0e14d0828b8bd59da32635b05fc0cd154c238dc1c6da8711d&'>

Pour le moment, n'hébergeons pas notre application web sur un serveur externe.

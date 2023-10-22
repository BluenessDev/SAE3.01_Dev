# Conception Architecturale 

## Introduction

Le modèle architecturale est la suite du modèle de conception détaillée
Ce projet consiste a développer une Application Web de Ticketing. Cette première version de cette application web présente un site web statique qui montrera les prochaines fonctionnalitées qui seront implanté dans l'application web.

## Conception Architecturale  

Dans le dossier de conception détaillé nous avons créé un composant `<Site Statique>` qui représente tout le site web, dans ce composant nous retrouvons un composant `<index>` qui regoupe deux composants index qui représente deux états de l'index différents l'un avec l'état de connection et l'autre lorsque personne n'est connceté. Selon l'état d'index il y a une dépendance spécifique selon l'état, Nous avons les composants `<Logs>` et `<Profil>` pour l'état de connection et `<Form_inscr>` et `<Form_connected>` et ces composants sont tous dépendant du Composant `<style>` qui représente la charte graphique du site.

Nous pouvons donc créer un Noeud qui regroupe tous ces composants Clients et qui est regroupé dans un package nommé `<Client>` dans ce package nous avons un composant `<Vue>` dans lequel nous retrouvons le Site Statique

<img src='https://cdn.discordapp.com/attachments/1148278381767569508/1165665675667320913/Architecture_Conception_V1.jpg?ex=6547adc2&is=653538c2&hm=ecd4f832ec8a01cb19c5831c40b4ead8315edf994d158f018ba6b87a90aa12b1&'>

Pour le moment nous n'implémentons pas de base de donnée et nous n'hébergeons pas pour le moment ce site statique.

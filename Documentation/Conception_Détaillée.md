# Connception détaillée 1.0

## Tableau d'abstraction du domaine du problème

Le site statique est le domaine du problème

| Objet                                        | Etat               |Comportement                                |
|----------------------------------------------|--------------------|--------------------------------------------|
|~~Site inscription/connexion~~                |                    |                                            |
| Page d'accueil                               |                    |Toute les pages sont accessible via la page d'accueil|
| Page en construction                         |                    |                                            |
| Formulaire d'inscription                     |Page en construction|                                            |
| Formulaire de Connexion                      |Page en construction|                                            |
| Charte graphique                             |                    |                                            |
| Maquettes 1 et 2                             |Charte graphique    |les maquettes reprennent les codes de la charte graphique|

<u> **Tableau 1**</u> : 


| Objet                                        | Etat               |Comportement                                |
|----------------------------------------------|--------------------|--------------------------------------------|
|~~Site de profil~~                            |                    |                                            |
| Page d'accueil                               |                    |Toute les pages sont accessible via la page d'accueil|
| Page en construction                         |                    |                                            |
| Profil                                       |Page en construction|                                            |
| Logs                                         |                    |                                            |
| Charte graphique                             |                    |                                            |
| Maquettes 1 et 2                             |Charte graphique    |les maquettes reprennent les codes de la charte graphique|

<u> **Tableau 2**</u> : 

#### Abstraction des objets du problème du Tableau 1 

Site inscription/connexion 

**Index_connexion** est l'abstraction de page d'accueil 
**Page en construction** est juste un état temporaire de Formulaire d'inscription et formulaire de Connection elle ne sera alors présente dans le diagramme UML
**Form_inscr** est l'abstraction de Formulaire d'inscription
**Form_connect** est l'abstraction de Formulaire de connexion
**CSS** est l'abstraction de Maquettes 1 et 2
Charte graphique est un attribut de CSS


#### Abstraction des objets du problème du Tableau 2 

Site inscription/connexion 

**Index_Profil** est l'abstraction de page d'accueil 
**Page en construction** est juste un état temporaire de Profils 
**Profil** est l'abstraction de Formulaire d'inscription 
**Logs** est l'abstraction de Formulaire de connexion 
**CSS** est l'abstraction de Maquettes 1 et 2
Charte graphique est un attribut de CSS src=

<img src='https://cdn.discordapp.com/attachments/1148278381767569508/1164586366148022314/Main.jpg?ex=6543c092&is=65314b92&hm=0ecbffa0382b3ea3437a615fa3b958f211888d5cab23d39f475e89683a4d6156&' width=75%>
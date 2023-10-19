# Recueil de Besoin 1.0

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
| Objet                                        | Acteur     | Action à entreprendre                      |
|----------------------------------------------|------------|--------------------------------------------|
| Page d'accueil                               | Utilisateur| Visualiser la page d'accueil du site       |
| Formulaire de connexion                      | Utilisateur| Accéder à la page de formulaire de connexion via la page d'accueil |
| Formulaire d'inscription                     | Utilisateur| Accéder à la page de formulaire d'inscription via la page d'accueil |
| Page de profil                               | Utilisateur| Accéder à la page de profil via la page d'accueil |
| Page de faux logs                            | Utilisateur| Accéder à la page de faux logs via la page d'accueil |
| Tableau de bord fictif                       | Utilisateur| Accéder au tableau de bord fictif via la page d'accueil |

## Cas d'utilisation

### Cas d'utilisation : Accéder aux pages du site
- **Nom :** Accéder aux pages du site
- **Portée :** Site web statique
- **Niveau :** Stratégique
- **Explication :** Ce cas d'utilisation décrit comment les utilisateurs accèdent aux différentes pages du site web statique.
- **Acteur principal :** Utilisateur
- **Scénario :**
    1. L'utilisateur accède à la page d'accueil .
    2. À partir de la page d'accueil, l'utilisateur peut accéder à différentes pages en cliquant sur les liens correspondants.
    3. L'utilisateur peut accéder à la page de formulaire de connexion.
    4. L'utilisateur peut accéder à la page de formulaire d'inscription.
    5. L'utilisateur peut accéder à la page de profil.
    6. L'utilisateur peut accéder à la page de faux logs.
    7. L'utilisateur peut accéder au tableau de bord fictif.

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

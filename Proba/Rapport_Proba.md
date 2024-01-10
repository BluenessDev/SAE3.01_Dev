# Rapport Probabilités

## Shiny
    

Shiny est un package opensource de RStudio permettant la création d’application web à partir du langage R.

Ainsi, avec Shiny, il est possible de créer une application web nous permettant d’analyser des statistiques par rapport à une application ou bien de créer des simulations interactives.

## Notre Application
    

Dans le cadre de notre SAE, nous devions réaliser une application Shiny utilisant un jeu de données en rapport avec notre application web de ticketing.

Nous avons ainsi décidé de créer une application fournissant un diagramme représentant le nombre de tickets créé en fonctions du mois et de l’année.

### Comment fonctionne cette application ?

Cette application possède un formulaire demandant l’année et le mois. L’année que l’on peut choisir dépend des tickets créés. En effet, seules les années de créations des tickets sont sélectionnables. Par exemple, si aucun ticket n’a été créé en 2019, alors l’option 2019 ne sera pas écrite.

Pour chaque année, nous pouvons sélectionner un mois. La sélection d’un mois fonctionne de la même manière que pour l’année. Cependant, dans la sélection du mois, il y a l’option tous.

Lors de l’ouverture de l’application, celle-ci s’ouvre avec l’année la plus ancienne et avec tous pour le mois. Quand l’option tous est sélectionnée, l’application affiche un diagramme représentant le nombre de tickets de l’année en fonction du mois. (Annexe 1).

Lorsque l’on sélectionne un mois, l’application affiche le nombre de tickets créer ce mois-ci. (Annexe 2)

Pour cette application, nous utilisons actuellement des tickets fictifs. Effectivement, nous avons créé un fichier csv contenant pour le moment seulement des dates représentant les dates de création des tickets. L’application va ainsi lire ce fichier csv et créer un tableau contenant toutes les dates.

  

### Évolution possible.

Comme mentionné précédemment, les tickets utilisés sont fictifs, cependant, nous pourrons par la suite récupérer les vrais tickets afin de les mettre dans le fichier csv pour avoir les vraies statistiques de l’application web.

De plus, lors de la sélection d’un mois, nous pourront ensuite faire la liste des tickets du mois avec leur date complète et leurs titres.

  

## Annexes
    
Annexe 1 : capture d'écran de l’application pour une année![](https://lh7-us.googleusercontent.com/6l57iDK48p0JmbiUnTkpEC_ZCU6g1ZNnrBT8cg7YpuLXbUQDdNizV_jzf4J1c2Si73w9LS_PViEl17ZEdXG7-qS19LrHRwjXnCyphjf8DBnP4q4igqkd7PLlsx9dVnVuiNyiVW0ucgH0d0VN4Pri4JY)


Annexe 2 : capture d'écran de l’application pour un mois![](https://lh7-us.googleusercontent.com/EVRWCBPoCjXop5Tlu_G5rgm8BFcFMRpU33N_bixmitzT9Mhfvz0AiBHTc3jfk3dR2gTVIf3lQIwVDXxeOVDJtdj7Fzg7fO_b5UrwsChbHWPyEDi29gSUFuXOf4rcz0bdrXNMJk11qPQMvMgfm2LufqI)

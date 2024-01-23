## Documentation du fichier JavaScript TabsTickets.js

Ce fichier JavaScript est principalement responsable de la gestion des onglets sur la page `dashboard.php`. Il utilise des requêtes AJAX pour récupérer le contenu des onglets et gère l'affichage des onglets en fonction des interactions de l'utilisateur.

### Initialisation :

- Lorsque la page est chargée, la fonction `init()` est appelée.
- Cette fonction crée une nouvelle requête AJAX, l'ouvre avec la méthode GET vers `dashboard.php`, puis l'envoie.
- La fonction `traitementReponse()` est définie comme gestionnaire d'événements pour l'événement `onreadystatechange` de la requête.

### Traitement de la réponse :

- La fonction `traitementReponse()` vérifie si la requête est terminée et si le statut de la réponse est 200 (OK).
- Si c'est le cas, elle récupère tous les éléments de classe `tabcontent` et les cache.
- Elle récupère ensuite tous les enfants de l'élément avec l'id `tab` et ajoute un gestionnaire d'événements `onclick` à chacun d'eux, qui appelle la fonction `openTicketButton()`.

### Gestion des onglets :

- La fonction `openTicketButton()` gère l'affichage des onglets en fonction de l'onglet sur lequel l'utilisateur a cliqué.
- Elle récupère l'id du contenu associé à l'onglet cliqué et l'élément de contenu correspondant.
- Si l'utilisateur a cliqué sur le même onglet deux fois de suite, l'onglet est soit affiché, soit caché.
- Si l'utilisateur a cliqué sur un nouvel onglet, tous les onglets sont d'abord cachés, puis l'onglet sélectionné est affiché.
- L'id du dernier onglet cliqué est mis à jour pour référence future.- L'onglet cliqué est également marqué comme actif en ajoutant la classe `active`.

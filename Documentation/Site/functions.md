## Documentation des fonctions dans le fichier PHP

### Fonction `getIp()` :

Cette fonction est utilisée pour obtenir l'adresse IP du client. Elle vérifie d'abord si `HTTP_CLIENT_IP` est défini, puis `HTTP_X_FORWARDED_FOR`, et enfin `REMOTE_ADDR`. Elle retourne l'adresse IP trouvée.

### Fonction `afficherTickets($utilisateur, $etat, $role)` :

Cette fonction est utilisée pour afficher les tickets en fonction du rôle de l'utilisateur et de l'état du ticket. Elle prépare et exécute une requête SQL pour récupérer les tickets en fonction des paramètres fournis. Les tickets sont ensuite affichés dans un tableau HTML.

### Fonction `afficherUtilisateurs()` :

Cette fonction est utilisée pour afficher tous les utilisateurs ayant les rôles 'technicien' ou 'utilisateur'. Elle prépare et exécute une requête SQL pour récupérer ces utilisateurs. Les utilisateurs sont ensuite affichés dans un tableau HTML avec une option pour mettre à jour leur rôle.

### Fonction `displayTechnicianSelection($conn, $ticketId)` :

Cette fonction est utilisée pour afficher une sélection de techniciens pour un ticket spécifique. Elle prépare et exécute une requête SQL pour récupérer tous les techniciens. Les techniciens sont ensuite affichés dans un formulaire de sélection.

### Fonction `assignTechnicianToTicket($conn, $ticketId)` :

Cette fonction est utilisée pour assigner un technicien à un ticket spécifique. Si un technicien est sélectionné, elle prépare et exécute une requête SQL pour mettre à jour le ticket avec le login du technicien et changer l'état du ticket à 'en_cours'.

### Fonction `updateTicketStatus($conn, $ticketId)` :

Cette fonction est utilisée pour mettre à jour l'état d'un ticket spécifique à 'en_cours'. Elle prépare et exécute une requête SQL pour mettre à jour l'état du ticket.
# Configuration du Raspberry Pi 4

## Materiel à disposition

* Un [Raspberry Pi 4](https://www.raspberrypi.org/products/raspberry-pi-4-model-b/) avec 1go de RAM
* Une [carte SDHC](https://fr.shopping.rakuten.com/offer/buy/291738718/samsung-evo-mb-sp32d-carte-memoire-flash.html?fbbaid=14495305926&t=180112&gad_source=1&gclid=CjwKCAiAx_GqBhBQEiwAlDNAZkOHCToFpn_JHIY3Xfd3eJzhl8lDa3_0UBFWPJd87O44x56A5t9j8RoCBNoQAvD_BwE) de 32go

La carte SDHC est utilisée pour stocker l'OS du Raspberry Pi 4 ainsi que les différents services tel que le serveur web, le serveur de base de données, le serveur ssh et le code source de notre application web.

## Installation de l'OS

Pour l'installation de l'OS, nous avons utilisé Debian 8 sans interface graphique car nous n'en avons pas besoin pour notre projet et cela permet de gagner de la place sur la carte SD et de laisser plus de ressources au serveur web.

* Nous avons dans un premier temps téléchargé l'image de l'OS.

* Ensuite nous avons utilisé [Raspberry Pi Imager](https://www.raspberrypi.org/software/) pour installer l'image sur la carte SD et flasher celle-ci.

* Une fois la carte SD flashée, nous avons inséré celle-ci dans le Raspberry Pi 4 et nous avons démarré celui-ci.

* Nous avons ensuite configuré le Raspberry Pi 4 en suivant les étapes suivantes :
  * Nous avons défini le nom du Raspberry Pi 4 -> `rpi4-23092`
  * Nous n'avons pas défini de nom de domaine car nous n'en avons pas besoin.
  * Nous avons changé le mot de passe root -> `root`
  * La connection au réseau se fait par câble ethernet mais nous l'avons aussi configuré pour qu'il fonctionne en wifi.

Une fois la configuration terminée, nous pouvons passer à l'installation des différents services.

## Installation et mise en place des différents services

### Installation des paquets

Pour installer le serveur web, nous avons utilisé le paquet `apache2` qui est disponible dans les dépôts de Debian 8. Nous supposons par ailleurs que toutes ces commandes sont exécutées en tant que root.

* Pour commencer, nous avons mis à jour la liste des paquets disponibles -> `apt update`

* Ensuite nous avons installé le paquet **apache2** -> `apt install apache2`

* Nous avons ensuite installé le paquet **PHP** -> `apt install php`

* Nous avons aussi installé le paquet **PHP-MYSQL** -> `apt install php-mysql`

* Par ailleurs nous avons aussi installé le paquet **MYSQL** -> `apt install mysql-server`

* Nous avons aussi installé le paquet **PHPMYADMIN** -> `apt install phpmyadmin`

* Enfin nous avons installé le paquet **SSH** -> `apt install sshd`

### Mise en place des services

#### Serveur web

Nous n'avons pas eu besoin de configurer le serveur web car celui-ci est fonctionnel dès son installation. Nous avons juste besoin de placer notre code source dans le dossier `/var/www/html` pour que celui-ci soit accessible depuis le serveur web.

Pour demarrer le service apache2, il suffit d'executer la commande suivante -> `systemctl start apache2`

Pour tester son etat, il suffit d'executer la commande suivante -> `systemctl status apache2` et si le service est actif, il devrait afficher `active (running)`.

Pour tester le serveur web, il suffit d'ouvrir un navigateur web et d'entrer l'adresse IP du Raspberry Pi 4 dans la barre d'adresse. La commande pour afficher l'adresse ip de notre Raspberry Pi sur notre réseau est `ip a`. Si le serveur web est fonctionnel, il devrait afficher la page par défaut d'apache2.

#### Serveur de base de données

Pour configurer la base de données, nous avons utilisé phpmyadmin qui est une interface web pour gérer les bases de données mysql. Pour y accéder, il suffit d'entrer l'adresse IP du Raspberry Pi 4 suivi de `/phpmyadmin` dans la barre d'adresse du navigateur web. Grace à cela, nous avons pu implémenter nos base de données de test pour notre application web.

Pour demarrer le service mysql, il suffit d'executer la commande suivante -> `systemctl start mysql`

Pour tester son etat, il suffit d'executer la commande suivante -> `systemctl status mysql` et si le service est actif, il devrait afficher `active (running)`.

#### Serveur SSH

Pour configurer le serveur SSH, nous avons utilisé le paquet `sshd` qui est disponible dans les dépôts de Debian 8. Nous supposons par ailleurs que toutes ces commandes sont exécutées en tant que root.

Pour demarrer le service sshd, il suffit d'executer la commande suivante -> `systemctl start sshd`

Pour tester son etat, il suffit d'executer la commande suivante -> `systemctl status sshd` et si le service est actif, il devrait afficher `active (running)`.

Pour tester le serveur SSH, il suffit d'ouvrir un terminal et d'executer la commande suivante -> `ssh root@adresse_ip_raspberry_pi` et si le serveur SSH est fonctionnel, il devrait demander le mot de passe root du Raspberry Pi 4.

Et voilà, notre Raspberry Pi 4 est maintenant configuré et fonctionnel. Nous pouvons maintenant passer à l'installation de notre application web.

## Installation de l'application web

Pour installer notre application web, nous avons utilisé le code source de notre application web et nous l'avons placé dans le dossier `/var/www/html` du Raspberry Pi 4. Nous avons aussi importé les bases de données de test dans le serveur de base de données.

Pour tester l'application web, il suffit d'ouvrir un navigateur web et d'entrer l'adresse IP du Raspberry Pi 4 dans la barre d'adresse. Si l'application web est fonctionnelle, il devrait afficher la page d'accueil de notre application web.

## Installation de fail2ban

Fail2ban est un outil qui aide à protéger le RPI contre les attaques de force brute. Il surveille les journaux du site pour les tentatives de connexion échouées et après un certain nombre d'échecs, il bannit l'adresse IP de l'attaquant.

Voici les étapes pour installer et configurer Fail2ban sur un serveur Debian :

1. Mettez à jour la liste des paquets disponibles :
```bash
sudo apt update
```

2. Installez Fail2ban :
```bash
sudo apt install fail2ban
```

3. Une fois installé, Fail2ban démarrera automatiquement. Vous pouvez vérifier son statut avec :
```bash
sudo systemctl status fail2ban
```

4. Pour configurer Fail2ban, vous devez copier le fichier de configuration par défaut (`jail.conf`) vers un nouveau fichier (`jail.local`) qui ne sera pas écrasé lors des mises à jour du paquet :
```bash
sudo cp /etc/fail2ban/jail.conf /etc/fail2ban/jail.local
```

5. Ouvrez le fichier `jail.local` avec un éditeur de texte pour le modifier :
```bash
sudo nano /etc/fail2ban/jail.local
```

Dans notre cas, nous avons ajouté un maxretry de 3 et un bantime de 1h pour le service ssh :
```bash
[sshd]
enabled = true
port = ssh
filter = sshd
logpath = /var/log/auth.log
maxretry = 3
bantime = 1h
```

Et nous avons ajouté aussi un maxretry de 3 et un bantime de 1h quand une adresse IP essaye de se connecter à un compte de l'application web trop de fois :
```bash
[myapp]
enabled = true
port = http,https
filter = myapp
logpath = /var/log/myapp/login_attempts.log
maxretry = 3
bantime = 1h
```

7. Une fois que vous avez terminé de configurer Fail2ban, enregistrez et fermez le fichier.

8. Pour que les modifications prennent effet, il faut redémarrer le service Fail2ban :
```bash
sudo systemctl restart fail2ban
```

C'est tout ! Fail2ban est maintenant installé et configuré sur le serveur. Il surveillera les journaux de notre RPI pour les tentatives de connexion échouées et bannira les adresses IP qui échouent trop souvent.

## Mise en place de CRON

CRON est un outil qui permet d'exécuter des tâches planifiées à des moments spécifiques. Nous avons utilisé CRON pour sauvegarder les logs de notre application web toutes les 24h.

Voici les étapes pour configurer une tâche CRON sur un serveur Debian :

1. Pour éditer les tâches CRON, exécutez la commande suivante :
```bash
crontab -e
```

2. Ajoutez la ligne suivante à la fin du fichier pour sauvegarder les logs de notre application web toutes les 24h. Cette ligne exécute le script `zip_logs.sh` à 2h du matin tous les jours :
```bash
0 2 * * * /var/www/html/zip_logs.sh
```

3. Enregistrez et fermez le fichier.

C'est tout ! La tâche CRON est maintenant configurée pour sauvegarder les logs de notre application web toutes les 24h.

## Mise en place de ntp

NTP (Network Time Protocol) est un protocole qui permet de synchroniser l'horloge du Raspberry Pi avec un serveur de temps. Cela permet de garder l'horloge du Raspberry Pi à jour et de garantir que les tâches planifiées s'exécutent au bon moment.

Voici les étapes pour configurer NTP sur un serveur Debian :

1. Il faut editer le fichier `etc/systemd/timesyncd.conf` :
```bash
sudo nano /etc/systemd/timesyncd.conf
```

2. Ajoutez la ligne suivante à la fin du fichier pour synchroniser l'horloge du Raspberry Pi avec un serveur NTP :
```bash
NTP=io.uvsq.fr
```

3. Enregistrez et fermez le fichier.

4. Pour que les modifications prennent effet, il faut redémarrer le service NTP :
```bash
sudo systemctl restart systemd-timesyncd
```
Cependant, il est possible que le service NTP ne soit pas installé sur le Raspberry Pi. Pour l'installer, il suffit d'exécuter la commande suivante :
```bash
sudo apt install systemd-timesyncd
```

C'est tout ! NTP est maintenant configuré sur le serveur. L'horloge du Raspberry Pi sera synchronisée avec un serveur de temps pour garantir que les tâches planifiées s'exécutent au bon moment.


## Conclusion

Nous avons réussi à configurer notre Raspberry Pi 4 pour qu'il puisse héberger notre application web ainsi qu'à configurer le serveur web, le serveur de base de données et le serveur SSH. Puis nous avons aussi réussi à installer notre application web sur le Raspberry Pi 4.

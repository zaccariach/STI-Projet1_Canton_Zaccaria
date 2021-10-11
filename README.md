# STI-Projet1_Canton_Zaccaria

###### Christian Zaccaria & Dylan Canton

###### Date : 30.09.2021

---



### 1. Installation de l'infrastructure

* Il est tout d'abord nécessaire d'avoir un Docker fonctionnel sur la machine. 

* Lancer ensuite le script `run-services.sh` qui se trouve dans le dossier `STI-Projet1_Canton_Zaccaria`. Ce script : 
  * Supprime le container `sti_project` si celui-ci est déjà existant.
  * Lance un container docker nommé `sti_project` et effectue un mapping du port 8080 de la machine hôte vers le port 80 du container.
  * Copie les fichiers de l'application web et de la base de donnée dans le container.
  * Pour finir, lance le service web ainsi que le service PHP.

A ce stade, le container docker est fonctionnel et contient tous les fichiers nécessaires à l'application web.



### 2. Accéder à l'application web

* L'application web est accessible à l'adresse `localhost:8080` sur votre navigateur. 

  

### 3. Identifiants

Voici la liste des identifiants créés, ces derniers sont soit *actif*, soit *inactif*. De plus, différents e-mail de tests ont déjà été générés.

| Username | Password | Statut du compte et rôle |
| :------: | :------: | :----------------------: |
|  dylan   | sti2021  |  Actif + Administrateur  |
|  chris   | sti2021  |   Actif + Utilisateur    |
| abraham  | sti2021  | Inactif + Administrateur |
|  steph   | sti2021  |   Actif + Utilisateur    |


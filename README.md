# STI-Projet1_Canton_Zaccaria



### Avancée du projet

* BDD remplie avec tables et données
* Page de login
  * Connexion à un compte
  * Vérification si le compte n'existe pas ou n'est pas valide (Boolean isValid à 0)
* Page utilisateur
  * Affichage des messages reçus 
  * Déconnexion du compte

* Header avec bouton de logout si une session est active
* Fichier "logout" pour destruction de session 



---

### BDD

Utilisateur
	login(text)
	password(text)
	validité(boolean)
	admin(boolean)
	
Message
	dateReception(date)
	expediteur(text)
	destinataire(text)
	sujet(text)
	corpsMessage(text)
	



### QuickDBD SYNTAXE

**User**

idUser PK int
login string
password string
isValid boolean
isAdmin boolean



**Message**

idMessage PK int
dateReception dateTime
sender string
receiver string
subject string
text string



![image-20210923163953505](media/bdd.png)
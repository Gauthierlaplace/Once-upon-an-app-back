# Projet Apothéose - Adventure RPG

# Environnement DEV

## 1 Paramètrage de la connexion serveur Adminer pour accès BDD en local

Dans le fichier .env
```env
    DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=8&charset=utf8mb4"
    #DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=15&charset=utf8"
```
Mettre en commentaire la partie `DATABASE_URL="postgresql`
Décommenter la partie `DATABASE_URL="mysql`

Il faudra ensuite créer le fichier .env.local à la racine du projet

Dans ce fichier, placer 

```env
DATABASE_URL="mysql://rpg:rpg@127.0.0.1:3306/rpg?serverVersion=mariadb-10.3.25&charset=utf8mb4"
```

## 2 Remise en place de la BDD en local avec ses données

##### Dans Adminer :
Créer une nouvelle database nommé `rpg` avec un nouvel utilisateur `rpg`ayant pour mot de passe `rpg` et cocher la case `all privileges` avant de valider

### Dans le terminal :
##### Construire l'architecture de la BDD

```bash
bin/console doctrine:migrations:migrate  
```
puis 
```bash
Y
```

##### Charger les données en BDD
```bash
bin/console doctrine:fixtures:load
```
## 3 Accès API


#### Installation

Installation du Rest API Client Thunder Client
```text
Nom : Thunder Client
ID : rangav.vscode-thunder-client
Description : Lightweight Rest API Client for VS Code
Version : 2.7.0
Serveur de publication : Ranga Vadhineni
Lien de la Place de marché pour VS : https://marketplace.visualstudio.com/items?itemName=rangav.vscode-thunder-client
```
Importer la collection dans le client API depuis le fichier situé:
```text
/docs/API/thunder-collection_Adventure RPG.json
```

#### Authentification (Token)





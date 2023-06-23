# Projet Apothéose - Adventure RPG

## Sommaire

-
  - [Cloner le repository](#cloner-le-repository)
  - [Aller dans le dossier du projet](#aller-dans-le-dossier-du-projet)
  - [Installer les dépendances](#installer-les-dépendances)
  - [Créer la BDD](#créer-la-bdd)
    - [Dans Adminer](#dans-adminer)
  - [Paramètrage de la connexion serveur Adminer pour accès BDD en local](#paramètrage-de-la-connexion-serveur-adminer-pour-accès-bdd-en-local)
  - [Ajout du token JWT](#ajout-du-token-jwt)
    - [Pour accèder a votre App, lancer votre server](#pour-accèder-a-votre-app-lancer-votre-server)

### Cloner le repository

```bash
git clone git@github.com:O-clock-Radium/projet-jeu-de-role-aventure-back.git
```

### Aller dans le dossier du projet

```bash
cd projet-jeu-de-role-aventure-back/
```

### Installer les dépendances  

```bash
composer install
```

### Créer la BDD

#### Dans Adminer

Créer une nouvelle database nommé `rpg` avec un nouvel utilisateur `rpg`ayant pour mot de passe `rpg` et cocher la case `all privileges` avant de valider

### Paramètrage de la connexion serveur Adminer pour accès BDD en local

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

### Ajout du token JWT

```bash
bin/console lexik:jwt:generate-keypair
```

#### Pour accèder a votre App, lancer votre server

```bash
php -S 0.0.0.0:8000 -t public
```

Vous pouvez test toutes les routes api via l'extension 'thunder client' en faisant un import de la collection qui se trouve dans le dossier docs/APi/ directement depuis 'thunder client'

# Déploiement

## Sommaire

-
  - [Se connecter dans un terminal avec la clé SSH](#se-connecter-dans-un-terminal-avec-la-clé-ssh)
    - [Aller dans le dossier html](#aller-dans-le-dossier-html)
    - [Cloner le repository](#cloner-le-repository)
    - [Aller dans le dossier du projet](#aller-dans-le-dossier-du-projet)
    - [Installer les dépendances](#installer-les-dépendances)
    - [Paramétrer le fichier .env.local](#paramétrer-le-fichier-envlocal)
    - [Créer la BDD](#créer-la-bdd)
    - [Entrer le commande pour la réécriture d’url](#entrer-le-commande-pour-la-réécriture-durl)
    - [Ajout du token JWT](#ajout-du-token-jwt)
    - [Passer en prod en configurant le fichier .env](#passer-en-prod-en-configurant-le-fichier-env)
  - [Ajout de données dans la BDD en automatique](#ajout-de-données-dans-la-bdd-en-automatique)
    - [Accéder au fichier d'export sql](#accéder-au-fichier-dexport-sql)
    - [Importer le fichier d'export sql](#importer-le-fichier-dexport-sql)
  - [Ajout de données dans la BDD en manuel](#ajout-de-données-dans-la-bdd-en-manuel)
    - [Accéder à mariaDB](#accéder-à-mariadb)
    - [Vérifier l'existence de votre serveur](#vérifier-lexistence-de-votre-serveur)
    - [Entrer dans votre serveur](#entrer-dans-votre-serveur)
    - [Ajouter vos données en ligne de commande](#ajouter-vos-données-en-ligne-de-commande)
  - [Update de votre déploiement](#update-de-votre-déploiement)
    - [Se connecter avec la clé SSH](#se-connecter-avec-la-clé-ssh)
    - [Aller dans le votre projet](#aller-dans-le-votre-projet)
    - [Mettre à jour le projet](#mettre-à-jour-le-projet)
    - [Mettre à jour les dépendances s'il y en a](#mettre-à-jour-les-dépendances-sil-y-en-a)
    - [Nettoyer le cache](#nettoyer-le-cache)
  - [Erreurs possibles](#erreurs-possibles)
    - ['Unable to write' ou '500 Internal Server Error'](#unable-to-write-ou-500-internal-server-error)

### Se connecter dans un terminal avec la clé SSH

```bash
ssh student@prenomNom-server.eddi.cloud
```

Attention, veuillez remplacer cette clé SSH par la votre

#### Aller dans le dossier html

```bash
cd /var/www/html
```

#### Cloner le repository

```bash
git clone git@github.com:O-clock-Radium/projet-jeu-de-role-aventure-back.git
```

#### Aller dans le dossier du projet

```bash
cd projet-jeu-de-role-aventure-back/
```

#### Installer les dépendances

```bash
composer install
```

#### Paramétrer le fichier .env.local

```bash
nano .env.local
```

Ajouter le contenu

```text
DATABASE_URL="mysql://UserSuperAdmin:Password@127.0.0.1:3306/nomDuServer?serverVersion=mariadb-10.3.38&charset=utf8mb4"
```

Attention, 'userSuperAdmin', 'password' et 'nomDuServer' sont à modifier avec vos identifiants réels et votre nom de server souhaité

Valider avec ctrl x puis yes et entrer

#### Créer la BDD

```bash
bin/console doctrine:database:create
```

#### Entrer le commande pour la réécriture d’url

```bash
composer require symfony/apache-pack
```

Lors de l'install, une question sera posé, répondre y puis entrer

#### Ajout du token JWT

```bash
bin/console lexik:jwt:generate-keypair
```

#### Passer en prod en configurant le fichier .env

```bash
nano .env
```

Modifier le contenu

```text
APP_ENV=prod
```

Valider avec ctrl x puis yes et entrer

### Ajout de données dans la BDD en automatique

#### Accéder au fichier d'export sql

```bash
cd docs/BDD/
```

#### Importer le fichier d'export sql

```bash
mysql -u userSuperAdmin -p nomDuServer < DATABASE.sql
```

Attention, 'userSuperAdmin' et 'nomDuServer' sont à modifier avec votre identifiant réel et votre nom de server

Attention, 'DATABASE.sql' doit être la derniere version disponible

 Valider avec le mot de passe de votre compte userSuperAdmin

### Ajout de données dans la BDD en manuel

#### Accéder à mariaDB

```bash
mysql -u userSuperAdmin -p
```

Attention, 'userSuperAdmin'est à modifier avec votre identifiant réel

Saisir le mot de passe votre compte userSuperAdmin

#### Vérifier l'existence de votre serveur

```sql
show databases;
```

#### Entrer dans votre serveur

```sql
use nomDuServer;
```

Attention, 'nomDuServer'est à modifier avec votre nom de server

#### Ajouter vos données en ligne de commande

```text
Copier le contenu de `DATABASE.sql` et le coller
```

Attention, 'DATABASE.sql' doit être la derniere version disponible !

### Update de votre déploiement

#### Se connecter avec la clé SSH

```bash
ssh student@prenomNom-server.eddi.cloud
```

Attention, veuillez remplacer cette clé SSH par la votre

#### Aller dans le votre projet

```bash
cd /var/www/html/projet-jeu-de-role-aventure-back/
```

#### Mettre à jour le projet

```bash
git pull
```

#### Mettre à jour les dépendances s'il y en a

```bash
composer update
```

#### Nettoyer le cache

```bash
bin/console cache:clear
```

Pour ajouter des nouvelles données à votre BDD, se référé à [Ajout de données dans la BDD](#ajout-de-données-dans-la-bdd-en-automatique)

### Erreurs possibles

#### 'Unable to write' ou '500 Internal Server Error'

Ces erreurs sont des problèmes de droit (permissions), pour les résoudres faites les commandes suivantes

```bash
sudo chown -R student:www-data var/cache/
sudo chmod -R g+w var/cache/
sudo chmod g+s var/cache/
```

# https

## coté front

Modification des variables d'environnement :

Fichier .env
```bash
REACT_APP_HTTPS=false
#Ceci désactive le https en mode developpement (local)
REACT_APP_API_BASE=https://backoffice.onceuponanapp.fr/api
#Ajout du "s"
REACT_APP_ASSETS_BASE=https://backoffice.onceuponanapp.fr/
#Ajout du "s"
```

Redémarrer le servuur

CTRL + C

```bash
npm start
```

a la racine du projet

dans le fichier .htaccess

```bash
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

## coté back

dans le fichier :  service.yaml

```yaml
parameters:
    router.request_context.scheme: 'https'
    asset.request_context.secure: true
```

rafraichir le cache:

```bash
bin/console cache:clear
```

a la racine du projet dans le fichier .htaccess

```bash
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

s'il n'est pas présent :

```bash
composer require symfony/apache-pack
```

rafraichir le cache:

```bash
bin/console cache:clear
```

### Le serveur doit avoir un certificat SSL que l'hébergeur gère, il suffit de le générer pour qu'il soit automatiquement pris en compte lors des demandes URL HTTPS
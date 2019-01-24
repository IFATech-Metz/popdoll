## Utiliser une image existante comme base pour sa propre image
## Ici, on utilise l'image `php` dans sa version `apache`, elle-même basée sur une image `debian:stretch-slim` et intégrant un serveur Apache2.
## Cette valeur prends la forme `<image>:<version>`. Si `version` est omis, `:latest` sera utilisé.
## https://hub.docker.com/_/php
## https://github.com/docker-library/php/blob/1eb2c0ab518d874ab8c114c514e16aa09394de14/7.3/stretch/apache/Dockerfile
FROM php:apache

## Faire les mises à jour et installer la lib yaml pour le module PECL
## Des commandes Debian classiques…
RUN apt-get update && apt-get -y install libyaml-dev && apt-get clean

## Installer le module PECL `YAML` et activer les modes `rewrite` et `headers` d'Apache2
RUN pecl install yaml && a2enmod rewrite && a2enmod headers && docker-php-ext-enable yaml

## Remplacer la configuration par défaut d'Apache2 du container
COPY /Docker/apache.conf /etc/apache2/sites-available/000-default.conf

## Copier le script de démarrage
COPY /Docker/start.sh /var/www/html/start.sh

## Copier le fichier `.htaccess` à la racine du répertoire de travail d'Apache2
COPY ./.htaccess /var/www/html/

## Copier le dossier `src` dans le répertoire de travail
COPY ./src /var/www/html/src/

## Indiquer l'emplacement où devra être monté un volume persistant, qui permettra de conserver les données entre les redémarrage du container
VOLUME  /var/www/html/data

## Renseigne la commande par défaut à éxectuer au démarrage du container quand il sera exécuté
CMD [ "sh", "/var/www/html/start.sh" ]

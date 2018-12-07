FROM php:apache

RUN apt-get update && apt-get -y install libyaml-dev && apt-get clean

RUN pecl install yaml && docker-php-ext-enable yaml

COPY . /var/www/html/

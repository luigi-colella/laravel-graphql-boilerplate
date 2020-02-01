FROM php:7.4-fpm

WORKDIR /var/www
COPY ./composer.phar /usr/local/bin/composer
COPY ./ /var/www/

RUN apt-get update \
    && apt-get install libzip-dev unzip -y \
    && docker-php-ext-install bcmath zip

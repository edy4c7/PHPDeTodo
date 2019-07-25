FROM php:7.3-apache

RUN apt update
RUN apt install -y build-essential
RUN apt install -y sqlite3 
RUN pecl install xdebug && docker-php-ext-enable xdebug

WORKDIR /var/www
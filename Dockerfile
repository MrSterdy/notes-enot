FROM php:8.2.12-apache

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN a2enmod rewrite

WORKDIR /var/www/html

COPY . .

EXPOSE 80
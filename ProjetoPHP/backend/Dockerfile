FROM php:8.2-apache

RUN docker-php-ext-install mysqli

COPY backend/ /var/www/html/
COPY frontend/ /var/www/html/

RUN chown -R www-data:www-data /var/www/html/

EXPOSE 80

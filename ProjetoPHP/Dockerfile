FROM php:8.1

RUN apt-get update && apt-get install -y \
    unzip \
    zip \
    git \
    curl

RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

WORKDIR /ProjetoPHP/backend

COPY .  .

RUN composer install

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]

EXPOSE 8000

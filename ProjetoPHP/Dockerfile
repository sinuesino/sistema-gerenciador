FROM php:8.1

RUN apt-get update && apt-get install -y unzip zip git curl libzip-dev libonig-dev libxml2-dev g++ zip \
    && docker-php-ext-install zip pdo pdo_mysql mbstring

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /ProjetoPHP/backend

COPY ./backend/composer.json ./backend/composer.lock* ./  # Copia só os arquivos composer para cache melhor
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

COPY ./backend ./  # copia o restante dos arquivos do backend

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]

EXPOSE 8000

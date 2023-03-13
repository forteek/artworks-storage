FROM php:8.1-fpm

RUN apt update && apt install -y \
        zip \
        bash \
        libpq-dev \
        libzip-dev \
    && docker-php-ext-install \
        zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/vhosts/core

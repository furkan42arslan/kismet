# syntax=docker/dockerfile:1

FROM node:22-alpine AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY resources ./resources
COPY vite.config.js .
RUN npm run build

FROM composer:2 AS dependencies
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-progress \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

FROM php:8.2-apache

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libicu-dev \
        libonig-dev \
        libsqlite3-dev \
        libzip-dev \
        unzip \
    && docker-php-ext-install \
        bcmath \
        exif \
        intl \
        mbstring \
        opcache \
        pcntl \
        pdo_sqlite \
        zip \
    && a2enmod rewrite headers \
    && sed -ri -e "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/sites-available/*.conf \
    && sed -ri -e "s!/var/www/!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY --from=dependencies /app/vendor ./vendor
COPY . .
COPY --from=frontend /app/public/build ./public/build
COPY database/migrations /opt/kismet-migrations
COPY docker/entrypoint.sh /usr/local/bin/kismet-entrypoint

RUN chmod +x /usr/local/bin/kismet-entrypoint \
    && mkdir -p storage database \
    && chown -R www-data:www-data /var/www/html

EXPOSE 80

ENTRYPOINT ["kismet-entrypoint"]
CMD ["apache2-foreground"]

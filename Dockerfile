# Stage 1: Install PHP dependencies via Composer
FROM composer:2 AS vendor

WORKDIR /var/www

COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-scripts

COPY . .

# Stage 2: Build frontend assets
FROM node:18 AS assets

WORKDIR /var/www

COPY --from=vendor /var/www /var/www

RUN npm install || (cat /root/.npm/_logs/*-debug-0.log && false)

RUN npm run build

# Stage 3: Laravel PHP application
FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

WORKDIR /var/www

COPY --from=assets /var/www /var/www

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

ENV APP_ENV=production \
    APP_DEBUG=false \
    APP_KEY=base64:dummykey1234567890= \
    PORT=8000

RUN php artisan package:discover --ansi \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000



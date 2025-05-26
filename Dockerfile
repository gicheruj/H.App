# Stage 1: Install PHP dependencies via Composer
FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction

COPY . .

# Stage 2: Build frontend assets
FROM node:18 AS assets

WORKDIR /app

COPY --from=vendor /app /app

RUN npm install && npm run build

# Stage 3: Laravel PHP application
FROM php:8.2-cli

# Install PHP extensions and system dependencies
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

# Set working directory
WORKDIR /app

# Copy application code from assets stage
COPY --from=assets /app /app

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Set Laravel environment
ENV APP_ENV=production \
    APP_DEBUG=false \
    APP_KEY=base64:dummykey1234567890= \
    PORT=8000

# Expose port
EXPOSE 8000

# Entrypoint for Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000


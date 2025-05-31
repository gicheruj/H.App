# Stage 1: Install PHP dependencies
FROM composer:2 AS vendor

WORKDIR /H.App

COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-scripts

COPY . .

# Stage 2: Build frontend assets
FROM node:18 AS assets

WORKDIR /H.App

# Copy entire Laravel app including resources/ and vite.config.js
COPY . .

# Install node modules and build assets
RUN npm install && npm run build

# Stage 3: Final Laravel PHP application image
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
WORKDIR /H.App

# Copy everything from previous stage
COPY --from=assets /app /app

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Laravel environment
ENV APP_ENV=production \
    APP_DEBUG=false \
    PORT=8000

# Laravel optimization
RUN php artisan config:clear && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Expose port
EXPOSE 8000

# Start Laravel app
CMD php artisan serve --host=0.0.0.0 --port=8000


# FROM composer:2 as vendor

# WORKDIR /app

# COPY composer.json composer.lock ./
# RUN composer install --no-dev --prefer-dist --no-interaction

# COPY . .

# FROM node:18 as assets

# WORKDIR /app

# COPY --from=vendor /app /app
# RUN npm install && npm run build

# FROM php:8.2-cli

# # Install PHP extensions
# RUN apt-get update && apt-get install -y \
#     libpng-dev \
#     libonig-dev \
#     libxml2-dev \
#     zip \
#     unzip \
#     git \
#     curl \
#     && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# WORKDIR /app

# COPY --from=assets /app /app

# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# # Generate Laravel key
# RUN php artisan key:generate

# EXPOSE 8000

# CMD php artisan serve --host=0.0.0.0 --port=8000

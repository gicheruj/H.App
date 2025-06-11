#!/bin/bash
set -o errexit

echo "🚀 Starting Laravel build process..."

echo "📦 Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader

echo "🧹 Clearing Laravel caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

echo "📁 Creating storage directories..."
mkdir -p storage/logs
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views

echo "🔧 Setting proper permissions..."
chmod -R 775 storage
chmod -R 775 bootstrap/cache

echo "✅ Build completed successfully!"
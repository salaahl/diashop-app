#!/usr/bin/env bash

set -e  # Arrêter le script en cas d'erreur

echo "Running composer install..."
composer install --no-dev --optimize-autoloader --working-dir=/var/www/html || { echo "Composer install failed"; exit 1; }

echo "Clearing caches..."
php artisan cache:clear
php artisan config:clear
php artisan view:clear

echo "Testing database connection..."
php -r "try { new PDO('pgsql:host=$DB_HOST;dbname=$DB_DATABASE', '$DB_USERNAME', '$DB_PASSWORD'); echo 'Database connection OK\n'; } catch (Exception \$e) { echo 'Database connection failed: ' . \$e->getMessage() . '\n'; exit(1); }"

echo "Running migrations..."
php artisan migrate --force || { echo "Migrations failed"; exit 1; }

echo "Running seeders..."
php artisan db:seed --force || { echo "Seeding failed"; exit 1; }

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Caching views..."
php artisan view:cache

echo "Deployment completed successfully!"

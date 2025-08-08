#!/bin/sh

set -e

echo "Running composer install..."
composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-exif --working-dir=/var/www/html || { echo "Composer install failed"; exit 1; }

echo "Clearing caches..."
php artisan cache:clear
php artisan config:clear
php artisan view:clear

echo "Testing database connection..."
php -r "try { new PDO('pgsql:host=$DB_HOST;dbname=$DB_DATABASE', '$DB_USERNAME', '$DB_PASSWORD'); echo 'Database connection OK\n'; } catch (Exception \$e) { echo 'Database connection failed: ' . \$e->getMessage() . '\n'; exit(1); }"

echo "Running migrations and seeders..."
php artisan migrate:fresh --seed --force || { echo "Migrations failed"; exit 1; }

echo "Install voyager and run voyager seeder..."
php artisan voyager:install --force || { echo "Voyager install failed, but continuing..."; true; }
php artisan db:seed --class=VoyagerDatabaseSeeder --force || { echo "Seeding voyager database failed, but continuing..."; true; }

echo "Vérification du dossier public/build..."
ls -la /var/www/html/public/build || { echo "❌ Le dossier public/build est introuvable !"; exit 1; }

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Caching views..."
php artisan view:cache

echo "✅ Deployment completed successfully!"

exec "$@"

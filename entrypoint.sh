#!/bin/sh
set -e

echo "Checking required environment variables..."
if [ -z "$DB_HOST" ] || [ -z "$DB_DATABASE" ] || [ -z "$DB_USERNAME" ] || [ -z "$DB_PASSWORD" ]; then
  echo "❌ Database environment variables are missing."
  exit 1
fi

echo "Running composer install..."
composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-exif --working-dir=/var/www/html

# echo "Clearing caches..."
# php artisan route:clear
# php artisan cache:clear
# php artisan config:clear

echo "Testing database connection..."
php -r "try { new PDO('pgsql:host=$DB_HOST;dbname=$DB_DATABASE', '$DB_USERNAME', '$DB_PASSWORD'); echo 'Database connection OK\n'; } catch (Exception \$e) { echo 'Database connection failed: ' . \$e->getMessage() . '\n'; exit(1); }"

echo "Verifying public/build folder..."
ls -la /var/www/html/public/build || { echo "❌ Le dossier public/build est introuvable !"; exit 1; }

echo "Caching config, routes, and views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# echo "Starting queue worker..."
php artisan queue:work --daemon

echo "✅ Deployment completed successfully!"
exec "$@"

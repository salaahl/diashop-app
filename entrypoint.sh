#!/usr/bin/env bash

set -e

echo "🔧 Exécution de Composer..."
composer install --no-dev --optimize-autoloader --working-dir=/var/www/html || { echo "❌ L'installation de Composer a échoué"; exit 1; }

echo "🧹 Nettoyage des caches Laravel..."
php artisan cache:clear
php artisan config:clear
php artisan view:clear

echo "🔗 Vérification de la connexion à la base de données..."
php -r "try { new PDO('pgsql:host=$DB_HOST;dbname=$DB_DATABASE', '$DB_USERNAME', '$DB_PASSWORD'); echo '✅ Connexion à la base de données réussie\n'; } catch (Exception \$e) { echo '❌ Échec de la connexion à la base de données: ' . \$e->getMessage() . '\n'; exit(1); }"

echo "🛠️ Exécution des migrations..."
if php artisan migrate --force; then
  echo "✅ Migrations terminées avec succès."
else
  echo "⚠️ Les migrations ont échoué, mais on continue. (Peut-être déjà appliquées ?)"
fi

echo "🌱 Exécution des seeders..."
if php artisan db:seed --force; then
  echo "✅ Seeders exécutés avec succès."
else
  echo "⚠️ Les seeders ont échoué, mais on continue. (Déjà appliqués ?)"
fi

echo "🔍 Vérification du dossier public/build..."
ls -la /var/www/html/public/build || { echo "❌ Le dossier public/build est introuvable !"; exit 1; }

echo "📦 Mise en cache des configurations..."
php artisan config:cache

echo "🚀 Mise en cache des routes..."
php artisan route:cache

echo "🔄 Mise en cache des vues..."
php artisan view:cache

echo "✅ Déploiement effectué avec succès !"

# Exécute la commande PHP-FPM
exec "$@"

#!/bin/bash

# Attendre que PostgreSQL soit prêt (timeout après 30 secondes)
TIMEOUT=30
COUNT=0
until php -r "try { new PDO('pgsql:host=${DB_HOST};dbname=${DB_DATABASE}', '${DB_USERNAME}', '${DB_PASSWORD}'); exit(0); } catch (Exception \$e) { echo 'Erreur PDO: ' . \$e->getMessage(); exit(1); }" || [ $COUNT -ge $TIMEOUT ]; do
    echo "En attente de la base de données PostgreSQL... ($COUNT/$TIMEOUT)"
    sleep 2
    COUNT=$((COUNT + 2))
done

if [ $COUNT -ge $TIMEOUT ]; then
    echo "Erreur : Impossible de se connecter à PostgreSQL après $TIMEOUT secondes"
    exit 1
fi

# Exécuter les migrations
php artisan migrate --force

# Exécuter les seeders (optionnel, commenter si non nécessaire)
# php artisan db:seed --force

# Démarrer PHP-FPM
exec php-fpm
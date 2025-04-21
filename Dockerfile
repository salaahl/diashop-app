# Étape 1 : Builder les assets avec Node
FROM node:20-alpine as nodebuilder

WORKDIR /app

COPY package*.json ./
RUN npm ci

COPY . .
RUN npm run build && ls -l /app/public/build || { echo "Build failed: public/build not found"; exit 1; }

# Étape 2 : PHP + FPM
FROM php:8.3-fpm

# Dépendances système
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    libpq-dev \
    exif \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_pgsql pgsql exif \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers du projet
COPY . .

# Copier les assets compilés depuis l'étape nodebuilder
COPY --from=nodebuilder /app/public/build /var/www/html/public/build

# Installer les dépendances PHP
ARG COMPOSER_NO_DEV=true
RUN composer install --optimize-autoloader --no-dev --ignore-platform-req=ext-exif

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Script de déploiement
COPY scripts/00-laravel-deploy.sh /scripts/00-laravel-deploy.sh
RUN chmod +x /scripts/00-laravel-deploy.sh

# Entrypoint
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
CMD ["php-fpm"]
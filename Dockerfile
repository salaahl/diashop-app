FROM php:8.3-fpm

# Installer les dépendances système
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
    && echo "extension=pdo_pgsql.so" > /usr/local/etc/php/conf.d/docker-php-ext-pdo_pgsql.ini \
    && echo "extension=pgsql.so" > /usr/local/etc/php/conf.d/docker-php-ext-pgsql.ini \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers du projet
COPY . .

# Installer les dépendances PHP en mode production
ARG COMPOSER_NO_DEV=true
RUN composer install --optimize-autoloader --no-dev

# Optimiser Laravel pour la production
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Donner les permissions nécessaires
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Copier le script de deployment
COPY scripts/00-laravel-deploy.sh /scripts/00-laravel-deploy.sh
RUN chmod +x /scripts/00-laravel-deploy.sh

# Copier et configurer le script entrypoint
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
CMD ["php-fpm"]
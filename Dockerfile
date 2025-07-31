FROM php:8.2-fpm

# Installer les bibliothèques nécessaires, y compris libjpeg-dev
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libjpeg-dev \
    zip && \
    docker-php-ext-install \
        pdo \
        pdo_mysql \
        zip




# Installer Composer globalement
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers Laravel dans le conteneur
COPY . .

# Installer les dépendances Laravel
RUN composer install --no-interaction --optimize-autoloader


# Fixer les permissions (optionnel mais recommandé)
RUN chown -R www-data:www-data storage bootstrap/cache

# Exposer le port utilisé par PHP-FPM
EXPOSE 9000

# Démarrer PHP-FPM
CMD ["php-fpm"]

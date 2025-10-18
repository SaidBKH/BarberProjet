# Base PHP avec Apache
FROM php:8.2-apache

# Installer les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
        libonig-dev \
        libzip-dev \
        unzip \
    && docker-php-ext-install pdo pdo_mysql mysqli

# Copier le code dans le conteneur
COPY . /var/www/html/

# Assurer les bons droits
RUN chown -R www-data:www-data /var/www/html

# Activer les modules Apache nécessaires (optionnel)
RUN a2enmod rewrite

# Expose le port 80
EXPOSE 80

# Lancer Apache en avant-plan
CMD ["apache2-foreground"]

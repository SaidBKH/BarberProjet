# Utilise l'image officielle PHP avec Apache
FROM php:8.2-apache

# Copie tout ton code dans le dossier web du conteneur
COPY . /var/www/html/

# Donne les bons droits d'accès
RUN chown -R www-data:www-data /var/www/html

# Expose le port sur lequel Apache tournera
EXPOSE 80

# Démarre Apache
CMD ["apache2-foreground"]

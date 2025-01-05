# Utiliser l'image PHP avec Apache préinstallé
FROM php:8.1-apache

# Installer les extensions PHP nécessaires, si besoin
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Copier le code du site vers le répertoire par défaut d'Apache
COPY . /var/www/html/

# Exposer le port 80 pour accéder au serveur
EXPOSE 80

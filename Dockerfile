FROM php:8.2-apache

# Copia i file nel container
COPY . /var/www/html/

# Attiva mod_rewrite per .htaccess se serve
RUN a2enmod rewrite
FROM php:8.2-apache

# Enable mod_rewrite
RUN a2enmod rewrite

# Install curl
RUN apt-get update && apt-get install -y curl

# Copy files
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

FROM php:8.2-apache

RUN apt-get update && apt-get install -y curl

# 🚨 Hard reset MPM configs
RUN rm -f /etc/apache2/mods-enabled/mpm_*.load || true
RUN rm -f /etc/apache2/mods-enabled/mpm_*.conf || true

# Enable ONLY prefork
RUN a2enmod mpm_prefork

# Other required modules
RUN a2enmod rewrite

# Copy app
COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html

FROM php:8.2-apache

# Enable required Apache modules
RUN a2enmod rewrite

# Disable all MPMs first
RUN a2dismod mpm_event mpm_worker

# Enable only prefork (required for mod_php)
RUN a2enmod mpm_prefork

# Install curl (needed for Supabase API calls)
RUN apt-get update && apt-get install -y curl

# Copy app files
COPY . /var/www/html/

# Fix permissions
RUN chown -R www-data:www-data /var/www/html

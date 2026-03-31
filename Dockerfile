FROM php:8.2-apache

# Install curl
RUN apt-get update && apt-get install -y curl

# 🚨 Disable ALL MPM modules first (IMPORTANT)
RUN a2dismod mpm_event || true
RUN a2dismod mpm_worker || true
RUN a2dismod mpm_prefork || true

# ✅ Enable ONLY ONE MPM
RUN a2enmod mpm_prefork

# Enable rewrite
RUN a2enmod rewrite

# Copy app
COPY . /var/www/html/

# Permissions
RUN chown -R www-data:www-data /var/www/html

FROM php:8.1-apache

# Install mysqli (for MySQL)
RUN docker-php-ext-install mysqli

# Copy project files
COPY . /var/www/html/

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Use the official PHP-Apache image
FROM php:8.2-apache

# Enable Apache mod_rewrite (common for routing)
RUN a2enmod rewrite

# Install required system dependencies for PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Copy project files to Apache document root
COPY . /var/www/html

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 for Render
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]

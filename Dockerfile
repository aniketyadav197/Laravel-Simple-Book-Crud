FROM php:8.2-apache

# Install system dependencies including libpq-dev for PostgreSQL
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpq-dev \
    && docker-php-ext-install zip pdo pdo_pgsql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy only composer files for cache optimization
COPY composer.json composer.lock ./

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP dependencies (skip scripts initially)
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-progress

# Copy rest of the application files
COPY . .

# Run post-install composer scripts (optional, allow failure)
RUN composer run-script post-autoload-dump || true

# Set correct permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Change Apache document root to Laravel public/
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Optionally ensure proper .htaccess handling
RUN echo "<Directory /var/www/html/public>\n\
    AllowOverride All\n\
</Directory>" >> /etc/apache2/apache2.conf

# Expose port 80
EXPOSE 80

# Start Apache in foreground
CMD ["apache2-foreground"]

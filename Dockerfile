FROM php:8.2-apache

# Install dependencies including libpq-dev for PostgreSQL
RUN apt-get update && apt-get install -y \
    libzip-dev libpq-dev zip unzip \
    && docker-php-ext-install zip pdo pdo_mysql pdo_pgsql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory inside container
WORKDIR /var/www/html

# Copy composer files first for caching
COPY composer.lock composer.json ./

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-progress

# Copy the rest of the application files
COPY . .

# Run composer scripts (if any) after full copy
RUN composer run-script post-autoload-dump || true

# Set correct permissions (storage and bootstrap cache)
RUN chown -R www-data:www-data storage bootstrap/cache

# Set Apache document root to 'public'
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Expose port 80
EXPOSE 80

CMD ["apache2-foreground"]

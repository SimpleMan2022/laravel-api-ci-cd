# Dockerfile
FROM php:8.3-fpm

# Set working directory
WORKDIR /var/www/laravel-api

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    curl

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents
COPY . /var/www/laravel-api

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/laravel-api \
    && chown -R www-data:www-data /var/www/laravel-api/storage /var/www/laravel-api/bootstrap/cache

# Expose port 9000 and run php-fpm
EXPOSE 9000
CMD ["php-fpm"]

FROM php:8.2-fpm

# Update and install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    wget \
    libicu-dev \
    libpq-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl pdo_pgsql pgsql \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug opcache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && wget https://get.symfony.com/cli/installer -O - | bash \
    && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

# Copy configuration files
COPY ./docker/php/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
COPY ./docker/php/docker-php-ext-opcache.ini /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini

# Copy Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy entrypoint script and make it executable
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Set PHP server name for IDE config and work directory
ENV PHP_IDE_CONFIG="serverName=localhost"
WORKDIR /var/www

# Expose port for PHP-FPM
EXPOSE 8000

# Set entrypoint and default command
ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]

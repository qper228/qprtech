FROM php:7.4-cli

# Install system packages and PHP extensions
RUN apt-get update && apt-get install -y \
    libsqlite3-dev libicu-dev unzip git curl sqlite3 \
    libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_sqlite intl gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer

WORKDIR /var/www/html
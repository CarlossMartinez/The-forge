FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    libonig-dev \
    libcurl4-openssl-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /back-forge

COPY back-forge/composer.json back-forge/composer.lock ./

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

COPY back-forge ./

RUN chown -R www-data:www-data /back-forge/storage /back-forge/bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]

FROM php:8.3-fpm

# Instalar extensiones necesarias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copiar proyecto
WORKDIR /app
COPY . .

# Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Generar APP_KEY
RUN php artisan key:generate

# Exponer puerto
EXPOSE 8080

# Comando de inicio
CMD php artisan serve --host=0.0.0.0 --port=8080
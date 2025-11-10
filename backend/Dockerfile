FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensiones de PHP
RUN docker-php-ext-install \
    pdo_mysql \
    zip \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar directorio de trabajo
WORKDIR /var/www/symfony

# Copiar archivos del proyecto
COPY . .

# Instalar dependencias SIN ejecutar scripts
RUN composer install --no-interaction --optimize-autoloader --no-scripts

# Permisos para carpetas cache y logs
RUN chmod -R 777 var/ 2>/dev/null || true

EXPOSE 9000

CMD ["php-fpm"]

FROM php:8.2-apache

# 1. Instalar dependencias del sistema y extensiones PHP
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Instalar Composer globalmente
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. Directorio de trabajo del contenedor
WORKDIR /var/www/html

# 4. Copiar SOLO los archivos del backend (incluyendo los generados por Laravel)
COPY backend/ .

# 5. Instalar dependencias de PHP (sin dev)
RUN composer install --optimize-autoloader --no-dev

# 6. Configurar permisos para Laravel
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# 7. Configurar Apache para que apunte al directorio público de Laravel
COPY backend/apache.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# 8. Exponer puerto e iniciar Apache
EXPOSE 80
CMD ["apache2-foreground"]
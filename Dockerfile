# Utiliza la imagen oficial de PHP con Apache
FROM php:8-apache

# Instala las extensiones de PHP y dependencias necesarias
RUN apt-get update \
    && apt-get install -y \
        libonig-dev \
        libzip-dev \
        zip \
        unzip \
        git \
        libmcrypt-dev \
        libpq-dev \
        libxml2-dev \
    && docker-php-ext-install \
        pdo_mysql \
        mysqli \
        mbstring \
        zip \
        pcntl \
        bcmath \
        soap \
        intl

# Instalar Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Habilitar Apache mod_rewrite
RUN a2enmod rewrite

# Configurar virtual host de Apache
COPY vhost.conf /etc/apache2/sites-available/000-default.conf

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Exponer puerto
EXPOSE 8080

# Entrypoint
CMD ["apache2-foreground"]

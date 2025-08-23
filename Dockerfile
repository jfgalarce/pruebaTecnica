FROM php:8.2-apache

# Instalar extensiones y dependencias
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install intl mysqli pdo pdo_mysql

# Habilitar mod_rewrite (opcional, útil para CI4)
RUN a2enmod rewrite

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && chmod +x /usr/local/bin/composer

# Copiar configuración Apache
COPY ./docker/vhost.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

# Script de inicio: crear proyecto si no existe y luego levantar Apache
COPY ./docker/start.sh /start.sh
RUN chmod +x /start.sh

CMD ["/start.sh"]
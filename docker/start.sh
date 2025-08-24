#!/bin/bash
set -e

cd /var/www/html

# Instalar dependencias si no existe vendor/
if [ ! -d "vendor" ]; then
    echo "Instalando dependencias con Composer..."
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

# Esperar un poco a que MySQL esté listo
echo "Esperando MySQL..."
sleep 10

# Ejecutar migraciones si existe spark
if [ -f "spark" ]; then
    php spark migrate --all
fi

# Levantar Apache en primer plano
exec apache2-foreground primer plano
apache2-foreground

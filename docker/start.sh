#!/bin/bash

# Crear proyecto CodeIgniter si no existe
if [ ! -f "spark" ]; then
    composer create-project codeigniter4/appstarter .
fi

# Esperar un poco a que MySQL esté listo
echo "Esperando MySQL..."
sleep 10

# Ejecutar migraciones si spark existe
if [ -f "spark" ]; then
    php spark migrate --all
fi

# Levantar Apache en primer plano
apache2-foreground
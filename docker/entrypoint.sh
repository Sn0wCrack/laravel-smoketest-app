#!/bin/sh

# Ensure PHP-FPM socket directory exists
mkdir -p /var/run/php
chown www-data:www-data /var/run/php

# Run migrations if needed
php artisan migrate --force

# Start PHP-FPM
php-fpm -D

# Start Nginx
exec nginx -g "daemon off;"

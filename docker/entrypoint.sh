#!/bin/sh

# Run migrations if needed
php artisan migrate --force

# Start PHP-FPM
php-fpm -D

# Start Nginx
exec nginx -g "daemon off;"

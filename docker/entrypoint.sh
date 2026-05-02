#!/bin/sh

if [ "${DISABLE_MIGRATIONS:-false}" != "false" ]; then
    # Run migrations if needed
    php artisan migrate --force
fi

# Start PHP-FPM
php-fpm -D

# Start Nginx
exec nginx -g "daemon off;"

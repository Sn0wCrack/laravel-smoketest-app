#!/usr/bin/env bash

if [[ "${DISABLE_MIGRATIONS:-0}" != "1" ]]; then
    # Run migrations if needed
    php artisan migrate --force
fi

# Start PHP-FPM
php-fpm -D

# Start Nginx
exec nginx -g "daemon off;"

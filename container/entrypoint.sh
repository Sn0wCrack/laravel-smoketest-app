#!/usr/bin/env bash

if [[ "${DISABLE_MIGRATIONS:-0}" != "1" ]]; then
    # Run migrations if needed
    php artisan migrate --force
fi

if [[ "${DISABLE_OPTIMIZE:-0}" != "1" ]]; then
    php artisan optimize
fi

# Start PHP-FPM
php-fpm -D

# Start Nginx
exec nginx -g "daemon off;"

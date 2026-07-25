# Build argument for PHP version
ARG PHP_VERSION=8.4

# Stage 1: Get Dependencies
FROM docker.io/library/php:${PHP_VERSION}-fpm AS dependencies

# Install system dependencies
RUN apt-get update -y \
    && curl -fsSL https://deb.nodesource.com/setup_26.x | bash - \
    && apt-get install -y \
        git \
        unzip \
        curl \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libonig-dev \
        libxml2-dev \
        libzip-dev \
        libicu-dev \
        mariadb-client \
        nodejs \
    && docker-php-ext-install \
        pdo_mysql \
        mbstring \
        xml \
        bcmath \
        intl \
        zip \
        gd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=docker.io/library/composer:2.10.2 /usr/bin/composer /usr/bin/composer

# Stage 2: Build
FROM dependencies as build

# Set working directory
WORKDIR /app

# Copy application code
COPY . .

# Install PHP dependencies, Node Dependencies, Build and Set Permissions
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist && \
    npm ci --ignore-scripts && npm run build && \
    mkdir -p /app/storage/app/private /app/storage/app/public /app/storage/framework/cache/data /app/storage/framework/sessions /app/storage/framework/testing /app/storage/framework/views && \
    chown -R www-data:www-data /app/storage /app/bootstrap/cache && \
    chmod -R 755 /app/storage /app/bootstrap/cache

# Stage 3: Production stage with Nginx
FROM dependencies AS production

# Install Nginx
RUN apt-get update -y \
    && apt-get install -y nginx \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copy built application from build stage
COPY --from=build --chown=www-data:www-data /app /app

# Copy Nginx and PHP configuration configuration
COPY container/php-fpm/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY container/nginx/default.conf /etc/nginx/sites-available/default
COPY container/entrypoint.sh /usr/local/bin/entrypoint.sh

# Ensure PHP-FPM socket directory exists
RUN ln -sf /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default \
    && mkdir -p /var/run/php && chown www-data:www-data /var/run/php \
    && chmod +x /usr/local/bin/entrypoint.sh

# Set working directory
WORKDIR /app

# Expose port 80
EXPOSE 80

# Run entrypoint
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

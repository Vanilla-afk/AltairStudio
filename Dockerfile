FROM php:8.3-cli

WORKDIR /var/www/html

# System dependencies + PHP extensions needed for Laravel with Postgres.
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpq-dev \
    libzip-dev \
    zip \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_pgsql zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist
RUN if [ -f package-lock.json ]; then npm ci; else npm install; fi && npm run build
RUN mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 10000

CMD ["sh", "-lc", "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}"]

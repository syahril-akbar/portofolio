FROM php:8.4-cli-alpine

# System deps + PHP extensions (sqlite, mbstring, zip, gd utk dompdf)
RUN apk add --no-cache git zip unzip libzip-dev oniguruma-dev sqlite \
        libpng-dev libjpeg-turbo-dev freetype-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_sqlite mbstring zip gd

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# PHP deps (tanpa dev)
RUN composer install --no-dev --no-interaction --optimize-autoloader --prefer-dist

# Build aset frontend
RUN apk add --no-cache nodejs npm \
    && npm install --no-audit --no-fund \
    && npm run build \
    && rm -rf node_modules

# Initialize storage volume
RUN mkdir -p /app/storage/app/public storage/logs storage/framework/cache/data storage/framework/sessions storage/framework/views
RUN chmod -R 775 storage bootstrap/cache \
    && chmod +x start.sh

EXPOSE 8000
CMD ["./start.sh"]

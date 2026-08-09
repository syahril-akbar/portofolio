#!/bin/sh
set -e

cd /app

# Generate app key if missing
php -r "file_exists('.env') || copy('.env.example', '.env');"
php artisan key:generate --no-interaction --force

# Run migrations
php artisan migrate --force

# Cache config & routes
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Link storage
php artisan storage:link --force

# Start server
php artisan serve --host=0.0.0.0 --port=8000

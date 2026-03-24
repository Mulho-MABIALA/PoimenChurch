#!/bin/bash
set -e

# Clear and rebuild Laravel caches with real env vars
php artisan config:clear
php artisan route:clear
php artisan view:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force

# Fix permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Start Apache
apache2-foreground

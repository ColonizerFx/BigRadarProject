#!/bin/sh
set -e

touch database/database.sqlite

php artisan package:discover --ansi
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force

exec php artisan serve --host=0.0.0.0 --port=${PORT:-10000}

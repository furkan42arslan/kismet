#!/bin/sh
set -eu

APP_ROOT=/var/www/html

mkdir -p \
    "$APP_ROOT/storage/app/private" \
    "$APP_ROOT/storage/app/public" \
    "$APP_ROOT/storage/framework/cache" \
    "$APP_ROOT/storage/framework/sessions" \
    "$APP_ROOT/storage/framework/views" \
    "$APP_ROOT/storage/logs" \
    "$APP_ROOT/database/migrations"

cp -rn /opt/kismet-migrations/. "$APP_ROOT/database/migrations/"

if [ ! -f "$APP_ROOT/database/database.sqlite" ]; then
    touch "$APP_ROOT/database/database.sqlite"
fi

chmod 777 "$APP_ROOT/database/database.sqlite"
chown -R www-data:www-data "$APP_ROOT/storage" "$APP_ROOT/database"

php artisan migrate --force
php artisan db:seed --force
php artisan storage:link || true
php artisan optimize

exec "$@"

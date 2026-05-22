#!/bin/bash

mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs
mkdir -p bootstrap/cache

chmod -R 775 storage bootstrap/cache

php artisan optimize:clear
php artisan storage:link || true

service nginx start
php-fpm -F
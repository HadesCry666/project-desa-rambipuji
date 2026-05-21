#!/bin/bash

php artisan optimize:clear
php artisan storage:link || true

service nginx start
php-fpm -F
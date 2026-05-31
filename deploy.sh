#!/bin/bash

set -e

echo "===================================="
echo "Mulai deploy Laravel Docker"
echo "===================================="

cd /var/www/semester6

echo "Set safe directory Git..."
git config --global --add safe.directory /var/www/semester6

echo "Ambil kode terbaru dari GitHub..."
git fetch origin main
git reset --hard origin/main

echo "Pastikan file .env tersedia..."
if [ ! -f .env ]; then
    echo "File .env tidak ditemukan!"
    echo "Buat file .env dulu di VPS."
    exit 1
fi

echo "Build dan jalankan semua container..."
docker compose up -d --build

echo "Install dependency Composer..."
docker compose exec -T app composer install --no-dev --optimize-autoloader --no-interaction

echo "Install dan build asset frontend..."
docker compose exec -T app npm install
docker compose exec -T app npm run build

echo "Buat folder storage Laravel dan perbaiki permission..."
docker compose exec -T -u root app sh -lc "
mkdir -p storage/app/public/foto_profil
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs
mkdir -p bootstrap/cache

chown -R www-data:www-data storage bootstrap/cache
chmod -R ug+rwX storage bootstrap/cache
"

echo "Generate APP_KEY hanya jika belum ada..."
docker compose exec -T app sh -lc '
if ! grep -q "^APP_KEY=base64:" .env; then
    php artisan key:generate --force
else
    echo "APP_KEY sudah ada, skip generate."
fi
'

echo "Jalankan migration database..."
docker compose exec -T app php artisan migrate --force

echo "Buat ulang storage link..."
docker compose exec -T -u root app sh -lc "
rm -rf public/storage
php artisan storage:link
chown -R www-data:www-data storage bootstrap/cache public/storage
chmod -R ug+rwX storage bootstrap/cache public/storage
find storage/app/public -type d -exec chmod 775 {} \;
find storage/app/public -type f -exec chmod 664 {} \;
"

echo "Clear cache Laravel..."
docker compose exec -T app php artisan optimize:clear

echo "Optimize Laravel..."
docker compose exec -T app php artisan optimize

echo "Perbaiki permission setelah optimize..."
docker compose exec -T -u root app sh -lc "
chown -R www-data:www-data storage bootstrap/cache public/storage
chmod -R ug+rwX storage bootstrap/cache public/storage
find storage/app/public -type d -exec chmod 775 {} \;
find storage/app/public -type f -exec chmod 664 {} \;
"

echo "Restart container agar perubahan aman..."
docker compose restart app nginx

echo "Cek status container..."
docker compose ps

echo "===================================="
echo "Deploy selesai"
echo "===================================="
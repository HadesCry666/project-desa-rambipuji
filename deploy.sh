#!/bin/bash

set -e

echo "===================================="
echo "Mulai deploy Laravel Docker"
echo "===================================="

cd /var/www/semester6

echo "Set safe directory Git..."
git config --global --add safe.directory /var/www/semester6

echo "Hapus lock Git jika ada..."
rm -f .git/FETCH_HEAD
rm -f .git/index.lock

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

echo "Buat folder storage Laravel..."
docker compose exec -T app mkdir -p storage/framework/cache
docker compose exec -T app mkdir -p storage/framework/sessions
docker compose exec -T app mkdir -p storage/framework/views
docker compose exec -T app mkdir -p storage/logs
docker compose exec -T app mkdir -p bootstrap/cache

echo "Atur permission Laravel..."
docker compose exec -T app chown -R www-data:www-data storage bootstrap/cache
docker compose exec -T app chmod -R 775 storage bootstrap/cache

echo "Install dependency Composer..."
docker compose exec -T app composer install --no-dev --optimize-autoloader --no-interaction

echo "Install dan build asset frontend..."
docker compose exec -T app npm install
docker compose exec -T app npm run build

echo "Generate APP_KEY jika belum ada..."
docker compose exec -T app php artisan key:generate --force || true

echo "Jalankan migration database..."
docker compose exec -T app php artisan migrate --force

echo "Buat storage link..."
docker compose exec -T app php artisan storage:link || true

echo "Clear cache Laravel..."
docker compose exec -T app php artisan optimize:clear

echo "Optimize Laravel..."
docker compose exec -T app php artisan optimize

echo "Restart container agar perubahan aman..."
docker compose restart app nginx

echo "Cek status container..."
docker compose ps

echo "===================================="
echo "Deploy selesai"
echo "===================================="
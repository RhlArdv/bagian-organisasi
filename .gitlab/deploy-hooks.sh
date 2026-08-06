#!/bin/bash
# ==============================================================================
#  .gitlab/deploy-hooks.sh
#  Custom Deployment Hooks for Laravel
# ==============================================================================
set -eu

echo "[HOOK] Memastikan APP_KEY tersedia..."
if ! grep -q "^APP_KEY=base64:" .env; then
    docker compose exec -T app php artisan key:generate || true
fi

echo "[HOOK] Memaksa update konfigurasi database ke MySQL (mengganti sisa SQLite lama)..."
sed -i 's/^DB_CONNECTION=.*/DB_CONNECTION=mysql/g' .env || true
sed -i 's/^DB_HOST=.*/DB_HOST=bagian-organisasi_db/g' .env || true

# Paksa isi DB_PASSWORD dengan secret (karena container MySQL diset secret di docker-compose)
sed -i 's/^DB_PASSWORD=.*/DB_PASSWORD=secret/g' .env || true

echo "[HOOK] Menghapus cache config agar perubahan .env terbaca..."
docker compose exec -T app php artisan config:clear || true

echo "[HOOK] Menyesuaikan permission folder public..."
chmod -R o+rX public

echo "[HOOK] Membuat symbolic link untuk storage..."
docker compose exec -T app php artisan storage:link || true

echo "[HOOK] Menunggu database siap (15 detik)..."
sleep 15

# Di Staging: fresh migrate + seed agar database selalu bersih setiap deploy
# Di Production: hanya migrate biasa (tanpa fresh/seed)
if [ -n "${STAGING_APP_URL:-}" ]; then
    echo "[HOOK] Staging — menjalankan migrate:fresh --seed (reset total database)..."
    docker compose exec -T app php artisan migrate:fresh --seed --force
else
    echo "[HOOK] Production — menjalankan migrasi database (incremental)..."
    docker compose exec -T app php artisan migrate --force
fi

echo "[HOOK] Mengoptimalkan cache Laravel..."
docker compose exec -T app php artisan config:cache
docker compose exec -T app php artisan route:cache
docker compose exec -T app php artisan view:cache
docker compose exec -T app php artisan event:cache

echo "[HOOK] Reload php-fpm worker (SIGUSR2, tanpa restart container)..."
docker compose exec -T app sh -c 'kill -USR2 1' || true

echo "[HOOK] Merestart queue worker..."
docker compose exec -T app php artisan queue:restart || true

#!/bin/sh
# Skrip start untuk Railway: migrasi database, tautan storage, lalu jalankan server.
set -e

php artisan package:discover --ansi || true

# Tunggu database siap (Railway menjalankan MySQL sebagai layanan terpisah)
i=0
until php artisan migrate --force; do
    i=$((i+1))
    if [ "$i" -ge 15 ]; then
        echo "Migrasi gagal setelah beberapa percobaan. Periksa variabel DB_* di Railway."
        exit 1
    fi
    echo "Database belum siap, mencoba lagi dalam 4 detik ($i/15)..."
    sleep 4
done

php artisan storage:link --force || true

# Isi data awal (admin + contoh produk) hanya bila RUN_SEED=true.
# Setelah deploy pertama berhasil, ubah RUN_SEED menjadi false.
if [ "$RUN_SEED" = "true" ]; then
    php artisan db:seed --force
fi

exec php artisan serve --host=0.0.0.0 --port="${PORT:-8080}"

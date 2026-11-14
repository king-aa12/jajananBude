# Image untuk Railway (juga bisa dipakai di hosting lain yang mendukung Docker)
FROM php:8.3-cli

RUN apt-get update \
    && apt-get install -y --no-install-recommends git unzip libzip-dev \
    && docker-php-ext-install pdo_mysql zip \
    && rm -rf /var/lib/apt/lists/*

# Batas unggah foto produk (aplikasi membatasi 2 MB)
RUN printf "upload_max_filesize=4M\npost_max_size=8M\nmemory_limit=256M\n" > /usr/local/etc/php/conf.d/uploads.ini

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Pasang dependensi lebih dulu agar build berikutnya lebih cepat
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --no-progress --no-scripts --prefer-dist

COPY . .
RUN composer dump-autoload --optimize --no-dev --no-scripts \
    && mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && chmod -R 777 storage bootstrap/cache \
    && sed -i 's/\r$//' docker/start.sh

# Beberapa proses sekaligus untuk server bawaan PHP
ENV PHP_CLI_SERVER_WORKERS=4

CMD ["sh", "docker/start.sh"]

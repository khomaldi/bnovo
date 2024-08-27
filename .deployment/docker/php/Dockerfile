FROM php:8.3.10-fpm-alpine3.19

COPY --from=composer:2.7.8 /usr/bin/composer /usr/local/bin/composer

WORKDIR /app

RUN apk add --no-cache autoconf g++ make linux-headers zlib-dev libpng-dev git postgresql-dev && \
    docker-php-ext-install opcache pdo pdo_pgsql && \
    apk del autoconf g++ make && \
    rm -rf /var/cache/apk/*

# syntax=docker/dockerfile:1

# ---------------------------------------------------------------------------
# Yalabikoglu & Co. — production image
#
# Built for Render's free web service, which gives an ephemeral filesystem and
# an injected $PORT. Everything that must survive a restart lives in Postgres
# (hosted separately) rather than on disk.
#
# Stages:
#   base    — PHP with the extensions this app needs
#   vendor  — Composer dependencies, resolved against that exact PHP
#   assets  — compiled CSS/JS and self-hosted fonts
#   final   — FrankenPHP serving public/
# ---------------------------------------------------------------------------

# ---------------------------------------------------------------------------
# Stage 1: PHP base
#
# pdo_pgsql for Postgres, gd/exif for the media library, intl for locale
# formatting (Filament requires it), zip for Composer archives, opcache for
# throughput. Composer resolves against this same image so a missing extension
# fails the build here rather than at runtime.
# ---------------------------------------------------------------------------
FROM dunglas/frankenphp:php8.4 AS base

RUN install-php-extensions \
        pdo_pgsql \
        gd \
        intl \
        zip \
        exif \
        bcmath \
        opcache

# ---------------------------------------------------------------------------
# Stage 2: PHP dependencies
# ---------------------------------------------------------------------------
FROM base AS vendor

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock ./

# Install without scripts first: artisan is not here yet, so package discovery
# would fail. --no-dev keeps test and tooling packages out of production.
RUN composer install \
        --no-dev \
        --no-scripts \
        --no-autoloader \
        --prefer-dist \
        --no-interaction

COPY . .

# .dockerignore excludes bootstrap/cache so the local package manifest (built
# against dev dependencies) never reaches the image. package:discover needs the
# directory to exist to write a fresh one.
RUN mkdir -p bootstrap/cache     && composer dump-autoload --no-dev --optimize --classmap-authoritative

# ---------------------------------------------------------------------------
# Stage 3: front-end assets
# ---------------------------------------------------------------------------
FROM node:22-alpine AS assets

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

# Tailwind scans the Blade templates to decide which utilities to emit, and
# resources/css/app.css has an @source pointing into vendor/, so the build
# needs both the application source and the installed packages.
COPY --from=vendor /app/vendor ./vendor
COPY . .

RUN npm run build

# ---------------------------------------------------------------------------
# Stage 4: runtime
# ---------------------------------------------------------------------------
FROM base AS final

WORKDIR /app

COPY --from=vendor /app/vendor ./vendor
COPY . .
COPY --from=assets /app/public/build ./public/build

# The framework needs these writable. On Render they are ephemeral: anything
# written here is gone on the next deploy or restart.
RUN mkdir -p storage/framework/cache/data \
             storage/framework/sessions \
             storage/framework/views \
             storage/logs \
             bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

COPY docker/entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint

# FrankenPHP binds whatever SERVER_NAME points at. The entrypoint rewrites it
# from $PORT, which the platform injects at runtime.
ENV SERVER_NAME=:8080
EXPOSE 8080

ENTRYPOINT ["entrypoint"]
CMD ["frankenphp", "run", "--config", "/etc/frankenphp/Caddyfile"]

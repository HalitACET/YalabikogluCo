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

# The official image grants the frankenphp binary cap_net_bind_service so it
# can bind ports 80/443. Platforms that run containers with every capability
# dropped (Render does) refuse to exec a binary carrying file capabilities, and
# the container dies with "exec: frankenphp: Operation not permitted". We listen
# on the unprivileged $PORT, so strip the capability. Copying the file drops its
# extended attributes, which is where the capability lives.
RUN cp /usr/local/bin/frankenphp /tmp/frankenphp \
    && mv /tmp/frankenphp /usr/local/bin/frankenphp \
    && chmod 755 /usr/local/bin/frankenphp

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

# package:discover boots the framework, which wants somewhere to compile views
# and a place for the package manifest. Git does not track empty directories and
# .dockerignore strips the contents of these anyway, so create them here rather
# than rely on whatever happens to exist in the build context. Without this the
# build fails on a clean clone with "Please provide a valid cache path".
RUN mkdir -p bootstrap/cache              storage/framework/views              storage/framework/cache/data              storage/framework/sessions              storage/logs     && composer dump-autoload --no-dev --optimize --classmap-authoritative

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
    && chmod -R 775 storage bootstrap/cache
# Left owned by root, the user the container runs as. Handing them to www-data
# only works while root keeps CAP_DAC_OVERRIDE; on a platform that drops every
# capability, root cannot write to directories it does not own.

COPY docker/entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint

# FrankenPHP binds whatever SERVER_NAME points at. The entrypoint rewrites it
# from $PORT, which the platform injects at runtime.
ENV SERVER_NAME=:8080
EXPOSE 8080

ENTRYPOINT ["entrypoint"]
CMD ["frankenphp", "run", "--config", "/etc/frankenphp/Caddyfile"]

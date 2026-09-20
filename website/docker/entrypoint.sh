#!/bin/sh
set -e

# ---------------------------------------------------------------------------
# Runtime boot for the production container.
#
# Caching happens here rather than at build time on purpose: the config cache
# freezes environment variables into a file, and those values only exist once
# the platform injects them into the running container.
#
# Order matters. CACHE_STORE is the database, so anything that touches the
# cache has to wait until migrations have created the table — that includes
# `optimize:clear`, which is why it is not called here. The image ships without
# a bootstrap cache (see .dockerignore), so there is nothing stale to clear.
# ---------------------------------------------------------------------------

# Render injects $PORT. FrankenPHP binds whatever SERVER_NAME points at; a
# leading colon with no host means "all interfaces, no TLS", which is right
# behind the platform's own TLS termination.
export SERVER_NAME=":${PORT:-8080}"

echo "==> Running migrations"
php artisan migrate --force --no-interaction

# Both seeders are idempotent: AdminUserSeeder uses updateOrCreate, and
# DatabaseSeeder returns early once content exists. Running them on every boot
# means a fresh database is usable immediately, and an existing one is left
# alone apart from keeping the admin account in step with the environment.
echo "==> Seeding"
php artisan db:seed --force --no-interaction

echo "==> Caching config, routes and views"
php artisan config:cache
php artisan route:cache
php artisan view:cache

# public/storage -> storage/app/public, for media library uploads. The target
# is ephemeral on Render, so uploads do not survive a restart; see DEPLOY.md.
php artisan storage:link --force || true

echo "==> Starting FrankenPHP on ${SERVER_NAME}"
exec "$@"

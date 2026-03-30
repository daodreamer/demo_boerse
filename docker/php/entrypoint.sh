#!/bin/sh
set -e

# Clear and warm up Symfony cache using the APP_ENV injected by Docker
php bin/console cache:clear --no-debug
php bin/console cache:warmup --no-debug

# Run migrations only when explicitly requested.
# In production with multiple replicas, set RUN_MIGRATIONS=false and run
# migrations as a one-shot container before scaling up the fleet.
if [ "${RUN_MIGRATIONS:-false}" = "true" ]; then
    php bin/console doctrine:migrations:migrate --no-interaction
fi

# Ensure var/ is writable (bind-mount may change ownership in dev)
chown -R "$(id -u):$(id -g)" var/ 2>/dev/null || true

# Replace shell with PHP-FPM as PID 1 so signals (SIGTERM, SIGINT)
# are delivered directly for graceful shutdown
exec "$@"

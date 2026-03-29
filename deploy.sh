#!/bin/bash
set -e

DEPLOY_DIR="${DEPLOYMENT_TARGET:-/home/site/wwwroot}"
echo "=== Azure post-deploy: $DEPLOY_DIR ==="
cd "$DEPLOY_DIR"

# Symfony cache
echo "Warming Symfony cache..."
php bin/console cache:clear --env=prod --no-warmup
php bin/console cache:warmup --env=prod

# Database migration
echo "Running migrations..."
php bin/console doctrine:migrations:migrate --no-interaction --env=prod

echo "=== Done ==="

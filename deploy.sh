#!/bin/bash
set -e

echo "=== Azure Deployment Script ==="
DEPLOY_DIR="${DEPLOYMENT_TARGET:-/home/site/wwwroot}"
cd "$DEPLOY_DIR"

# --- PHP dependencies ---
echo "Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# --- Node.js / Frontend ---
if ! command -v node &>/dev/null; then
    echo "Installing Node.js..."
    curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
    apt-get install -y nodejs
fi

echo "Building frontend..."
cd "$DEPLOY_DIR/frontend"
npm ci
npm run build

echo "Copying frontend build to public/..."
cp -r dist/* "$DEPLOY_DIR/public/"
cd "$DEPLOY_DIR"

# --- Symfony cache ---
echo "Warming up Symfony cache..."
php bin/console cache:clear --env=prod --no-warmup
php bin/console cache:warmup --env=prod

# --- Database migration ---
echo "Running database migrations..."
php bin/console doctrine:migrations:migrate --no-interaction --env=prod

echo "=== Deployment complete ==="

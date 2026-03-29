#!/bin/bash
set -e

echo "=== Azure Deployment Script ==="

# --- PHP dependencies ---
echo "Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# --- Frontend build ---
echo "Building frontend..."
cd frontend
npm ci
npm run build
cd ..

# Copy built assets to public/
echo "Copying frontend build to public/..."
cp -r frontend/dist/* public/

# --- Symfony ---
echo "Clearing Symfony cache..."
php bin/console cache:clear --env=prod --no-warmup
php bin/console cache:warmup --env=prod

# --- Database migration ---
echo "Running database migrations..."
php bin/console doctrine:migrations:migrate --no-interaction --env=prod

echo "=== Deployment complete ==="

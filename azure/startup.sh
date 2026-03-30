#!/bin/bash
set -e
cd /home/site/wwwroot

echo "=== PHP extensions loaded ==="
php -m | grep -E 'pdo|pdo_mysql|intl' || echo "WARNING: pdo_mysql or intl may be missing"

echo "=== Clearing Symfony cache ==="
php bin/console cache:clear --env=prod --no-debug 2>&1 || true

echo "=== Installing assets ==="
php bin/console assets:install public --env=prod --no-debug 2>&1 || true

echo "=== Applying Nginx config ==="
cp /home/site/wwwroot/azure/nginx.conf /etc/nginx/sites-available/default
service nginx reload

echo "=== Startup complete ==="

#!/bin/bash
set -e
cd /home/site/wwwroot

echo "=== PHP extensions loaded ==="
php -m | grep -E 'pdo|pdo_mysql|intl' || echo "WARNING: pdo_mysql or intl may be missing"

echo "=== SSL cert directory check ==="
ls /etc/ssl/certs/ | grep -i isrg || echo "WARNING: ISRG cert not found in /etc/ssl/certs/"
ls /etc/ssl/certs/ | wc -l

echo "=== PDO SSL constant values ==="
php -r "echo 'MYSQL_ATTR_SSL_CA=' . PDO::MYSQL_ATTR_SSL_CA . PHP_EOL; echo 'MYSQL_ATTR_SSL_VERIFY_SERVER_CERT=' . PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT . PHP_EOL;"

echo "=== SSL cert file check ==="
ls -la /home/site/wwwroot/config/ssl/isrgrootx1.pem && echo "Cert file OK" || echo "ERROR: cert file missing!"



echo "=== Clearing Symfony cache ==="
php bin/console cache:clear --env=prod --no-debug 2>&1 || true

echo "=== Installing assets ==="
php bin/console assets:install public --env=prod --no-debug 2>&1 || true

echo "=== Applying Nginx config ==="
cp /home/site/wwwroot/azure/nginx.conf /etc/nginx/sites-available/default
service nginx reload

echo "=== Startup complete ==="

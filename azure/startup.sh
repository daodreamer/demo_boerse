#!/bin/bash
cd /home/site/wwwroot
php bin/console cache:clear --env=prod --no-debug 2>&1 || true
cp /home/site/wwwroot/azure/nginx.conf /etc/nginx/sites-available/default
service nginx reload

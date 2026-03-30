#!/bin/bash
# Custom Oryx build script for Azure App Service.
# Replaces Oryx's default PHP/Symfony build to avoid running cache:warmup
# during build — pdo_mysql is not installed in the Oryx build container.
# cache:clear and assets:install are handled in azure/startup.sh at runtime.
set -e
composer install --no-dev --optimize-autoloader --no-scripts

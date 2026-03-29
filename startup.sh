#!/bin/bash
# Azure App Service Linux (PHP) startup script
# Set this as the startup command in Azure Portal → Configuration → General Settings

echo "=== Starting application ==="

# Point Apache DocumentRoot to Symfony public/
cp /etc/apache2/sites-available/000-default.conf /tmp/000-default.conf.bak
cat > /etc/apache2/sites-available/000-default.conf <<'EOF'
<VirtualHost *:80>
    DocumentRoot /home/site/wwwroot/public

    <Directory /home/site/wwwroot/public>
        AllowOverride All
        Require all granted
        FallbackResource /index.php
    </Directory>

    ErrorLog /dev/stderr
    CustomLog /dev/stdout combined
</VirtualHost>
EOF

# Enable mod_rewrite
a2enmod rewrite

# Restart Apache
service apache2 restart || apache2ctl restart

echo "=== Application started ==="

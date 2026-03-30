# =============================================================================
# Stage 1: Composer dependency installer
# =============================================================================
FROM composer:2 AS composer-deps

WORKDIR /app

# Copy only dependency manifests first for better layer caching
COPY composer.json composer.lock symfony.lock ./

# --no-scripts: mirrors build.sh pattern — pdo_mysql unavailable at build time,
# so cache:clear and assets:install must NOT run here
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-scripts \
    --no-interaction \
    --prefer-dist

# =============================================================================
# Stage 2: PHP-FPM production runtime
# =============================================================================
FROM php:8.3-fpm-alpine AS php-prod

# Install system dependencies required to compile PHP extensions
RUN apk add --no-cache \
    icu-dev \
    oniguruma-dev

# Compile and enable extensions
# ctype and iconv are already compiled into php:8.3-fpm-alpine
RUN docker-php-ext-install \
    pdo_mysql \
    intl \
    opcache

# Copy custom PHP and FPM configuration
COPY docker/php/php.ini-prod /usr/local/etc/php/conf.d/app.ini
COPY docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf

# Create non-root user (UID 1000 matches nginx container user for shared volume access)
RUN addgroup -g 1000 appgroup \
    && adduser -u 1000 -G appgroup -s /bin/sh -D appuser

WORKDIR /var/www/html

# --- Copy files ordered from least-changing to most-changing for layer cache ---

# SSL certificate must be at this EXACT path — doctrine.yaml hardcodes:
# %kernel.project_dir%/config/ssl/isrgrootx1.pem
COPY config/ssl/ config/ssl/

# Configuration and source
COPY composer.json composer.lock ./
COPY config/ config/
COPY migrations/ migrations/
COPY src/ src/
COPY bin/ bin/
COPY symfony.lock ./

# Base env files (no secrets — .env.local is excluded by .dockerignore)
COPY .env .env.prod ./

# Symfony front controller only — SPA assets are served by Nginx, not PHP-FPM
COPY public/index.php public/index.php

# Vendor directory from Composer stage
COPY --from=composer-deps /app/vendor vendor/

# Create writable runtime directories and set ownership
RUN mkdir -p var/cache var/log var/share \
    && chown -R appuser:appgroup var/ \
    && chown -R appuser:appgroup public/

# Copy and register entrypoint
# sed removes potential Windows CRLF line endings that break #!/bin/sh on Alpine
COPY docker/php/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN sed -i 's/\r//' /usr/local/bin/entrypoint.sh \
    && chmod +x /usr/local/bin/entrypoint.sh

USER appuser

EXPOSE 9000

ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]

# MySQL + Nginx + 云端部署计划

## Context

当前 `ApiController.php` 的所有数据均为硬编码 PHP 数组。为提升 demo 质量，需要：
1. 引入 MySQL 数据库，通过 Doctrine ORM 管理数据
2. 部署到真实云端服务器（免费）
3. 用 Docker Compose 容器化整个应用，避免在服务器上手动安装环境
4. 配置 Nginx + PHP-FPM 生产环境
5. 设置 GitHub Actions 自动部署流水线

---

## 云端方案推荐：Oracle Cloud Always Free

**为什么选 Oracle Cloud：**
- **VM**：Ampere ARM A1 实例，最高 4 OCPU + 24GB RAM，永久免费（业界最慷慨的免费 tier）
- **MySQL**：MySQL HeatWave Free Tier，50GB 存储，永久免费
- 两者在同一 VPC 内通信，无网络费用
- 需要绑定信用卡验证身份，但不会自动扣费（Always Free 标签保证）

**备选（无需信用卡）：TiDB Cloud Serverless**
- MySQL 兼容，25GB 免费，无需信用卡
- 仅作为数据库，仍需单独的免费 VPS（Fly.io 或 Railway）

---

## Phase A：本地 Doctrine ORM 集成

### A1：安装依赖

```bash
composer require symfony/orm-pack          # Doctrine ORM + Bundle + DBAL
composer require symfony/maker-bundle --dev  # make:entity, make:migration
composer require doctrine/doctrine-migrations-bundle
```

新增配置文件：
- `config/packages/doctrine.yaml`
- `config/packages/doctrine_migrations.yaml`
- `migrations/` 目录

### A2：环境变量

**`.env`（本地开发，不提交）：**
```
DATABASE_URL="mysql://root:password@127.0.0.1:3306/boerse_demo?serverVersion=8.0&charset=utf8mb4"
```

**`.env.dev`（已提交）：** 只写占位符，不含真实密码

---

## Phase B：数据库表设计

### 扁平化表（直接映射现有数组）

| Entity 类 | 表名 | 主要字段 |
|---|---|---|
| `TickerItem` | `ticker_items` | name, price, change_pct, bullish, sort_order |
| `MarketIndex` | `market_indices` | name, price, change_pct, bullish, sparkline, sort_order |
| `NewsItem` | `news_items` | image_url, category, published_at, title, excerpt, style |
| `Expert` | `experts` | image_url, name, role, title, quote, published_at |
| `KonjunkturItem` | `konjunktur_items` | published_at, title, sort_order |
| `AnlagestrategItem` | `anlagestrategen` | badge, title, author, sort_order |
| `GruppeNewsItem` | `gruppe_news` | label, title, link_label, sort_order |
| `AktienNewsItem` | `aktien_news` | published_at, title, sort_order |
| `MostSearchedItem` | `most_searched` | name, search_count, sort_order |
| `IndizesRow` | `indizes_rows` | name, aktuell, pkt, pct, bullish, high52, low52, sort_order |
| `DevisenRow` | `devisen_rows` | pair, kurs, pct, bullish, sort_order |
| `RohstoffRow` | `rohstoffe_rows` | name, kurs, pct, bullish, sort_order |
| `TopFlopItem` | `tops_flops` | name, change_pct, sparkline, type (ENUM: top/flop), sort_order |
| `ServiceItem` | `service_items` | name, description, cta, icon, sort_order |

### 结构稍复杂的表

| Entity 类 | 表名 | 说明 |
|---|---|---|
| `FondsStripFund` | `fonds_strip_funds` | name, thes_price, thes_change, thes_bullish, aussh_price, aussh_change, aussh_bullish, sort_order |
| `FondsCategory` | `fonds_categories` | name, fund_count, top_performer, ytd, bullish |
| `FondsNewsItem` | `fonds_news` | published_at, title |
| `DerivateCategory` | `derivate_categories` | name, icon, description, product_count |
| `DerivateProduct` | `derivate_products` | name, issuer, bid, ask, change_pct, bullish |
| `EtfCategory` | `etf_categories` | name, etf_count, example, ter, aum |
| `EtfProduct` | `etf_products` | name, isin, price, change_pct, bullish, ytd |
| `EurexFuture` | `eurex_futures` | name, expiry, last_price, change_pct, pct, bullish, volume |
| `EurexOption` | `eurex_options` | name, expiry, last_price, iv, volume |
| `WissenCategory` | `wissen_categories` | title, icon, sort_order |
| `WissenArticle` | `wissen_articles` | category_id (FK), title, sort_order |

### JSON 列（复杂嵌套，不值得拆分为关系表）

| Entity 类 | 表名 | JSON 字段 |
|---|---|---|
| `HeroStory` | `hero_stories` | 全部字段（单行）或 image_url, tag, headline, lead 普通列 |
| `FeaturedStock` | `featured_stocks` | 所有字段（单行）|
| `TagesPanel` | `tagestrends_panels` | tab_id, bullish, high, low, line (SVG path), stocks (JSON array) |
| `TagesTab` | `tagestrends_tabs` | row_index, tab_id, label |
| `BcdiItem` | `bcdi_items` | name, price, change_pct, bullish |
| `FondsStripGold` | `fonds_strip_gold` | price, change_pct, wkn, bullish（单行）|

### 关联关系

```
WissenCategory --< WissenArticle   (OneToMany)
TagesTab 独立表，tab_id 与 TagesPanel.tab_id 对应（非 FK，松耦合）
```

---

## Phase C：Repository + ApiController 重构

### C1：Repository 结构

```
src/Repository/
  TickerRepository.php
  MarketIndexRepository.php
  NewsItemRepository.php
  HomeDataRepository.php          ← 聚合查询，供 ApiController 使用
  ...（每个 Entity 对应一个）
```

`HomeDataRepository` 封装所有首页数据查询，注入 ApiController：

```php
class ApiController extends AbstractController {
    public function __construct(private HomeDataRepository $repo) {}

    #[Route('/api/home')]
    public function home(): JsonResponse {
        return $this->json($this->repo->getHomeData());
    }
}
```

### C2：数据 Seeder

新建 `src/Command/SeedDataCommand.php`（Symfony Console Command）：
- 读取现有硬编码数组
- 批量插入数据库
- 可重复执行（先清空再插入）

```bash
php bin/console app:seed-data
```

---

## Phase D：Docker 容器化

### D0：本地开发 Docker Compose

统一本地与生产环境，避免"在我机器上没问题"问题。

**文件结构：**
```
docker/
  nginx/
    default.conf          ← Nginx 配置
  php/
    Dockerfile            ← PHP-FPM 镜像（基于 php:8.3-fpm）
    php.ini               ← 生产调优配置
docker-compose.yml        ← 本地开发（含 MySQL 容器）
docker-compose.prod.yml   ← 生产覆盖（不含 MySQL，连外部 Oracle DB）
```

**`docker/php/Dockerfile`：**
```dockerfile
FROM php:8.3-fpm-alpine

RUN apk add --no-cache \
    nodejs npm git unzip \
    $PHPIZE_DEPS libpng-dev libzip-dev \
  && docker-php-ext-install pdo pdo_mysql zip opcache intl

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/demo

# OPcache 生产配置
COPY docker/php/php.ini /usr/local/etc/php/conf.d/app.ini
```

**`docker-compose.yml`（本地开发）：**
```yaml
services:
  php:
    build: { context: ., dockerfile: docker/php/Dockerfile }
    volumes:
      - .:/var/www/demo
    environment:
      - APP_ENV=dev
      - DATABASE_URL=mysql://boerse:secret@db:3306/boerse_demo?serverVersion=8.0

  nginx:
    image: nginx:1.25-alpine
    ports:
      - "8080:80"
    volumes:
      - .:/var/www/demo
      - ./docker/nginx/default.conf:/etc/nginx/conf.d/default.conf
    depends_on: [php]

  db:
    image: mysql:8.0
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: boerse_demo
      MYSQL_USER: boerse
      MYSQL_PASSWORD: secret
    volumes:
      - db_data:/var/lib/mysql
    ports:
      - "3306:3306"

volumes:
  db_data:
```

**`docker-compose.prod.yml`（生产覆盖）：**
```yaml
services:
  php:
    build:
      target: production           # 多阶段构建，不含 dev 工具
    volumes: []                    # 不挂载源码（镜像内已包含）
    environment:
      - APP_ENV=prod
      - DATABASE_URL=${DATABASE_URL}  # 从 .env.prod.local 读取

  nginx:
    ports:
      - "80:80"
      - "443:443"
    volumes:
      - ./docker/nginx/default.conf:/etc/nginx/conf.d/default.conf
      - /etc/letsencrypt:/etc/letsencrypt:ro  # SSL 证书挂载

  # 生产不启动 db 容器，连 Oracle Cloud MySQL HeatWave
```

### D0b：Dockerfile 多阶段构建（生产优化）

```dockerfile
# Stage 1: Build frontend
FROM node:20-alpine AS frontend-build
WORKDIR /app/frontend
COPY frontend/package*.json ./
RUN npm ci
COPY frontend/ .
RUN npm run build

# Stage 2: Production PHP image
FROM php:8.3-fpm-alpine AS production
RUN apk add --no-cache $PHPIZE_DEPS libzip-dev \
  && docker-php-ext-install pdo pdo_mysql zip opcache
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/demo
COPY . .
COPY --from=frontend-build /app/frontend/dist ./public/assets/
RUN composer install --no-dev --optimize-autoloader \
  && php bin/console cache:warmup --env=prod
```

**本地开发启动：**
```bash
docker compose up -d
docker compose exec php php bin/console app:seed-data
# 访问 localhost:8080
```

---

## Phase E（原D）：基础设施配置

### E1：Oracle Cloud 开通步骤（手动操作）

1. 注册 Oracle Cloud Free Tier：cloud.oracle.com
2. 创建 Compute Instance：
   - Shape: VM.Standard.A1.Flex（ARM）
   - OCPU: 2, RAM: 12GB（Always Free 限额内）
   - OS: Ubuntu 22.04
   - 生成 SSH 密钥对，保存私钥
3. 创建 MySQL HeatWave Database：
   - Version: 8.0
   - Username: boerse_admin
   - 在同一 VPC subnet 内
   - 记录内网 endpoint（如 10.0.0.x:3306）

### E2：服务器只需安装 Docker（一次性）

```bash
# Ubuntu 22.04 — 只需安装 Docker，其余全部容器化
curl -fsSL https://get.docker.com | sh
sudo usermod -aG docker ubuntu
sudo systemctl enable docker

# 部署目录
sudo mkdir -p /var/www/demo
sudo chown ubuntu:ubuntu /var/www/demo

# 克隆仓库
git clone https://github.com/daodreamer/demo_boerse.git /var/www/demo

# 创建生产环境变量（手动，不提交）
cat > /var/www/demo/.env.prod.local << 'EOF'
APP_ENV=prod
APP_SECRET=<强随机字符串>
DATABASE_URL="mysql://boerse_admin:PASSWORD@10.0.0.x:3306/boerse_demo?serverVersion=8.0&charset=utf8mb4"
EOF

# 首次启动
cd /var/www/demo
docker compose -f docker-compose.yml -f docker-compose.prod.yml up -d --build
docker compose exec php php bin/console doctrine:migrations:migrate --no-interaction
docker compose exec php php bin/console app:seed-data
```

### E3：Nginx 配置

**文件：** `docker/nginx/default.conf`（提交到 Git，容器挂载）

```nginx
server {
    listen 80;
    server_name YOUR_DOMAIN_OR_IP;
    root /var/www/demo/public;
    index index.php;

    # Gzip compression
    gzip on;
    gzip_types text/plain text/css application/json application/javascript;

    # Frontend static assets (Vite build output in public/)
    location ~* \.(js|css|png|jpg|svg|ico|woff2?)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
        try_files $uri =404;
    }

    # API routes → Symfony
    location /api {
        try_files $uri /index.php$is_args$args;
    }

    # Frontend SPA catch-all
    location / {
        try_files $uri $uri/ /index.html;
    }

    # PHP-FPM
    location ~ ^/index\.php(/|$) {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_split_path_info ^(.+\.php)(/.*)$;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        fastcgi_param DOCUMENT_ROOT $realpath_root;
        internal;
    }

    location ~ \.php$ { return 404; }
}
```

SSL：通过容器内 Certbot 或宿主机 `certbot certonly --standalone` 获取证书，挂载到 Nginx 容器。

### E4：服务器端 `.env.prod.local`（不提交，手动创建，见 E2）

---

## Phase F：GitHub Actions 自动部署

**新建** `.github/workflows/deploy.yml`

Docker 化后部署极简：服务器只需 `git pull` + `docker compose up --build`，
前端构建和 PHP 依赖安装全在 Docker 镜像内完成，无需在服务器上装 Node/Composer。

```yaml
name: Deploy to Production

on:
  push:
    branches: [master]

jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - name: Deploy via SSH
        uses: appleboy/ssh-action@v1
        with:
          host: ${{ secrets.PROD_HOST }}
          username: ${{ secrets.PROD_USER }}
          key: ${{ secrets.SSH_PRIVATE_KEY }}
          script: |
            set -e
            cd /var/www/demo
            git pull origin master
            docker compose -f docker-compose.yml -f docker-compose.prod.yml \
              up -d --build --remove-orphans
            docker compose exec -T php \
              php bin/console doctrine:migrations:migrate --no-interaction --env=prod
```

**GitHub Secrets 需要设置：**
- `PROD_HOST` — Oracle Cloud VM 公网 IP
- `PROD_USER` — ubuntu
- `SSH_PRIVATE_KEY` — Oracle Cloud 生成的 SSH 私钥

---

## 文件变更总表

| 文件/目录 | 操作 |
|---|---|
| `composer.json` / `composer.lock` | 新增 Doctrine 依赖 |
| `config/packages/doctrine.yaml` | 新建 |
| `config/packages/doctrine_migrations.yaml` | 新建 |
| `src/Entity/*.php` | 新建 ~25 个 Entity 类 |
| `src/Repository/*.php` | 新建对应 Repository 类 |
| `src/Repository/HomeDataRepository.php` | 新建聚合查询 |
| `src/Command/SeedDataCommand.php` | 新建数据填充命令 |
| `src/Controller/ApiController.php` | 重构：注入 HomeDataRepository |
| `migrations/` | 自动生成迁移文件 |
| `docker/php/Dockerfile` | 新建（多阶段构建）|
| `docker/nginx/default.conf` | 新建 |
| `docker/php/php.ini` | 新建（OPcache 调优）|
| `docker-compose.yml` | 新建（本地开发）|
| `docker-compose.prod.yml` | 新建（生产覆盖）|
| `.github/workflows/deploy.yml` | 新建 CI/CD |
| `.dockerignore` | 新建 |
| `.env.dev` | 更新 DATABASE_URL 占位符 |

---

## 实施顺序

1. Phase A — 本地安装 Doctrine（`composer require`）
2. Phase B — 创建所有 Entity 类，生成并运行迁移
3. Phase C — 编写 SeedDataCommand，重构 ApiController
4. Phase D — 编写 Docker 文件（Dockerfile、docker-compose.yml、nginx.conf）
5. 本地用 `docker compose up` 验证整个栈运行正常
6. Phase E — 开通 Oracle Cloud，服务器只装 Docker，首次手动部署
7. Phase F — 配置 GitHub Secrets，推送触发自动部署

---

## 验证

1. **本地（裸机）**：`php bin/console doctrine:schema:validate` 无错误
2. **本地（裸机）**：`php bin/console app:seed-data` 成功填充
3. **本地（裸机）**：`curl localhost:8000/api/home` 返回与原来相同结构的 JSON
4. **本地（Docker）**：`docker compose up -d` 启动后 `curl localhost:8080/api/home` 正常
5. **本地（Docker）**：`docker compose exec php php bin/console doctrine:schema:validate` 通过
6. **云端**：浏览器访问公网 IP，页面正常加载，Nginx 返回 200
7. **CD**：推送一个小改动到 master，Actions 自动执行 `docker compose up --build` 并完成迁移

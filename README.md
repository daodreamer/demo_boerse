# boerse-demo

A financial portal demo (boerse.de clone) built with Symfony 7 + React 19, deployed on Azure App Service with TiDB Cloud as the database.

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | PHP 8.3 · Symfony 7.4 · Doctrine ORM |
| Frontend | React 19 · TypeScript · Tailwind CSS 3 · Vite |
| Database | TiDB Cloud Serverless (MySQL 8.0 compatible) |
| Hosting | Azure App Service Linux (PHP 8.4) |
| Web server | Nginx (Azure: `azure/startup.sh` · Docker: `docker/nginx/default.conf`) |
| Containers | Docker Compose (php-fpm + nginx + mysql) |

## Architecture

```
Browser
  │
  ├── Static assets (JS/CSS/HTML) ──→ Nginx serves from public/
  │
  └── /api/* ──→ Nginx → PHP-FPM → Symfony Kernel
                                         │
                                    ApiController
                                         │
                                  Doctrine ORM → TiDB Cloud (SSL)
```

**Request flow:**
- All non-API routes fall through to `index.html` (SPA catch-all)
- `GET /api/home` returns a single JSON object with all page data
- Frontend fetches once on load via `hooks/useHomeData.ts`, renders React components

**Frontend structure:**
```
frontend/src/
  types/api.ts              ← TypeScript interfaces
  hooks/useHomeData.ts      ← data fetching
  hooks/useDarkMode.ts      ← dark mode (localStorage)
  components/layout/        ← GroupBar, TopNav, Sidebar, Footer
  components/               ← page section components
```

## Local Development

### Option A — Native (Laragon / PHP in PATH)

**Prerequisites:** PHP 8.3+, Composer, Node.js 20+

```bash
# Install dependencies
composer install
cd frontend && npm install && cd ..

# Terminal 1 — Symfony API
php -S localhost:8000 -t public/

# Terminal 2 — Vite (hot reload)
cd frontend && npm run dev
```

Open `http://localhost:5173`. Vite proxies `/api` → `localhost:8000` automatically.

After config changes:
```bash
php bin/console cache:clear
```

### Option B — Docker (production-like, no local PHP needed)

**Prerequisites:** Docker Desktop

```bash
docker compose up --build
```

- App: `http://localhost:8080`
- API: `http://localhost:8080/api/home`

`docker-compose.yml` runs `APP_ENV=prod`. Set `DATABASE_URL` to your TiDB Cloud connection string and `RUN_MIGRATIONS=false` (unless targeting an empty database).

## Environment Variables

| File | Purpose | Git tracked |
|------|---------|-------------|
| `.env` | Base placeholders (`APP_ENV=dev`, SQLite fallback) | Yes |
| `.env.local` | Local overrides: real `APP_SECRET` + TiDB credentials | **No** (gitignored) |
| `.env.prod` | Production safety net: `APP_ENV=prod`, `APP_DEBUG=0` | Yes |

Production secrets (DATABASE_URL, APP_SECRET) are set via **Azure App Service → Configuration → App Settings**, which take precedence over all `.env` files.

## Azure Deployment

**Stack on Azure:**
- Azure App Service Linux with PHP 8.4 runtime
- Nginx configured via `azure/nginx.conf` (applied by startup script)
- PHP-FPM on `127.0.0.1:9000`
- TiDB Cloud connected over SSL (`config/ssl/isrgrootx1.pem`)

**Deploy:**
```powershell
./push-azure.ps1   # builds frontend + git push to Azure remote
```

Or manually:
```bash
cd frontend && npm run build   # outputs to public/
cd ..
git add -A && git commit -m "..."
git push azure master
```

Azure runs `build.sh` (Oryx custom build) on each push:
```bash
composer install --no-dev --optimize-autoloader
# cache:warmup skipped — pdo_mysql unavailable in build container
```

Then `azure/startup.sh` runs on container start:
1. Validates PHP extensions (`pdo_mysql`, `intl`) and SSL cert
2. Clears Symfony cache (`--env=prod`)
3. Installs assets
4. Applies `azure/nginx.conf` and reloads Nginx

## Key Files

```
azure/
  nginx.conf          ← Nginx config (port 8080, SPA + API routing)
  startup.sh          ← Container startup script
build.sh              ← Oryx custom build hook
push-azure.ps1        ← Local deploy helper
config/
  packages/doctrine.yaml        ← Doctrine + TiDB SSL options
  ssl/isrgrootx1.pem            ← ISRG Root X1 cert for TiDB
.github/workflows/deploy.yml    ← CI (build check on push to master)
```

# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Dev Server

```bash
# Terminal 1 — Symfony API (run via Laragon Terminal, PHP must be in PATH)
php -S localhost:8000 -t public/

# Terminal 2 — Vite frontend
cd frontend
npm run dev        # dev server at http://localhost:5173
npm run build      # production build to frontend/dist/

# Clear Symfony cache after config changes
php bin/console cache:clear
```

> Vite proxies `/api` → `localhost:8000` automatically (configured in `frontend/vite.config.ts`).

## Docker (local production-like)

```bash
# Build and start all services (php-fpm + nginx + mysql)
docker compose up --build

# App available at http://localhost:8080
# API:  http://localhost:8080/api/home

# View logs
docker compose logs -f php

# Tear down (keep DB volume)
docker compose down
# Tear down and wipe DB
docker compose down -v
```

`docker-compose.yml` runs `APP_ENV=prod` with `--no-dev` vendor. Set `DATABASE_URL` in the compose file to point at TiDB Cloud (or leave as local MySQL for schema-only testing). Set `RUN_MIGRATIONS=true` only when targeting an empty database.

## Architecture

**Stack:** Symfony 7.4 (API only) · React 19 · TypeScript · Tailwind CSS 3 (Vite + PostCSS) · PHP 8.3 (via Laragon)

**Request flow:**
- API: `public/index.php` → `src/Kernel.php` → `src/Controller/ApiController.php` → JSON response
- Frontend: `frontend/src/main.tsx` → `App.tsx` → fetches `GET /api/home` → renders React components

**Data:** All page data is served from the database via Doctrine ORM. `HomeDataRepository` aggregates all entities and returns them as a single array. Dev uses a local `.env.local` `DATABASE_URL`; Docker uses the value injected via `docker-compose.yml`.

**API endpoint:** `GET /api/home` returns:
```
ticker, fondsStrip, marketIndices, heroStory, newsItems, tagestrends,
experts, events, analyses, topsFlops, mostSearched, featuredStock,
aktienNews, indizesTable, devisen, rohstoffe, konjunktur, anlagestrategen,
gruppeNews, fonds, derivate, etfs, eurex, wissen, service
```

**Frontend structure:**
```
frontend/src/
  types/api.ts              ← TypeScript interfaces for all API data
  hooks/useHomeData.ts      ← data fetching hook
  hooks/useDarkMode.ts      ← dark mode with localStorage
  components/layout/        ← GroupBar, TopNav, Sidebar, Footer
  components/               ← page section components
```

## Design System (from DESIGN.md)

- **No 1px borders** — use tonal background shifts. When a border is unavoidable, use the `ghost-border` utility (`border border-outline-variant/15`).
- **Surface hierarchy:** `bg-surface` (page) → `bg-surface-container-low` (section) → `bg-white` / `bg-surface-container-lowest` (cards).
- **Colors:** All tokens are defined in `frontend/tailwind.config.js`. Use token names (`text-primary`, `text-error`), never raw hex values.
- **Typography:** `font-headline` (Manrope) for h1–h4, `font-body` (Inter) for everything else.
- **Primary color** `#002655` (bullish), `#ba1a1a` (bearish/error). Never use high-saturation red/green.

## Tailwind

`frontend/tailwind.config.js` extends the default theme with a full Material Design 3 color palette. Content paths are `frontend/src/**/*.{ts,tsx}`. Custom component classes belong in `frontend/src/index.css` under `@layer components`.

# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project overview

Laravel 12 application ("Birge") combining a public marketing/portal frontend (Livewire + Blade) with a Filament 5 admin panel. There is no separate frontend framework — pages are server-rendered Livewire components.

## Common commands

```bash
# Local dev (Laravel server + queue worker + Vite, concurrently)
composer run dev

# Frontend assets
npm run dev          # Vite dev server / HMR
npm run build         # production build

# Tests
composer test                              # config:clear + php artisan test
php artisan test
vendor/bin/pest
php artisan test tests/Feature/Auth/AuthenticationTest.php   # single file
php artisan test --filter=authentication                     # by name
vendor/bin/pest tests/Unit

# Linting/formatting
vendor/bin/pint

# DB
php artisan migrate
php artisan db:seed     # seeds experts/articles/categories/telegram posts + admin user (ADMIN_EMAIL/ADMIN_PASSWORD); NOT idempotent — creates duplicates and wipes storage/app/public/media on rerun, never run against a populated prod DB
```

Tests run against in-memory SQLite (`pdo_sqlite` extension required) with array cache/session and sync queue, configured in `phpunit.xml` — no external services needed to run the suite locally.

## Architecture

**Two independent "apps" in one Laravel app:**
- **Public portal** — Livewire full-page components under `app/Livewire/Pages/Portal/*` (routed directly in `routes/web.php`, e.g. `IndexPage`, `ArticleListPage`, `ArticlePage`), plus auth pages under `app/Livewire/Pages/Auth/*` and account settings under `app/Livewire/Pages/Account/*`. Blade views live in the mirrored path under `resources/views/livewire/...`. Shared chrome is in `resources/views/layouts/portal.blade.php` / `layouts/account.blade.php` and `resources/views/components/*`.
- **Admin panel** — Filament 5, mounted at `/admin`, configured in `app/Providers/Filament/AdminPanelProvider.php`. Panel access is gated by `User::canAccessPanel()` (`app/Models/User.php`), which only allows the `admin` panel — there's no separate customer-facing panel. Resources auto-discovered from `app/Filament/Resources`; each resource follows the split-file Filament 5 layout: `<Name>Resource.php`, `Pages/{List,Create,Edit}<Name>.php`, `Schemas/<Name>Form.php`, `Tables/<Name>Table.php`.

**Multi-locale content model:** `Article` and `Expert` store translatable fields (`title`, `description`, `content`, `name`, etc.) as JSON casts to `array` (e.g. `'title' => 'array'`), keyed by locale (`ru`/`en`/`kk`). Read them via `getLocalizedValue($column)` on the model, which resolves `app()->getLocale()` with fallback to `ru`, then to the first available value — don't access these columns directly. UI-string translations (not content) live in `lang/{en,kk,ru}/portal.php`.

**Locale switching:** `POST /language` (see `routes/web.php`) stores the chosen locale in the session; `App\Http\Middleware\SetLocaleFromSession` (registered globally on the `web` middleware group in `bootstrap/app.php`) applies it on every subsequent request via `app()->setLocale()`.

**Media:** `Article` and `Expert` implement Spatie `HasMedia`/`InteractsWithMedia` (`spatie/laravel-medialibrary`, wired into Filament via `filament/spatie-laravel-media-library-plugin`).

**Telegram integration:** `POST /api/telegram/webhook` (`routes/api.php`) → `App\Http\Controllers\TelegramWebhookController`, which persists incoming `channel_post`/`message` updates as `TelegramPost` records, editable in the admin panel.

**Env file resolution for production:** the app deploys into a subfolder of the webroot (e.g. `/www`); `bootstrap/app.php` looks for `.env` one directory above the app root first (keeps it outside the served path) and only falls back to the in-app `.env` for local dev. Don't "fix" this by assuming a single `.env` location.

## Deployment

- `.github/workflows/deploy-landing.yml` (prod) **manual-trigger only** and `deploy-landing-dev.yml` (dev) deployed on push.
- CI builds the app (composer + npm) and ships only the built artifact over SFTP via `lftp`. No `--delete`: `.env`, uploaded media (`storage/app/public/media`), and the `public/storage` symlink must survive every redeploy untouched.
- The deploy SFTP account is chroot-only with no shell, so `artisan` commands can't run from the pipeline. After a deploy that changes migrations/config, an admin runs manually over SSH: `php artisan migrate --force` and `php artisan config:cache` (see `birge-ops/provision-new-stand/new-landing-stand.md` in the ops repo).

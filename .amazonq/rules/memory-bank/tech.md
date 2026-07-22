# DigiMart - Technology Stack

## Backend
- **PHP** ^8.2
- **Laravel** ^12.0
- **Laravel Tinker** ^2.10.1
- **php-flasher/flasher-laravel** ^2.6 — flash notification system
- **php-flasher/flasher-notyf-laravel** ^2.6 — Notyf toast adapter for flasher

## Frontend (Build)
- **Vite** ^7.0.7 with `laravel-vite-plugin` ^2.0.0
- **Tailwind CSS** ^3.1.0 with `@tailwindcss/forms` ^0.5.2
- **Alpine.js** ^3.4.2
- **Axios** ^1.11.0
- **PostCSS** + Autoprefixer
- Entry points: `resources/css/app.css`, `resources/js/app.js`

## Frontend (Static Assets — Admin Panel)
- **Tabler UI** — admin panel CSS/JS framework (in `public/assets/admin/`)
- **TinyMCE** — rich text editor (bundled in `public/assets/admin/libs/tinymce/`)

## Frontend (Static Assets — Public)
- Custom CSS/SASS/JS in `public/assets/frontend/`
- Font Awesome webfonts

## Testing
- **Pest** ^3.8 with `pestphp/pest-plugin-laravel` ^3.2
- **Mockery** ^1.6
- **Paratest** (parallel testing via `brianium/paratest`)
- PHPUnit config in `phpunit.xml`

## Dev Tools
- **Laravel Pint** ^1.24 — PHP code style fixer
- **Laravel Sail** ^1.41 — Docker dev environment
- **Laravel Pail** ^1.2.2 — log tailing
- **Laravel Breeze** ^2.4 — auth scaffolding (user area)
- **Laravel Boost** ^2.2 — dev utilities
- **Nunomaduro Collision** ^8.6 — error reporting

## Database
- Default: SQLite (`database/database.sqlite`)
- Supports MySQL/PostgreSQL via `config/database.php`
- Migrations: users, admins, cache, jobs tables

## Key Commands
```bash
# Setup
composer install && npm install
cp .env.example .env
php artisan key:generate
php artisan migrate

# Development (runs server + queue + vite concurrently)
composer run dev

# Or individually
php artisan serve
npm run dev

# Build for production
npm run build

# Tests
composer run test
# or
php artisan test
./vendor/bin/pest

# Code style
./vendor/bin/pint

# Seeding
php artisan db:seed
php artisan db:seed --class=Admin\\AdminSeeder
```

## Environment
- Auth guard default: `web` (configurable via `AUTH_GUARD` env)
- Auth model: configurable via `AUTH_MODEL` env
- File storage: `public` disk (symlink `storage/app/public` → `public/storage` via `php artisan storage:link`)

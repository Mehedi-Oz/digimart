# DigiMart

DigiMart is a Laravel 12 application with separate user and admin areas, authentication flows, profile management, and a storefront-style frontend foundation. The project is currently in an early development stage, so this repository documents the parts that are already in place and the areas that are still expected to grow.

## Quick Summary

- Public frontend homepage and authenticated user dashboard
- Dedicated admin panel with its own login, dashboard, and profile area
- Auth flows for login, registration, password reset
- Profile updates with avatar uploads for both users and admins

## Basic Setup

Install dependencies and start the project with the standard Laravel workflow:

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run dev
```

## Notes

This project is still in active development and not ready for use. Things will change, break, and grow.

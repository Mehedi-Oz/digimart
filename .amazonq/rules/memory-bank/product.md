# DigiMart - Product Overview

## Purpose
DigiMart is a Laravel 12 digital marketplace application. It provides a storefront-style platform with separate public, authenticated user, and admin areas. Currently in early/active development — not production-ready.

## Key Features

### Public Area
- Homepage with storefront sections: banner, featured products, categories, featured authors, selling products, counters, become-a-seller CTA
- Public-facing frontend layout with header, footer, and mobile menu

### User Area (authenticated)
- User registration, login, email verification, password reset
- User dashboard
- Profile management: update name, email, country, city, address
- Avatar upload with automatic old-avatar cleanup

### Admin Area
- Separate admin login at `/admin/login` (registration intentionally disabled)
- Admin password reset flow
- Admin dashboard at `/admin/dashboard`
- Admin profile management: update name, email, avatar
- Admin password update

## Target Users
- **End users**: Shoppers/sellers who register and manage their accounts on the marketplace
- **Admins**: Internal staff who manage the platform via the dedicated admin panel

## Current State
Early development. Auth flows and profile management are complete. Storefront homepage sections exist as view scaffolding. No product/order/payment features yet.

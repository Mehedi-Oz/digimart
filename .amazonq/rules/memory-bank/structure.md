# DigiMart - Project Structure

## Directory Overview

```
digimart/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Admin-area controllers (Auth/, ProfileController, DashboardController)
│   │   │   ├── Auth/           # User auth controllers (login, register, password reset)
│   │   │   └── Frontend/       # User-area controllers (HomeController, DashboardController, ProfileController)
│   │   ├── Middleware/         # Authenticate, RedirectIfAuthenticated
│   │   └── Requests/
│   │       ├── Admin/          # Admin form requests (ProfileUpdateRequest, PasswordUpdateRequest)
│   │       └── Frontend/       # User form requests (ProfileUpdateRequest, PasswordUpdateRequest)
│   ├── Models/
│   │   ├── Admin.php           # Admin model (separate auth guard)
│   │   └── User.php            # User model (default web guard)
│   ├── Services/
│   │   └── NotificationService.php  # Static flash notification helpers (CREATED, UPDATED, DELETED, ERROR)
│   ├── Traits/
│   │   └── FileUpload.php      # Reusable uploadFile / deleteFile methods
│   └── View/Components/
│       ├── Admin/              # InputText, InputTextArea, ImagePreview blade components
│       └── Frontend/           # InputText, InputSelect, ImagePreview blade components
├── config/
│   ├── auth.php                # Dual guards: web (users) + admin (admins)
│   └── countries.php           # Country list for profile select fields
├── database/
│   ├── migrations/             # users, admins, cache, jobs tables
│   └── seeders/
│       ├── Admin/AdminSeeder.php
│       └── Frontend/UserSeeder.php
├── public/
│   ├── assets/
│   │   ├── admin/              # Admin panel static assets (Tabler UI: CSS, JS, libs, TinyMCE)
│   │   └── frontend/           # Frontend static assets (CSS, JS, fonts, SASS, webfonts)
│   ├── defaults/avatar.png     # Default avatar fallback
│   └── uploads/
│       ├── admin/avatars/      # Uploaded admin avatars
│       └── frontend/avatars/   # Uploaded user avatars
├── resources/views/
│   ├── admin/                  # Admin blade views (auth, dashboard, layouts, profile)
│   ├── auth/                   # User auth blade views (Breeze-based)
│   ├── components/             # Shared blade components (admin/, frontend/, input-error, auth-session-status)
│   └── frontend/               # Frontend blade views (home sections, dashboard, layouts)
├── routes/
│   ├── web.php                 # User routes (home, dashboard, profile)
│   ├── admin.php               # Admin routes (login, dashboard, profile) — loaded separately
│   └── auth.php                # Breeze user auth routes
└── tests/
    ├── Feature/Auth/           # Auth feature tests (login, register, password reset, etc.)
    └── Feature/Admin/          # Admin feature tests
```

## Architectural Patterns

### Dual Authentication
Two completely separate auth guards:
- `web` guard → `User` model → routes in `web.php` + `auth.php`
- `admin` guard → `Admin` model → routes in `admin.php` with `/admin` prefix and `admin.` route name prefix

### Controller Namespacing
Controllers are namespaced by area: `App\Http\Controllers\Admin\*` and `App\Http\Controllers\Frontend\*`. Both areas mirror each other's structure (ProfileController, DashboardController, Auth/).

### Form Requests
Each area has its own `Requests/Admin/` and `Requests/Frontend/` namespaces with parallel request classes.

### Blade Component System
Reusable form components live in `app/View/Components/{Admin,Frontend}/` with corresponding blade templates in `resources/views/components/{admin,frontend}/`. Components handle label generation, error display, and attribute merging.

### Layout Pattern
Both admin and frontend use `@extends` / `@yield('content')` with a `master.blade.php` layout. Styles and scripts are extracted into `partials/styles.blade.php` and `partials/scripts.blade.php`.

### File Upload Pattern
The `FileUpload` trait is used by controllers that handle avatar uploads. Files are stored under `public` disk at `uploads/{area}/avatars/` with UUID filenames. Old files are deleted before uploading new ones (unless it's the default avatar).

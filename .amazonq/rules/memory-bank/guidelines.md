# DigiMart - Development Guidelines

## Other Rule Files (off by default — enable manually per task)

Only `guidelines.md` loads automatically. The files below are toggled off in the Rules panel to save tokens. Enable the relevant one before starting a task that needs it, then disable it again when done — Amazon Q cannot open these on its own just because they're mentioned here.

| File | Enable when... |
|---|---|
| `tech.md` | Task involves dependencies, build tooling, or environment/version questions |
| `structure.md` | Task involves unfamiliar folders or you need the full directory map |
| `product.md` | Task involves product/feature-scope questions, not code |
| `frontend-js.md` | Task touches frontend JS conventions |
| `graphify.md` | You're running `/graphify` build or query commands |
| `tooling.md` | RTK-specific troubleshooting needed |

## Required: Check Before Reading

**Before grepping or reading multiple files** to answer a "how does X connect to Y" / "where is X used" / "explain X" question: check whether `graphify-out/graph.json` exists (you can check this with a file read/list, not the Rules panel). If it exists but `graphify.md` isn't loaded in this session, tell the user to enable it in the Rules panel, then use it to query the graph instead of reading files. Only fall back to grep/read if the graph doesn't answer the question, or if `graphify-out/` doesn't exist. This check is required, not optional — do not skip it by default.

## PHP / Laravel Conventions

### Controller Pattern
- Controllers return typed `View` or `RedirectResponse` — always declare return types
- Use `Auth::guard('admin')->user()` for admin area, `Auth::user()` for frontend
- After mutations, always call `redirect()->back()` — never redirect to a named route from update actions
- Check `$user->isDirty()` before saving to skip unnecessary DB writes and notifications
- Use `$request->safe()->except('avatar')` when filling models to exclude file fields from mass assignment

### Model Conventions
- Define `DEFAULT_AVATAR` as a public constant on models that have avatars: `public const DEFAULT_AVATAR = 'defaults/avatar.png';`
- Always declare `$fillable`, `$hidden`, and `casts()` method (not `$casts` property)
- Password cast: `'password' => 'hashed'` in `casts()`
- Both `User` and `Admin` extend `Illuminate\Foundation\Auth\User as Authenticatable`

### Form Request Conventions
- Admin requests use array syntax for rules: `['required', 'string', 'max:255']`
- Avatar validation: `['sometimes', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:2048']`
- Always use `Rule::unique()->ignore($this->user()->id)` for email uniqueness in update requests
- `authorize()` always returns `true` — authorization is handled by middleware

### Routing Conventions
- Admin routes: `prefix('admin')->as('admin.')->middleware('guest:admin')` for guest, `middleware('auth:admin')` for protected
- Admin registration is intentionally disabled — do not add it
- User routes use `middleware(['auth', 'verified'])` group
- Route names follow `area.resource.action` pattern: `admin.profile.update`, `admin.dashboard`

### Notification Pattern
Always use `NotificationService` static methods for flash messages — never call `notyf()` directly in controllers:

```php
NotificationService::CREATED();   // "Created Successfully"
NotificationService::UPDATED();   // "Updated Successfully"
NotificationService::DELETED();   // "Deleted Successfully"
NotificationService::ERROR();     // "Something went wrong!"
// Custom message:
NotificationService::UPDATED('Profile saved.');
```

### File Upload Pattern
Use the `FileUpload` trait in any controller that handles file uploads:

```php
use App\Traits\FileUpload;

class MyController extends Controller
{
    use FileUpload;

    $path = $this->uploadFile($request->file('avatar'), 'frontend/avatars');
    $this->deleteFile($user->avatar);
}
```
- Files are stored at `uploads/{dir}/{uuid}.{ext}` on the `public` disk
- Always check `$user->avatar !== Model::DEFAULT_AVATAR` before deleting old avatar
- Only `public` and `local` disks are accepted — others throw `InvalidArgumentException`

## Blade / View Conventions

### Layout Pattern
Both areas use `@extends` / `@yield`:

```blade
@extends('admin.layouts.master')       {{-- admin --}}
@extends('frontend.layouts.master')   {{-- frontend --}}

@section('title') {{ __('Page Title') }} @endsection
@section('content') ... @endsection
```

### Blade Components
Use namespaced components — never raw HTML inputs in forms:

```blade
{{-- Admin components --}}
<x-admin.input-text name="name" :label="__('Full Name')" :value="$user->name" />
<x-admin.input-text type="email" name="email" :label="__('Email')" :value="$user->email" />
<x-admin.input-text type="password" name="password" :label="__('Password')" />
<x-admin.input-text type="file" name="avatar" :label="__('Update Avatar')" />
<x-admin.input-text-area name="bio" :label="__('Bio')" />
<x-admin.image-preview :src="$user->avatar" style="height:128px; width:128px;" />

{{-- Frontend components --}}
<x-frontend.input-text name="name" :label="__('Name')" :value="$user->name" />
<x-frontend.input-select name="country" :label="__('Country')" />
<x-frontend.image-preview :src="$user->avatar" />
```

### Form Structure (Admin)
Admin forms follow Tabler UI card structure:

```blade
<form class="card" action="{{ route('admin.resource.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card-body">
        <h3 class="card-title">{{ __('Section Title') }}</h3>
        <div class="row row-cards">
            <div class="col-md-6"> ... </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</form>
```

### Translations
Always wrap user-facing strings in `__()`. Never hardcode English strings directly in blade templates.

## Dual Auth Guard Rules
- Never use `Auth::user()` in admin controllers — always `Auth::guard('admin')->user()`
- Never use `auth()->user()` helper in admin area — use the facade with explicit guard
- Middleware for admin routes: `auth:admin` (protected) and `guest:admin` (login page)
- Password reset tokens share the same table (`password_reset_tokens`) for both guards

## Code Style
- PHP: PSR-4 autoloading, 4-space indentation, Laravel Pint for formatting
- Blade: 4-space indentation, CRLF line endings (admin views use CRLF)
- JS: 2-space indentation, `"use strict"`, jQuery-based (no ES modules in static assets)
- No inline comments explaining obvious code — use section delimiter comments in JS

## Laravel Skills

Whenever writing, reviewing, or refactoring any Laravel PHP code, consult `.agents/skills/`. Two skill sets are available — pick based on the concern:

| Skill | Path | Use When |
| ----- | ---- | -------- |
| `laravel-best-practices` | `.agents/skills/laravel-best-practices/` | Controllers, models, migrations, form requests, jobs, Eloquent, N+1, caching, validation, error handling, queues, routes, architecture, code reviews |
| `laravel-security` | `.agents/skills/laravel-security/` | Auth, gates/policies, mass assignment, SQL injection, CSRF, XSS, file upload security, rate limiting, secrets, API security, secure deployment |

**How to apply:**
1. Check existing patterns in sibling files first — follow what the codebase already does
2. Pick the skill(s) matching the concern and read before editing
3. Make the smallest coherent change — don't introduce a second pattern for the same job

### laravel-best-practices Rule Index

| Concern | File |
| ------- | ---- |
| Query count, eager loading, indexes, large datasets | `rules/db-performance.md` |
| Subqueries, aggregates, complex ordering | `rules/advanced-queries.md` |
| Models, relationships, scopes, casts | `rules/eloquent.md` |
| Form Requests and validation rules | `rules/validation.md` |
| Controllers, route binding, middleware | `rules/routing.md` |
| Schema changes, columns, FK, indexes | `rules/migrations.md` |
| Jobs, retries, uniqueness, batches | `rules/queue-jobs.md` |
| Cache lifetime, invalidation, locks | `rules/caching.md` |
| Outbound requests, retries, timeouts | `rules/http-client.md` |
| Exceptions, reporting, log context | `rules/error-handling.md` |
| Events and notifications | `rules/events-notifications.md` |
| Mailables and mail assertions | `rules/mail.md` |
| Scheduled tasks | `rules/scheduling.md` |
| Collections, lazy iteration, bulk ops | `rules/collections.md` |
| Blade components, attributes, composers | `rules/blade-views.md` |
| Environment values, config | `rules/config.md` |
| Pest patterns, factories, fakes | `rules/testing.md` |
| Naming, helpers, file boundaries, PHP style | `rules/style.md` |
| Actions, services, dependencies, structure | `rules/architecture.md` |

### laravel-security Rule Index

| Concern | File |
| ------- | ---- |
| Authentication, sessions, password hashing | `rules/auth.md` |
| Gates, policies, middleware authorization | `rules/authorization.md` |
| Mass assignment, SQL injection, attribute casting | `rules/eloquent-safety.md` |
| CSRF protection, XSS prevention, HTTP headers | `rules/csrf-xss.md` |
| Rate limiting, CORS, API authentication | `rules/api-security.md` |
| File upload validation and secure storage | `rules/file-uploads.md` |
| Secrets, .env hygiene, Composer audit | `rules/secrets-deps.md` |
| Queue security, logging sensitive events | `rules/queue-logging.md` |
| Quick pre-deploy security checklist | `rules/checklist.md` |

**Decision Rules:**
- Prefer framework features and existing abstractions over new helpers or dependencies
- Avoid speculative abstractions — extract only when it creates a clear domain boundary or removes meaningful duplication
- Keep database access out of Blade views — prevent hidden N+1 queries

---

## graphify (Knowledge Graph)

Full build/query syntax and docs: `.amazonq/rules/memory-bank/graphify.md` (enable it in the Rules panel first — see index at top of this file).

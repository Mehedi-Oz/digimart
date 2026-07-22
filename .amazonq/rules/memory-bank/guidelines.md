# DigiMart - Development Guidelines

## PHP / Laravel Conventions

### Controller Pattern
- Controllers return typed `View` or `RedirectResponse` — always declare return types
- Use `Auth::guard('admin')->user()` for admin area, `Auth::user()` for frontend
- After mutations, always call `redirect()->back()` — never redirect to a named route from update actions
- Check `$user->isDirty()` before saving to skip unnecessary DB writes and notifications
- Use `$request->safe()->except('avatar')` when filling models to exclude file fields from mass assignment

```php
public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = Auth::guard('admin')->user();
    $user->fill($request->safe()->except('avatar'));

    if ($request->hasFile('avatar')) {
        if ($user->avatar !== Admin::DEFAULT_AVATAR) {
            $this->deleteFile($user->avatar);
        }
        $user->avatar = $this->uploadFile($request->file('avatar'), 'admin/avatars');
    }

    if (!$user->isDirty()) {
        return redirect()->back();
    }

    $user->save();
    NotificationService::UPDATED();
    return redirect()->back();
}
```

### Model Conventions
- Define `DEFAULT_AVATAR` as a public constant on models that have avatars: `public const DEFAULT_AVATAR = 'defaults/avatar.png';`
- Always declare `$fillable`, `$hidden`, and `casts()` method (not `$casts` property)
- Password cast: `'password' => 'hashed'` in `casts()`
- Both `User` and `Admin` extend `Illuminate\Foundation\Auth\User as Authenticatable`

### Form Request Conventions
- Admin requests use array syntax for rules: `['required', 'string', 'max:255']`
- Frontend requests may use pipe syntax: `'required|string|max:255'` — prefer array syntax for new code
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

    // Upload: returns path string stored under public disk
    $path = $this->uploadFile($request->file('avatar'), 'frontend/avatars');

    // Delete: pass the stored path
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
Always wrap user-facing strings in `__()`: `{{ __('Profile') }}`, `{{ __('Update Profile') }}`. Never hardcode English strings directly in blade templates.

### Homepage Sections
Homepage sections are isolated partials included via `@include`:

```blade
@include('frontend.home.sections.banner')
@include('frontend.home.sections.category')
@include('frontend.home.sections.product')
```
Add new homepage sections as separate files in `resources/views/frontend/home/sections/`.

## JavaScript Conventions (Frontend)

### Structure
All frontend JS is wrapped in an IIFE with jQuery: `(function ($) { "use strict"; ... })(jQuery);`

All DOM-ready code goes inside `$(document).ready(function () { ... });`

### Event Handling
Use jQuery `.on()` — never inline handlers or `.click()`:

```js
$('.toggle-mobileMenu').on('click', function () { ... });
$('body').on('click', function () { ... });  // delegated/global dismiss
```

### Active State Pattern
Toggle UI states with `.addClass('active')` / `.removeClass('active')` / `.toggleClass('active')`:

```js
$('.mobile-menu').addClass('active');
$('.side-overlay').addClass('show');
$('body').addClass('scroll-hide-sm');
```

### Section Comments
Each JS section is wrapped in start/end comments:
```js
// ============================== Feature Name Js Start ==============================
// ... code ...
// ============================== Feature Name Js End ==============================
```

### Slider Configuration
Slick sliders use consistent arrow markup:
```js
prevArrow: '<button type="button" class="slick-prev"><i class="las la-arrow-left"></i></button>',
nextArrow: '<button type="button" class="slick-next"><i class="las la-arrow-right"></i></button>',
```
Always include `responsive` breakpoints: 1199, 991, 767, 575 (and 425 for very small).

### Guard Against Missing Elements
Before initializing plugins on optional elements, check existence:
```js
if (document.querySelector('.countdown')) { ... }
if ($('ul').length) { ... }
var chartElement = document.querySelector("#chart");
if (chartElement) { ... }
```

## Database / Migration Conventions
- Migrations use anonymous classes: `return new class extends Migration { ... }`
- Default avatar stored directly in DB: `$table->string('avatar')->default('defaults/avatar.png')`
- Always include `$table->rememberToken()` and `$table->timestamps()` on auth models
- Default DB connection is SQLite for local dev; switch to MySQL via `DB_CONNECTION` env var

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

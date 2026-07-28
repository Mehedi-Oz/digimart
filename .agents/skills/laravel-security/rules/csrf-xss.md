## CSRF Protection

### Default Protection

```php
// Laravel CSRF is enabled by default via VerifyCsrfToken middleware
// app/Http/Kernel.php (protected $middlewareGroups['web'])

// All POST/PUT/PATCH/DELETE forms must include @csrf
<form method="POST" action="/posts">
    @csrf
    <input type="text" name="title">
    <button type="submit">Create</button>
</form>
```

### Excluding Routes (Carefully)

```php
// app/Http/Middleware/VerifyCsrfToken.php
class VerifyCsrfToken extends Middleware
{
    // Only exclude routes that have external CSRF protection (webhooks, etc.)
    protected $except = [
        'stripe/*', // Stripe webhooks use their own signature verification
        // Avoid blanket 'api/*' — stateful Sanctum routes need CSRF.
        // Exclude only specific stateless webhook/endpoint routes.
    ];
}
```

### CSRF with JavaScript

```html
<meta name="csrf-token" content="{{ csrf_token() }}" />

<script>
    // Axios example (Laravel ships with Axios)
    axios.defaults.headers.common["X-CSRF-TOKEN"] = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    // Fetch example
    fetch("/posts", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    });
</script>
```

### JavaScript Context Escaping

```blade
{{-- SAFE: Blade @js escapes for JavaScript context --}}
<script>
    const user = @js($user); // JSON + escaped for JS context
    const settings = @json($settings); // Direct JSON encode
</script>

{{-- DANGEROUS: Manual JSON in JS context --}}
<script>
    const user = {{ json_encode($user) }}; // NOT escaped for JS!
</script>
```

### HTTP Headers for XSS Protection

```php
// App\Http\Middleware\SecurityHeaders.php
class SecurityHeaders
{
    public function handle(Request $request, Closure $next): mixed
    {
        $response = $next($request);

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set(
            'Content-Security-Policy',
            "default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data: https:; font-src 'self'; connect-src 'self'; frame-ancestors 'none'"
        );

        return $response;
    }
}

// Register in kernel
protected $middleware = [
    \App\Http\Middleware\SecurityHeaders::class,
];
```

## XSS Prevention

### Blade Templating Security

```blade
{{-- SAFE: Auto-escaped by Blade --}}
{{ $userInput }}

{{-- DANGEROUS: Raw output — NEVER use with user input --}}
{!! $userInput !!}

{{-- SAFE: Only use {!! !!} with trusted content you control --}}
{!! $trustedHtmlFromYourServer !!}

{{-- GOOD: Use specific escaping directives --}}
@js($data) {{-- JSON encode for JavaScript --}}
@json($data) {{-- JSON encode in templates --}}

{{-- BAD: Direct user input in raw HTML --}}
<div>{!! $user->bio !!}</div> {{-- VULNERABLE if user provides bio --}}
```

### Safe HTML Handling

```php
// When you must allow some HTML, use a whitelist approach
use HTMLPurifier; // Requires: composer require ezyang/htmlpurifier

public function sanitizeHtml(string $dirty): string
{
    $config = \HTMLPurifier_Config::createDefault();
    $config->set('HTML.Allowed', 'p,b,i,a[href],ul,ol,li,br');
    $config->set('URI.AllowedSchemes', ['http', 'https', 'mailto']);
    $purifier = new \HTMLPurifier($config);
    return $purifier->purify($dirty);
}

// In blade:
<div>{!! $sanitizedContent !!}</div> {{-- Safe after purification --}}
```

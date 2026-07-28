## Quick Security Checklist

| Check                               | Description                                                    |
| ----------------------------------- | -------------------------------------------------------------- |
| `APP_DEBUG=false`                   | Never run with debug enabled in production                     |
| `APP_KEY` set                       | Always run `php artisan key:generate`                          |
| HTTPS enforced                      | Force HTTPS in production via middleware or proxy              |
| `$fillable` whitelisted             | Never use `$guarded = []`                                      |
| CSRF active                         | `@csrf` on all state-changing forms                            |
| Sanctum/Passport configured         | API authentication with token abilities/scopes                 |
| Rate limiting applied               | Throttle API and auth endpoints                                |
| Input validation                    | FormRequest with specific rules, never `$request->all()`       |
| File upload restrictions            | Validate MIME types, size, dimensions                          |
| `composer audit` in CI              | Check dependencies for known vulnerabilities                   |
| `password_hash` / `password_verify` | Use Laravel's built-in hashing (bcrypt/Argon2)                 |
| Session regeneration on login       | Call `$request->session()->regenerate()`                       |
| Security headers middleware         | CSP, X-Frame-Options, X-Content-Type-Options                   |
| Logged security events              | Audit log for auth failures, role changes, suspicious activity |
| `.env` not committed                | Verify `.gitignore` includes `.env`                            |

## Related Skills

- `laravel-patterns` — Laravel architecture, routing, Eloquent, and API patterns
- `backend-patterns` — General backend API and database patterns
- `laravel-tdd` — Laravel testing with PHPUnit and Pest

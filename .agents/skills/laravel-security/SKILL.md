---
name: laravel-security
description: Laravel security best practices — authentication, authorization, Eloquent safety, CSRF, XSS prevention, API security, and secure deployment configurations.
metadata:
    origin: ECC
---

# Laravel Security

## When to Activate

- Setting up authentication and authorization (Sanctum, Passport, Breeze, Jetstream)
- Implementing user roles, permissions, and policies
- Configuring production security settings and environment variables
- Reviewing or auditing Laravel code for vulnerabilities
- Deploying to production
- Writing secure Eloquent queries and migrations

## Rule Index

| Concern                                           | Read                                                   |
| ------------------------------------------------- | ------------------------------------------------------ |
| Authentication, sessions, password hashing        | [`rules/auth.md`](rules/auth.md)                       |
| Gates, policies, middleware authorization         | [`rules/authorization.md`](rules/authorization.md)     |
| Mass assignment, SQL injection, attribute casting | [`rules/eloquent-safety.md`](rules/eloquent-safety.md) |
| CSRF protection, XSS prevention, HTTP headers     | [`rules/csrf-xss.md`](rules/csrf-xss.md)               |
| Rate limiting, CORS, API authentication           | [`rules/api-security.md`](rules/api-security.md)       |
| File upload validation and secure storage         | [`rules/file-uploads.md`](rules/file-uploads.md)       |
| Secrets, .env hygiene, Composer audit             | [`rules/secrets-deps.md`](rules/secrets-deps.md)       |
| Queue security, logging sensitive events          | [`rules/queue-logging.md`](rules/queue-logging.md)     |
| Quick pre-deploy security checklist               | [`rules/checklist.md`](rules/checklist.md)             |

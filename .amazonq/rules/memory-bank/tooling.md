# DigiMart - Tooling Conventions

## RTK (Command Output Compression)

RTK filters & compresses shell outputs (~80% token savings). Already installed & auto-active — Bash commands transparently rewritten.

Compression: Smart Filtering, Grouping, Truncation, Deduplication.

### Setup

```bash
rtk --version           # Verify installed
rtk gain                # View savings stats
# Restart VS Code to activate hook
```

### Auto-Rewrite Hook

Bash tool calls auto-rewritten before execution:

- `git status` → `rtk git status` (auto)
- `php artisan test` → `rtk php artisan test` (auto)
- `./vendor/bin/pint` → `rtk pint` (auto)

**Scope:** Bash tool calls only. Read/Grep/Glob bypass hook — use explicit `rtk` prefix for those.

### Explicit RTK Calls

```bash
rtk read app/Models/User.php               # Smart file read
rtk grep "pattern" app/                    # Grouped results
rtk find "*.php" tests/Feature             # Compact file list

# Compression levels
rtk php artisan test -u                    # Ultra-compact
rtk git log -v                             # Verbose
rtk proxy git status                       # Raw + tracking
```

### Prefer RTK Over Raw

- `rtk git status` instead of `git status`
- `rtk git diff` instead of `git diff`
- `rtk git log` instead of `git log`
- `rtk php artisan test` instead of `php artisan test`
- `rtk ./vendor/bin/pint` instead of `./vendor/bin/pint`

Fall back to raw commands only when RTK does not support the operation or would change required behavior.

### Configuration

RTK reads `~/.config/rtk/config.toml`.

```toml
[hooks]
exclude_commands = ["curl", "playwright"]  # Skip rewrite

[tee]
enabled = true          # Save full output on failure
mode = "failures"
```

### Troubleshooting

| Issue                    | Fix                                         |
| ------------------------ | ------------------------------------------- |
| `rtk: command not found` | `which rtk` or `~/.local/bin/rtk --version` |
| Hook not rewriting       | Restart VS Code (≥0.28.0 required)          |
| Windows no auto-rewrite  | Use WSL or explicit `rtk` calls             |
| `rtk gain` shows 0       | Check `rtk gain --history`                  |

**Docs:** https://rtk-ai.app/guide

# AGENTS.md — Kursus Hobi (Creative Precision Platform)

## Must-read sources (before any task)

- **Project spec:** `.agents/prd.md` — full PRD: features, DB schema, roles, workflows
- **Design system:** `.agents/design.md` — colors, typography, spacing, components, animations
- **Task checklist:** `.agents/task-instruction.md` — ordered task list; update `.agents/tasklist.md` after each completed task

## Stack

- **Laravel 13** (PHP ^8.3), **MySQL 8.0+** (default per PRD, not SQLite), **Tailwind CSS v4**, **Vite**
- Database-driven sessions, cache, and queue — migrations must run before the app works
- **No JS framework** — frontend interactivity uses Vanilla JavaScript (DOM manipulation for video playlist, star rating, theme toggle)

## Commands

| Command | What it does |
|---|---|
| `composer run setup` | Full first-time setup: install, .env, key, migrate, npm install, build |
| `composer run dev` | Starts 4 concurrent processes: `artisan serve`, `queue:listen`, `pail` (logs), `vite` |
| `composer run test` | Runs `config:clear` then `artisan test` |

**Quirk:** `composer run test` always clears config first. Use `php artisan test` to skip that.

## Architecture & conventions

- **RBAC:** 2 roles only — `role_id=1` Admin, `role_id=2` Peserta
- **Critical constraint:** Instruktur has NO login account — purely a data entity managed by Admin
- **Service Layer:** Business logic goes in `app/Services/` (not in controllers)
- **Dark/Light mode:** Toggle stores preference in `localStorage`; injects `.dark` class on `<body>`
- **File upload:** Proof-of-payment images (JPG/PNG/WEBP only, max 20 MB)
- **Pagination:** 8–12 items per page for course catalog and admin tables
- **Vanilla JS features:** Interactive star rating, video playlist without page reload, theme toggle
- **Routes:** `routes/web.php` (public + dashboard), admin routes under `/admin/*` with middleware guard
- **Models:** Use PHP 8 attributes (`#[Fillable]`, `#[Hidden]`) for model properties
- **Pint:** `./vendor/bin/pint` for PHP style fixes

## Testing

- PHPUnit 12 with Laravel test wrapper
- `tests/Feature/` (extend `Tests\TestCase`) and `tests/Unit/` (extend `PHPUnit\Framework\TestCase`)
- No CI workflows configured yet

## Notable configs

- `.npmrc` has `ignore-scripts=true` — npm lifecycle scripts don't run
- `.editorconfig`: 4-space indent, LF line endings
- Vite entry: `resources/css/app.css` (Tailwind v4 — `@tailwindcss/vite` plugin, no config file), `resources/js/app.js`
- Tailwind v4 theme customizations go in `app.css` via `@theme`/`@source` directives
- `.agents/task-instruction.md` specifies a **linear workflow**: setup → migrations → models → auth → backend features → security → frontend → polish

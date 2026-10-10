# Task Manager — Laravel Authentication & CRUD

A complete source-code project for the **Web Programming Lab Activity: Laravel Authentication & CRUD**. Uses Laravel 10 (PHP 8.1-compatible), Laravel Breeze-style Blade authentication screens, Tailwind CSS, and SQLite by default.

## Features

- Account **register, log in, and log out** (Laravel Breeze authentication workflow)
- Dashboard with task count and recent tasks
- Task CRUD: **Create, Read, Update, Delete**
- Validation, CSRF protection, authenticated resource routes
- Every task belongs to its creator: other users cannot read, edit, or delete it
- User profile editing, password changes, reset links (local log mailer), account deletion
- Blade and Tailwind responsive UI
- Laravel feature tests for CRUD, authentication, authorization, and validation

## Project layout

| File / directory | Purpose |
| --- | --- |
| `routes/web.php` | Dashboard and authentication-protected resource routes |
| `routes/auth.php` | Breeze-style authentication routes |
| `app/Models/Task.php` | Task Eloquent model and fillable attributes |
| `app/Models/User.php` | Authentication and user-to-tasks relationship |
| `app/Http/Controllers/TaskController.php` | Full resource controller for CRUD |
| `database/migrations/*create_tasks_table.php` | Tasks database table with owner reference |
| `resources/views/tasks/*.blade.php` | Task list, add, edit and view screens |
| `resources/views/auth/*.blade.php` | Breeze-style login, registration and reset screens |
| `tests/Feature/TaskCrudTest.php` | Automated tests for task actions and security |

## Requirements

- PHP **8.1 or newer** with `mbstring`, `openssl`, `pdo_sqlite`, `sqlite3`, `fileinfo`, `tokenizer`, `xml`, and `ctype` enabled
- Composer, Node.js and NPM
- Internet access during the first installation (for Composer and NPM packages)

### Automatic setup — Windows PowerShell

Open PowerShell in the project folder and run:

```powershell
powershell -ExecutionPolicy Bypass -File .\setup.ps1
```

The script creates `.env`, creates the SQLite database, installs Composer and NPM dependencies, generates the application key, builds the frontend assets, runs migrations, and attempts the automated tests. The script **does not install PHP/Composer/Node.js** themselves.

To open the app after setup:

```powershell
php artisan serve
```

Go to **http://127.0.0.1:8000**, register an account, then visit **My Tasks**.

### Automatic setup — Linux / macOS

```bash
bash setup.sh
php artisan serve
```

### Manual setup (alternative)

```bash
composer install
cp .env.example .env            # On Windows: Copy-Item .env.example .env
# Create a blank database/database.sqlite file
php artisan key:generate
npm install
npm run build
php artisan migrate
php artisan serve
```

### Test the project

```bash
php artisan test
```

Tests use an in-memory SQLite database (they do not delete your normal database).

## About Laravel Breeze

This repository includes **Breeze-compatible Blade authentication scaffolding** and `laravel/breeze` in `require-dev`. The UI and authentication controllers are already included, so there is **no need to rerun** `php artisan breeze:install blade` on top of this completed project; doing so may overwrite the included views. The setup matches the end goal of the activity (Laravel + Breeze-style authentication + protected CRUD). The classroom handout uses `breeze:install blade` when beginning from a completely empty Laravel app.

## Database

SQLite is the default. A real local MySQL server is **not required** for this project. The script creates `database/database.sqlite`; it stays untracked in Git, as does `.env`.

Table: `tasks` → `id`, `user_id`, `title`, `description`, `created_at`, `updated_at`.

## GitHub

The repository contains source files only. `vendor`, `node_modules`, `.env`, `database.sqlite`, and compiled assets are excluded from Git; install them on a development machine using `setup.ps1` or `setup.sh`.

## Lab alignment

The attached 3-page instructions include: new Laravel app, Breeze Blade auth, Task model `$fillable`, resource routes under `auth`, controller `index/store`, and task-list Blade view. This completed version also adds the **remaining CRUD functions (edit/update/delete)** and user-level authorization required for a safe, functional task manager.

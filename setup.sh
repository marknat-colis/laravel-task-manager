#!/usr/bin/env bash
set -euo pipefail
cd "$(dirname "$0")"
for cmd in php composer node npm; do
    command -v "$cmd" >/dev/null 2>&1 || { echo "Missing required command: $cmd" >&2; exit 1; }
done
php -m | grep -qi '^pdo_sqlite$' || { echo 'Enable the pdo_sqlite PHP extension first.' >&2; exit 1; }
[[ -f .env ]] || cp .env.example .env
[[ -f database/database.sqlite ]] || touch database/database.sqlite
composer install --no-interaction
if ! grep -Eq '^APP_KEY=base64:' .env; then php artisan key:generate --force; fi
npm install
npm run build
php artisan migrate --force
php artisan test
printf '\nSetup and tests completed. Start with: php artisan serve\n'

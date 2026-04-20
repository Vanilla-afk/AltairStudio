#!/usr/bin/env sh
set -e

# Validate APP_KEY format/length for Laravel encrypter.
if ! php -r '$k = getenv("APP_KEY") ?: ""; if ($k === "") { exit(1); } if (str_starts_with($k, "base64:")) { $raw = base64_decode(substr($k, 7), true); } else { $raw = $k; } if ($raw === false) { exit(1); } $len = strlen($raw); if (!in_array($len, [16, 32], true)) { exit(1); }'; then
  echo "APP_KEY is missing or invalid. Generating a runtime APP_KEY for this container."
  export APP_KEY="$(php artisan key:generate --show --no-interaction)"
fi

php artisan migrate --force
php artisan serve --host=0.0.0.0 --port="${PORT:-10000}"

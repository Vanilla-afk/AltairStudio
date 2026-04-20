# Deploying This Laravel App to Render

This repository is now configured with a Render Blueprint in `render.yaml`.

## 1) Push to GitHub

Render will deploy from your Git repository, so make sure your latest code (including `render.yaml`) is pushed.

## 2) Create Blueprint Deploy

1. Open Render Dashboard.
2. Click New + and select Blueprint.
3. Connect your GitHub repository.
4. Render should detect `render.yaml` automatically.
5. Create the services.

This blueprint provisions:

- 1 web service: `altairstudio-web` (Free plan)
- 1 Postgres database: `altairstudio-db` (Free plan)

## 3) Set Required Environment Values

`APP_KEY` is generated automatically by the blueprint.

After first deploy, set these manually in the web service Environment tab:

- `APP_URL`: your Render URL first, then your custom domain once connected

Optional production values (recommended):

- `MAIL_MAILER`
- `MAIL_HOST`
- `MAIL_PORT`
- `MAIL_USERNAME`
- `MAIL_PASSWORD`
- `MAIL_FROM_ADDRESS`
- `MAIL_FROM_NAME`
- `AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`, `AWS_BUCKET` (if using S3)

## 4) First Deploy Behavior

The web service build does:

- `composer install --no-dev --optimize-autoloader`
- `npm ci`
- `npm run build`
- Laravel cache warmup commands

Before each deploy, Render runs:

- `php artisan migrate --force`

Then it starts app with:

- `php artisan serve --host=0.0.0.0 --port=$PORT`

## 5) Important Free Plan Limits

- Web service spins down after ~15 minutes idle (cold starts on next request).
- Free Postgres expires after 30 days.
- Local filesystem is ephemeral (do not rely on local file uploads for long-term storage).

## 6) Recommended Upgrade Path (When Ready)

For real production usage, move at least these to paid plans:

- Web service instance (avoid spin-down and improve stability)
- Postgres instance (avoid 30-day expiration)

And move uploads to object storage (`FILESYSTEM_DISK=s3`).

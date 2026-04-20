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
- Health check path: `/up` (Laravel built-in health endpoint)

## 3) Set Required Environment Values

`APP_KEY` is generated automatically by the blueprint.

If you see `Unsupported cipher or incorrect key length`, your service has an invalid `APP_KEY` value. Set a valid key in Render Environment, for example:

- `base64:...` output from `php artisan key:generate --show`

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

Session note:

- Blueprint uses `SESSION_DRIVER=file` for Render Free to avoid requiring a `sessions` DB table.

## 4) First Deploy Behavior

Render builds your Docker image from `Dockerfile`.

Container startup runs:

- `php artisan migrate --force`
- `php artisan serve --host=0.0.0.0 --port=$PORT`

Note: Free tier does not support Blueprint `preDeployCommand`, so migrations run on startup.
Note: Laravel cache compilation is intentionally not run during image build to avoid baking stale environment values.
Note: `docker-start.sh` validates `APP_KEY` and auto-generates a runtime key only if the configured value is missing/invalid.

## 5) Important Free Plan Limits

- Web service spins down after ~15 minutes idle (cold starts on next request).
- Free Postgres expires after 30 days.
- Local filesystem is ephemeral (do not rely on local file uploads for long-term storage).

## 6) Recommended Upgrade Path (When Ready)

For real production usage, move at least these to paid plans:

- Web service instance (avoid spin-down and improve stability)
- Postgres instance (avoid 30-day expiration)

And move uploads to object storage (`FILESYSTEM_DISK=s3`).

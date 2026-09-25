# Deploying to Render

The site runs as a Docker container on Render's free web service, with Postgres
hosted separately on Neon.

## Why the database is not on Render

Render's free Postgres is **deleted 30 days after creation**, with a 14-day
grace period to upgrade. Putting the site's only database there would take it
down a month after launch. Neon's free tier suspends compute when you exceed
its limits but does not delete data on a timer, so the site keeps working.

## What the free tier costs you

Two things, both worth knowing before launch:

- **The service sleeps after 15 minutes of inactivity.** The first request
  afterwards waits for the container to boot — roughly 40–60 seconds, because
  the entrypoint runs migrations and warms the caches. For a site whose job is
  to convey professional credibility, this is the main argument for the paid
  instance ($7/month at time of writing), which does not sleep.
- **The filesystem is ephemeral.** Anything written to `storage/` is gone on
  the next deploy or restart. The photography in `public/images` is committed
  to the repository and therefore safe, but **images uploaded through the admin
  panel will not survive**. Fixing that means pointing the media library at
  object storage (Cloudflare R2 has a free tier) rather than the local disk.

---

## 1. Create the database (Neon)

1. Sign up at <https://neon.tech> and create a project. Pick a region close to
   the Render region — Frankfurt for both.
2. Copy the **connection string**. It looks like:

   ```
   postgresql://user:password@ep-something.eu-central-1.aws.neon.tech/dbname?sslmode=require
   ```

   Keep `?sslmode=require` — Neon refuses unencrypted connections.

## 2. Create the web service (Render)

1. Push this repository to GitHub.
2. At <https://dashboard.render.com> choose **New → Blueprint** and point it at
   the repository. Render reads `render.yaml` from the root and creates the
   service with the right runtime, region, root directory and health check.

   Without a blueprint: **New → Web Service**, connect the repo, then set
   *Runtime* to Docker, *Root Directory* to `website`, *Health Check Path* to
   `/up`, and *Instance Type* to Free.

## 3. Set the environment variables

`render.yaml` fills in the non-secret ones. Set the rest under
**Environment**:

| Variable | Value |
| --- | --- |
| `APP_KEY` | run `php artisan key:generate --show` and paste the whole value, `base64:` prefix included |
| `APP_URL` | the service URL, e.g. `https://yalabikoglu.onrender.com` |
| `DB_URL` | the Neon connection string from step 1 |
| `ADMIN_EMAIL` | admin panel login |
| `ADMIN_PASSWORD` | admin panel password |
| `CONTACT_EMAIL` | shown on the contact and privacy pages |
| `CONTACT_BOOKING_URL` | Calendly link behind the briefing buttons |

`APP_URL` must match the real URL. Laravel builds absolute URLs from it, so
`hreflang` tags and the Open Graph image will point at the wrong host if it is
stale. Come back and correct it once a custom domain is attached.

## 4. Deploy

Render builds the image and starts it. On boot the container runs migrations,
seeds the content if the database is empty, caches config, routes and views,
and starts FrankenPHP on the injected `$PORT`.

Both seeders are idempotent — `AdminUserSeeder` upserts, and `DatabaseSeeder`
returns early once content exists — so a restart never duplicates anything.
Changing `ADMIN_PASSWORD` and redeploying is how you rotate the admin password.

Verify:

- `https://<your-service>/up` returns `OK`
- the homepage renders with photography and the three proof points
- `https://<your-service>/admin/login` accepts `ADMIN_EMAIL` / `ADMIN_PASSWORD`
- the public pages still set **no cookies** (Network tab → any page → Response
  Headers → no `Set-Cookie`)

## 5. Custom domain

Add it under **Settings → Custom Domain** and create the CNAME Render gives
you. Then update `APP_URL` and redeploy.

### If you put Cloudflare in front

Cloudflare's bot management can set a `__cf_bm` cookie, which would make the
privacy page's "no cookies are set" claim untrue. Turn **Bot Fight Mode** off,
then confirm with a fresh browser profile that no cookie appears on a public
page. If one does, either disable the feature responsible or rewrite the
privacy page to match.

Because the public pages set no cookies, Cloudflare can cache the HTML itself,
which largely hides the free tier's cold starts from visitors.

---

## Running the production image locally

Useful for reproducing a deploy problem without pushing:

```bash
docker build -t yalabikoglu website/
docker run --rm -p 8080:8080 \
  -e PORT=8080 \
  -e APP_KEY="$(php website/artisan key:generate --show)" \
  -e APP_ENV=production -e APP_DEBUG=false \
  -e APP_URL=http://localhost:8080 \
  -e DB_CONNECTION=pgsql -e DB_URL="postgresql://..." \
  -e SESSION_DRIVER=database -e CACHE_STORE=database -e QUEUE_CONNECTION=database \
  -e ADMIN_EMAIL=you@example.com -e ADMIN_PASSWORD=secret \
  yalabikoglu
```

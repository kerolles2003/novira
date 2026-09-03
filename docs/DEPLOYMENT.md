# Novira Theme — Production Deployment Notes

These are the steps that must be done on the server / in WP admin. They cannot
live in theme code. Do them in order.

## 1. Build & upload the theme
```powershell
powershell -ExecutionPolicy Bypass -File build-production.ps1
```
Produces `..\novira-theme.zip` (~2 MB, forward-slash paths, dev files stripped).
Upload it via **Appearance → Themes → Add New → Upload Theme**, or unzip into
`wp-content/themes/novira-theme/` on Hostinger.

Never upload the working folder directly — it contains node_modules, design
PNGs, build scripts, and the CLI language tools (all excluded by the build).

## 2. WordPress admin settings
- **Settings → Reading →** UNCHECK "Discourage search engines from indexing"
  (`blog_public` must be `1`, or the whole site is noindexed).
- **Settings → Permalinks →** click Save once (flush rewrite rules so the
  force-routed landings and exam spokes resolve).
- Confirm the front page is set (Settings → Reading → static front page).

## 3. Create the legal / services pages (or leave them off)
The header/footer fallback links to `/services`, `/privacy`, `/terms` are now
guarded — they only render if the page exists. For SEO/E-E-A-T, create:
- **Privacy Policy** (slug `privacy`)
- **Terms** (slug `terms`)
- **Services** (slug `services`) — optional; a `page-services.php` template exists.

## 4. Microsoft Forms integration (optional)
`plugins/microsoft-forms-integration/` is NOT loaded from inside the theme and
is excluded from the build. If that feature is wanted, install it as a real
plugin under `wp-content/plugins/` and activate it. Otherwise ignore it.

## 5. Sitemap & robots
- Verify `https://<domain>/wp-sitemap.xml` responds (WP core sitemap).
- Add a physical `robots.txt` at the web root with a `Sitemap:` line, e.g.:
  ```
  User-agent: *
  Allow: /
  Sitemap: https://<domain>/wp-sitemap.xml
  ```

## 6. Security headers (.htaccess at the web root)
The theme removes the WP version tag and disables XML-RPC. Add server headers:
```apache
<IfModule mod_headers.c>
  Header set X-Content-Type-Options "nosniff"
  Header set X-Frame-Options "SAMEORIGIN"
  Header set Referrer-Policy "strict-origin-when-cross-origin"
  Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains" env=HTTPS
</IfModule>
```

## 7. Clean up any staging PII logs (IMPORTANT)
Earlier builds wrote form submissions to plaintext files. The code no longer
does this, but if the site was ever run before this change, delete any files
left on disk:
- `wp-content/novira-quote-logs.txt`
- `wp-content/novira-registration-logs.txt`
- `wp-content/novira-logs/` (whole directory)

Form submissions are now stored only as private CPTs (Quotes / Registrations /
Translation Requests in wp-admin). The `novira_translation_logs` option is now
non-autoloaded.

## 8. Post-launch smoke test
- Home, /american-diploma/, /american-diploma/est/, /translation/, /education/,
  /exams/, /about/, /contact/ all load with correct styling.
- Homepage registration form submits (success banner) and creates a
  Registration entry in wp-admin.
- A made-up URL (e.g. /nope) shows the branded 404 page.
- Logo, education hero, and share previews render.

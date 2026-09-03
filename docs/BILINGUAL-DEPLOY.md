# Bilingual Deployment — Execute in < 5 minutes

Arabic default at `/`, English at `/en/`, working switcher, no 404s.

---

## What I can and cannot do from here (honest split)

I have the theme source + PHP CLI, but **no running WordPress, no database, no web server** in this session. So:

| Step | Needs | Who |
|---|---|---|
| Install the Polylang **plugin** | live WP admin / network | **You** (1 command) |
| Create the two **languages** | WP **database** (Polylang term rows) | **You** — but the script attempts it; UI fallback is 60s |
| Create the English **pages** + link translations | WP **database** (posts + Polylang relations) | **The script** (you run it) |
| Set Polylang **options** | WP database (`wp_options`) | **The script** |
| Flush **rewrite rules** | live WP | **The script** |

Everything database-related is **generated as a runnable script** — you don't hand-edit anything. No raw SQL is used (Polylang stores serialized options + custom taxonomy/translation-group relations; the official Polylang API in the script is far safer than SQL, and produces a correct, re-runnable result).

---

## The 3 commands (copy/paste)

From your WordPress root (where `wp-config.php` lives):

```bash
# 1. Install + activate Polylang
wp plugin install polylang --activate

# 2. Run the one-shot bilingual setup (idempotent, safe to re-run)
wp eval-file wp-content/themes/novira-theme/docs/novira-bilingual-setup.php

# 3. (only if step 2 says it couldn't create languages) add them in the UI, then re-run step 2
#    wp-admin → Languages:  العربية (locale ar, RTL, set as DEFAULT) + English (locale en_US, LTR)
```

That's it. The script prints the live AR↔EN URLs when done.

> No WP-CLI? Do step 1 + the languages in the admin UI, then run the script's body via **Tools → (any "run PHP" ability)**, or paste it into a must-use mu-plugin once and load a page. The WP-CLI path is the fastest.

---

## 1. Exact Polylang configuration (the script sets all of this)

| Setting | Value | Why |
|---|---|---|
| Default language | **ar** | Arabic is permanent default |
| URL modifications | **Language set from directory** (`force_lang = 1`) | English → `/en/` |
| Hide URL language for default | **Yes** (`hide_default = 1`) | Arabic stays at `/`, not `/ar/` |
| Detect browser language | **Off** (`browser = 0`) | Every first-time visitor gets Arabic |
| Media / redirect | defaults | — |

## 2. Exact page translation mapping (the script creates these)

| Arabic page (existing) | English page (created) | Slug (shared) | Parent |
|---|---|---|---|
| American Diploma hub | American Diploma | `american-diploma` | (root) |
| EST | EST | `est` | American Diploma (EN) |
| Digital SAT | Digital SAT | `digital-sat` | American Diploma (EN) |
| ACT | ACT | `act` | American Diploma (EN) |
| Homepage | Home | (same as AR front slug) | (root) |

English pages are created **empty** — the theme template renders everything, and `languages/en_US.mo` supplies the English text. Slugs are **identical** to Arabic (Polylang differentiates by the `/en/` prefix), so every route, breadcrumb, and schema check keeps working with no code change.

## 3. Exact language settings

- Arabic: name `العربية`, slug `ar`, locale `ar`, **RTL**, order 0, default.
- English: name `English`, slug `en`, locale `en_US`, **LTR**, order 1.

(`en_US` matches the shipped `languages/en_US.mo`, so English content renders on `/en/`.)

## 4. Exact menu configuration

The theme's header nav has a **built-in fallback** that already localizes automatically: its links use `home_url()` (Polylang prefixes `/en/`) and its labels use gettext (`en_US.mo` → English). So:

- **Simplest (recommended):** leave the "primary" menu location **unassigned** → both languages render the localized fallback nav. Arabic is unchanged (same items/labels), English works automatically.
- **If you use a custom assigned menu:** wp-admin → Appearance → **Menus** → *Manage Locations*. Polylang shows the "Primary" location **once per language** — pick your Arabic menu for Arabic, and create/select an English menu (items pointing to the English pages) for English. ~1 minute.

The **language switcher itself does not depend on menus** — it links to each page's translation directly, so AR↔EN switching works regardless.

## 5. / 6. / 7. WP-CLI / SQL / JSON-XML

- **WP-CLI:** the 3 commands above.
- **SQL:** none — intentionally. Polylang's data (serialized options, `language`/`term_translations` taxonomy, post-translation groups) is unsafe to hand-write; the API script is the correct vehicle.
- **JSON/XML import:** not needed — pages are generated in place, not imported.

---

## Verify (30 seconds)

```bash
wp option get polylang --format=json     # default_lang":"ar", force_lang:1, hide_default:1, browser:0
wp pll post list --post_type=page 2>/dev/null || wp post list --post_type=page --fields=ID,post_name,post_status
```

Then in a browser:
- `/` → Arabic (RTL). `/en/` → English (LTR). Header shows **AR | EN**.
- On `/american-diploma/est/`, click **EN** → lands on `/en/american-diploma/est/` in English. No 404, no redirect to Arabic.
- View source on an English page: `<html lang="en" dir="ltr">`, `og:locale` `en_US`, JSON-LD `inLanguage` `en`, `hreflang` alternates present.

## If something's off
- **English shows Arabic text:** the English page's language isn't set to `en`, or `en_US.mo` is missing from `languages/`. Re-run the script.
- **`/` shows English:** Polylang default isn't Arabic → wp-admin → Languages → set العربية as default (star). (Code already forces Arabic when Polylang is absent.)
- **English spoke 404s:** the English hub/spoke slug isn't `american-diploma`/`est`/… → re-run the script (it re-asserts slugs), or check Polylang "shared slugs" isn't blocked.

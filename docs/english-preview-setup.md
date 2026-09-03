# English Development Preview — Setup Runbook

This theme is already multilingual-ready (locale abstraction, switcher, hreflang,
locale-aware fonts, and a full English translation file). Because every completed
page is **template-driven** — the same PHP template renders both languages, with
copy coming from gettext-wrapped datasets — enabling English is a **configuration
task in WordPress**, not a rebuild. This runbook lists the steps that must run in
your WordPress environment (they cannot be done from the theme source alone).

> Status: **development preview** — not a public launch. Arabic stays the primary,
> published language; English is for visual/bilingual validation.

> ### ⚠️ ARABIC IS THE PERMANENT DEFAULT
> - `/` MUST render Arabic. `/en/` is English. Never the reverse.
> - Polylang's **default language must be Arabic** (Languages screen → star on العربية).
> - Do **NOT** set WordPress "Site Language" (or Polylang default) to English.
> - Safety net in code: with **no** multilingual plugin active, the theme forces the
>   public front-end to Arabic (`inc/locale.php` → `novira_enforce_primary_locale`
>   on `determine_locale`), so `/` renders Arabic even if WP Site Language is English
>   and `en_US.mo` is present. With Polylang active, the theme defers to Polylang.
> - Keep `languages/en_US.mo` (it IS the English translation). It only loads on the
>   English (`/en/`) requests once Polylang is configured.

---

## What the theme already provides (done in code)

- `languages/en_US.po` + `languages/en_US.mo` — English translation of every
  string on the completed pages (Homepage, American Diploma Hub, EST, Digital
  SAT, ACT) plus shared chrome (nav, footer, breadcrumbs, switcher).
- `inc/locale.php` — the active locale drives `<html lang/dir>`, Open Graph
  locale, JSON-LD `inLanguage`, and typography. A multilingual plugin only needs
  to report the current locale; the theme decides the rest.
- Locale-aware webfont loading (`functions.php`) — English loads IBM Plex Sans;
  Arabic is unchanged.
- Language switcher (`inc/language-switcher.php`) — renders automatically once a
  multilingual plugin is active (Polylang or WPML detected). No code change.
- hreflang, canonical, Course/FAQ/Breadcrumb schema — all locale-derived and
  activate automatically.

## Steps to run in WordPress (admin or WP-CLI)

### 1. Install & activate Polylang
- Admin: Plugins → Add New → search "Polylang" → Install → Activate.
- WP-CLI: `wp plugin install polylang --activate`

### 2. Add the two languages
Languages → Languages:
- **العربية (ar)** — set as **default**, direction RTL, order 0.
- **English (en_US)** — direction LTR, order 1.
Polylang maps each language to a WordPress locale; **English → `en_US`**, which
is exactly the locale of the shipped `en_US.mo`.

### 3. Assign the Arabic language to existing content
Polylang will prompt "you have content without a language" → set it all to
Arabic (bulk action: Posts/Pages → select all → Languages → Arabic). This keeps
the current site 100% Arabic and unchanged.

### 4. Create the English translation of each completed page
For each Arabic page, use the Polylang "+" (add translation) column and create
its English counterpart with the **same page template**:

| Page | Arabic | English translation to create |
|---|---|---|
| Homepage | (front page) | English front page (Settings → Reading can stay AR as site front page; the EN homepage is the translation) |
| American Diploma Hub | `american-diploma` | English "American Diploma" |
| EST | `american-diploma/est` (child) | English EST |
| Digital SAT | `american-diploma/digital-sat` | English Digital SAT |
| ACT | `american-diploma/act` | English ACT |

The English page needs **no body content** — leave it empty. The template renders
everything (datasets + gettext), and on an English request the locale is `en_US`,
so the `en_US.mo` supplies English text automatically. Assign the same **Template**
(or keep the slug so `novira_force_diploma_exam_template()` routes the spokes).

> Tip: keep the English child pages under the English "American Diploma" parent so
> breadcrumbs (derived from page ancestry) read `Home → American Diploma → EST`.

### 5. Menus
Appearance → Menus: either create an English "primary" menu mirroring the Arabic
one (link each item to the English page), or enable Polylang's automatic menu
language handling. The theme's nav renders whichever menu is assigned to the
active language; the American-Diploma dropdown is registry-driven and localizes
via the `.mo`.

### 6. Confirm the switcher & preview
- The **language switcher appears automatically** in the header (desktop) and
  mobile menu once Polylang is active — no setting needed.
- To preview the switcher **before** finishing page translations, you can force
  it on temporarily:
  ```php
  add_filter( 'novira_multilingual_enabled', '__return_true' );
  ```
  (Remove once real translations exist.)

### 7. (Optional) mark English as development content
English pages can be left as Drafts/Private during review, or excluded from
search engines via the plugin — hreflang only emits when 2+ languages are truly
published, so leaving English unpublished keeps it out of the index.

---

## URL scheme (Polylang default: language-as-directory)

With Polylang's default "language set from directory name" and the Arabic default
language **not** URL-prefixed, the pages resolve as:

| Page | Arabic URL | English URL |
|---|---|---|
| Homepage | `/` | `/en/` |
| American Diploma Hub | `/american-diploma/` | `/en/american-diploma/` |
| EST | `/american-diploma/est/` | `/en/american-diploma/est/` |
| Digital SAT | `/american-diploma/digital-sat/` | `/en/american-diploma/digital-sat/` |
| ACT | `/american-diploma/act/` | `/en/american-diploma/act/` |

(Exact English paths depend on your Polylang URL-modification setting and whether
you use translated slugs. If the spoke templates don't route under `/en/`, verify
`novira_force_diploma_exam_template()` against the English page objects — it keys
off the American-Diploma ancestry/slug, which Polylang preserves per translation.)

---

## Verify after setup
- Switch AR↔EN via the header switcher — content, `<html lang/dir>`, and fonts
  change; no 404s.
- View source on an English page: `<html lang="en" dir="ltr">`, `og:locale`
  `en_US`, JSON-LD `inLanguage` `en`, and `<link rel="alternate" hreflang>` pairs.
- Breadcrumbs, Course schema, and FAQ schema render in English from the same
  centralized builders.

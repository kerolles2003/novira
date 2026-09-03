# Asset Localization Audit

**Scope:** every visual asset shipped by the Novira Academy theme (raster + vector
files under `assets/images/`, inline SVG artwork in templates, CSS backgrounds,
logos, and third‑party badges).

**Purpose:** classify each asset as **language‑independent** (works unchanged in
any language) or **requires localized replacement** (contains burned‑in text or
is otherwise tied to Arabic). This is an audit only — no assets were created,
translated, or redesigned.

**Method:** files were inventoried from disk and cross‑referenced against the
codebase (PHP + CSS). Image pixels cannot be inspected directly, so photos are
classified by directory purpose, `alt` text, and usage; anything whose text
content can't be confirmed from code is listed under **Needs human review**.

---

## Summary by category

| Asset | Used at | Classification | Reason |
|---|---|---|---|
| **Course placeholders** | | | |
| `courses/biology-course-placeholder.svg` | course cards (education) | **Requires localized replacement** | Burned‑in `<text>` "الأحياء" |
| `courses/english-course-placeholder.svg` | course cards | **Requires localized replacement** | Burned‑in `<text>` "الإنجليزية" |
| `courses/math-course-placeholder.svg` | course cards | **Requires localized replacement** | Burned‑in `<text>` "الرياضيات" |
| `courses/national-subjects-placeholder.svg` | course cards | **Requires localized replacement** | Burned‑in `<text>` "المواد القومية" |
| **Hero** | | | |
| `hero.png` | page-education hero | Language‑independent* | Student photo, no known embedded text |
| `hero/slide-1.webp` | est/act/sat/education heroes | Language‑independent* | Student/classroom photo |
| `hero/slide-2.webp` | (dynamic / spare) | Language‑independent* | Photo; not directly referenced today |
| `hero/slide-3.webp` | est/act/sat/education | Language‑independent* | Teacher/classroom photo |
| **Founder** | | | |
| `founder/founder.webp` | about, american-diploma, translation | Language‑independent | Portrait of the founder |
| **Gallery** | | | |
| `gallery/1–9.avif` (9 files) | gallery-videos (loaded via `scandir`) | Language‑independent* | Academy‑life photos; all nine are used through a directory scan |
| **Accreditations / certificates** | | | |
| `accreditations/cognia.avif` | diploma + exam spokes (5 refs) | Language‑independent | Third‑party accreditation brand mark |
| `accreditations/cambridge.avif` | **unreferenced** | Language‑independent | Brand mark; not currently used in code |
| `accreditations/oxford.avif` | **unreferenced** | Language‑independent | Brand mark; not currently used in code |
| **Services** | | | |
| `services/university.webp` | diploma/exam backgrounds (5 refs) | Language‑independent* | Campus photo |
| `services/courses.webp` | programs-stitch card | Language‑independent* | Photo |
| `services/translation.webp` | programs-stitch card | **Needs human review** | Translation‑service photo may show an Arabic document/screen |
| `services/IG.webp` | programs-stitch card | Language‑independent* | Photo |
| **Logos / brand** | | | |
| `logo.jpg` | OG/Twitter share image, schema logo | **Needs human review** | Brand logo — confirm whether it bakes in an Arabic tagline |
| `logo_horizontal.png` | header/mobile nav | **Needs human review** | Same — horizontal lockup may include Arabic wordmark |
| `logo_horizontal.webp` | (webp variant) | **Needs human review** | Same |
| **Inline SVG artwork** | | | |
| `<text>IELTS</text>` | page-education:271 badge | Language‑independent | Latin brand acronym, identical in every language |
| Contact agent illustration | page-contact (aria-label) | Language‑independent | Line‑art bust; aria‑label is a gettext string, not baked art |
| Decorative "certificate" art | page-translation (aria‑hidden) | Language‑independent | Latin display text is decorative illustration, not content |
| Icon SVGs (carets, arrows, flags, check/shield/clock…) | throughout | Language‑independent | Direction handled by `[dir]` CSS; no words |
| **Icon fonts** | | | |
| Material Symbols Outlined | nav, carousels | Language‑independent | Iconography, no embedded text |
| **CSS backgrounds** | | | |
| `url(...)` background images | — | None text‑bearing | Backgrounds reference the photos above; none carry copy |

\* *Photo — no embedded text is expected, but pixels weren't inspected; see Needs human review if any photo turns out to contain visible signage/whiteboard text.*

---

## Requires localized replacement (shortlist)

Only **four** assets contain burned‑in Arabic text and would need an English
sibling before English is published:

1. `assets/images/courses/biology-course-placeholder.svg` — "الأحياء"
2. `assets/images/courses/english-course-placeholder.svg` — "الإنجليزية"
3. `assets/images/courses/math-course-placeholder.svg` — "الرياضيات"
4. `assets/images/courses/national-subjects-placeholder.svg` — "المواد القومية"

Each is an SVG, so the English variant is a one‑line text swap in the same
artwork (e.g. `…-placeholder.en.svg`). No layout or code change is required —
see the resolver below.

---

## Needs human review

Pixels could not be inspected; a person should confirm text presence:

- **Logos** (`logo.jpg`, `logo_horizontal.png/.webp`) — if the wordmark contains
  an Arabic tagline, an English lockup may be wanted (brand decision, not
  strictly required).
- **`services/translation.webp`** — verify the photographed document/screen
  isn't prominently Arabic.
- **Gallery + hero photos** — only flag if a photo shows prominent Arabic
  signage that a localized site would want reshot. Not expected.

## Housekeeping (unrelated to language)

- `accreditations/cambridge.avif` and `accreditations/oxford.avif` are **not
  referenced** anywhere in code — dead assets to prune or wire up (independent
  of localization).

---

## Localization mechanism readiness

There is a resolver ready to use — `novira_localized_asset()` in `inc/locale.php`
(dormant today):

```php
novira_localized_asset( string $relative_path, ?string $locale = null ): string
```

- Looks for a language‑suffixed sibling (`name.svg` → `name.en.svg`) and falls
  back to the default when absent, so it **can never return a broken link**.
- With the active locale = primary (Arabic) it always returns the default URL —
  zero change today.
- Templates are **not** wired to it yet (wiring is a future task; it would only
  matter for the four course SVGs). When those variants are produced, swap the
  four `<img src>`/SVG references to `novira_localized_asset( … )` and English
  automatically serves the localized art.

No other per‑locale image mechanism is needed: every remaining asset is
language‑independent.

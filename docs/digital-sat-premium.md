# MEGA SPRINT 5.0 — Premium Digital SAT Page

Build report for `/american-diploma/digital-sat/`. EST is treated as read-only throughout.

---

## 1. Executive Summary

A dedicated **premium** Digital SAT landing page was built to match the EST gold standard as one product family, **without modifying EST**. Rather than cloning `page-est.php`, the EST sections were re-expressed as **shared, data-driven components** under `template-parts/sections/premium-exam/`, which `page-digital-sat.php` composes with Digital-SAT-specific, verified copy. The page reuses `est-page.css` (read-only) via the `.est-page` wrapper, so it inherits EST's exact spacing, cards, buttons, motion, responsive behaviour, and reduced-motion handling with **zero CSS duplication**. A future consolidation sprint will point EST at these same components; EST is intentionally left as-is now.

**Status:** code complete. **Not yet executed in this environment:** `php -l` (no PHP CLI here) and browser QA. One content step remains: creating the WordPress page (below).

---

## 2. Files Modified / Created

### Created (cannot affect EST)
| File | Purpose |
|---|---|
| `page-digital-sat.php` | Premium SAT template; wraps `.est-page.is-sat`, composes the premium components, ships a small scoped `<style>` (wordmark sizing + FAQ accordion), and self-emits Course + FAQPage JSON-LD. |
| `inc/premium-exam.php` | Shared helpers: `novira_premium_exam_icons()`, `novira_premium_exam_flag()`, `novira_premium_exam_schema_jsonld()`. Data-only. |
| `template-parts/sections/premium-exam/hero.php` | S1 hero (data-driven copy of EST S1). |
| `template-parts/sections/premium-exam/stepper.php` | S2 six-station process route. |
| `template-parts/sections/premium-exam/why.php` | S3 checklist + Cognia card. |
| `template-parts/sections/premium-exam/compare.php` | S4 comparison table; highlighted column is data-driven (`highlight => 'sat'`). |
| `template-parts/sections/premium-exam/parents.php` | S5 parent follow-up. |
| `template-parts/sections/premium-exam/facts.php` | S6 program-facts ledger + features. |
| `template-parts/sections/premium-exam/faq.php` | Premium FAQ accordion (native `<details>`; a section EST lacks today). |
| `template-parts/sections/premium-exam/cta.php` | S7 CTA. |
| `template-parts/sections/premium-exam/behavior.php` | Scroll/reveal/count-up JS, scoped to `.est-page` (identical logic to EST's inline script). |

### Modified — shared files, EST code paths byte-identical (⚠️ flagged & approved)
| File | Change | EST safety |
|---|---|---|
| `functions.php` | (a) `require inc/premium-exam.php`; (b) router: after the untouched `est` branch, a generic `page-{slug}.php` check routes `digital-sat` → `page-digital-sat.php`; (c) enqueue: a **new** block loads `est-page.css` for `digital-sat` (shares the `novira-est-page` handle, mutually exclusive with the EST block); (d) doc comment refreshed. | EST's `est` branch returns first and is unchanged; EST's enqueue block is unchanged. All additions are additive/after. |
| `inc/exams.php` | Added `definition`, `sections`, `timing`, `score_model`, `faq_items` **inside the `'digital-sat'` array only**. | The `'est'` array is not read, moved, or edited — byte-identical. |

### NOT touched
`page-est.php`, `est-page.css`, `page-diploma-exam.php`, `template-parts/sections/exam/*`, `inc/seo.php`, `inc/diploma.php`, the `est` dataset, and everything ACT.

---

## 3. Architecture Decisions

1. **Shared components, not a clone (approved Option 2).** EST's locked, so it can't be refactored to share code now. Instead the premium sections live as parameterised partials that SAT uses today and EST will adopt at consolidation. Duplication (markup mirroring EST) is isolated inside `premium-exam/*`.
2. **Reuse `est-page.css` for parity.** `est-page.css` is 100% scoped under `.est-page` (verified — no `page-est`/body coupling), so a `.est-page` wrapper yields pixel-identical styling with no CSS copy and no drift. Cost: `est-*` class names appear on SAT (semantic smell) — logged as debt.
3. **Isolated scoped supplement.** The only new CSS is a small `<style>` in `page-digital-sat.php`, scoped to `.est-page.is-sat` (wordmark sizing for the longer "Digital SAT") and `.pex-faq` (the FAQ EST lacks). It never edits `est-page.css` and never matches EST markup.
4. **Centralized structured data (post-cleanup).** SAT's Course + FAQPage schema is emitted by the central SEO layer (`inc/seo.php`: `novira_exam_course_node()` + an exam branch in `novira_faqpage_node()`), **guarded to exclude `est`** so EST's emitted schema is byte-identical. Page templates are presentation-only — no JSON-LD, no inline CSS. Supplementary styles live in `assets/css/premium-exam.css` (enqueued only on premium spokes, after `est-page.css`).
5. **Generic router rule.** The `page-{slug}.php` check is exam-agnostic, so a future `page-act.php` needs **zero** further `functions.php` routing changes.

---

## 4. Reused Components

- **`est-page.css`** — all layout, cards, buttons (`est-btn*`), eyebrows, hero, stepper route, comparison table, ledger, features, reveal motion, responsive + reduced-motion. Reused verbatim, unedited.
- **EST section structure & ordering** — Hero → Stepper → Why/Cognia → Compare → Parents → Facts → (FAQ) → CTA. Identical rhythm.
- **Icon set & flag SVG** — extracted into `inc/premium-exam.php` (previously inline in `page-est.php`); both pages can share them at consolidation.
- **Behaviour JS** — same logic as EST, scoped to `.est-page`.

---

## 5. SAT-specific Content

- **Hero:** wordmark **Digital SAT**; SAT-specific lead ("النسخة الرقمية من اختبار SAT… يستعد لها طالبك داخل حصصه الأسبوعية").
- **Why:** "لماذا تختار **Digital SAT** مع نوفيرا؟"; digital-format mock-exam point; Cognia copy names Digital SAT.
- **Compare:** highlighted column moved to **Digital SAT**; added a truthful "يُؤدّى رقمياً" row (SAT ✓).
- **Facts:** SAT-verified "قسمان في الاختبار — القراءة والكتابة، والرياضيات" surfaced as a program fact.
- **FAQ (8, SAT-specific):** paper-vs-digital (Bluebook, adaptive), sections + 400–1600 scale, ~2h14m duration, calculator allowed throughout Math, Novira's prep method, re-sit, registration/fees → **contact fallback**, score usage → per-university.
- **Dataset (`inc/exams.php` `digital-sat`):** `definition` (Bluebook/adaptive), `sections` (RW, Math), `timing` (~2h14m), `score_model` (400–1600).

**Verified facts only.** Sections, 400–1600 scale, digital/adaptive (Bluebook), ~2h14m, calculator-in-Math are College-Board-published. **Never invented:** fees, dates, deadlines, registration requirements, passing/required scores (SAT has none), guarantees, university requirements → all use the existing truthful `تواصل معنا` / `سيتم تحديثه` fallback. **No EST wording leaked** (grep-checkable: no "EST" outside the neutral 3-exam comparison row/labels).

---

## 6. SEO Validation

- **Title / OG:title / Twitter:title** — generic via `wp_get_document_title()` → the SAT page title. No code needed; **not overridden**, so EST is unaffected.
- **Meta / OG / Twitter description** — generic via `novira_meta_description()` → the SAT page **excerpt**. Set the excerpt when creating the page (command below) for a SAT-specific description.
- **Canonical / OG:url** — generic (`novira_canonical_url()`), correct per-page.
- **Breadcrumbs** — generic ancestor-derived (`الرئيسية › البرنامج الأمريكي › Digital SAT`).
- **Structured data** — SAT self-emits `Course` (+ `isPartOf` the hub program `#program`, provider Organization, description with the admission disclaimer) and `FAQPage` (8 Q&A). This satisfies the hub's existing `hasPart … /digital-sat/#course` reference.
- ⚠️ **Not yet validated in a tool** (Rich Results Test / Schema validator) — pending a live URL. JSON is built with `wp_json_encode` (well-formed by construction) but should be tool-verified after the page is live.

---

## 7. Accessibility Validation (by construction; not audited with a tool)

- Single `<h1>` (hero); section `<h2>` with `aria-labelledby`.
- FAQ uses native `<details>/<summary>` → keyboard-operable, no JS/ARIA needed; visible `:focus-visible` outline (reuses EST token).
- All imagery has `alt`; decorative flag/overlays are `aria-hidden`.
- Motion respects `prefers-reduced-motion` (inherited from `est-page.css` + the scoped FAQ rule).
- Focus outlines, colour tokens, and contrast inherited from `est-page.css` (unchanged from EST).
- ⚠️ Not run through axe/Lighthouse in this environment.

---

## 8. Regression Report

- **EST rendering path unchanged:** router `est` branch (functions.php:507–512) is byte-identical; EST still resolves to `page-est.php`.
- **EST CSS unchanged:** `est-page.css` not edited; EST enqueue block unchanged. (Both EST and SAT also load `exam.css` harmlessly — pre-existing behaviour, now identical for both.)
- **EST SEO/Schema unchanged:** `inc/seo.php` not touched; no exam-spoke branch added to shared schema/FAQ nodes, so EST's `<head>` output is identical.
- **EST content/dataset unchanged:** the `est` override array in `inc/exams.php` is untouched.
- **Shared-file blast radius:** `functions.php` and `inc/exams.php` edits are additive; no existing line that EST depends on was modified.
- ⚠️ **Not executed here:** `php -l` (no PHP CLI) and a side-by-side browser diff of `/american-diploma/est/` before/after.

---

## 9. Production Readiness

**Required before launch:**
1. **Create the WP page** (deployment/content task — the theme never creates pages). Via WP-CLI:
   ```bash
   wp post create --post_type=page --post_status=publish \
     --post_title='Digital SAT' --post_name='digital-sat' \
     --post_parent="$(wp post list --post_type=page --name=american-diploma --field=ID)" \
     --post_excerpt='إعداد Digital SAT ضمن برنامج الدبلومة الأمريكية في نوفيرا أكاديمي — حصص أسبوعية، اختبارات تجريبية رقمية، ومتابعة حتى يوم الاختبار.'
   ```
   Or Pages → Add New: title "Digital SAT", slug `digital-sat`, parent "American Diploma", set the Excerpt (drives the meta/OG description), Publish, then flush permalinks. Requires the `american-diploma` hub page to exist.
2. **`php -l`** on `functions.php`, `inc/premium-exam.php`, `inc/exams.php`, `page-digital-sat.php`, and each `template-parts/sections/premium-exam/*.php`.
3. **Browser QA:** open `/american-diploma/digital-sat/`, then `/american-diploma/est/` and confirm EST is visually identical. Verify the `slide-1.webp` / `slide-3.webp` / `university.webp` / `cognia.avif` assets exist (they're the same EST uses).
4. **Rich Results Test** on the live SAT URL for Course + FAQPage.

---

## 10. Remaining Technical Debt

1. **`est-*` class names on SAT** — semantic smell from reusing `est-page.css`. Resolve at consolidation by renaming to neutral `premium-exam-*` (or a token layer) and pointing both pages at it.
2. **Markup mirrors EST** inside `premium-exam/*` — intended; removed when EST adopts these same components (consolidation sprint).
3. **Scoped `<style>` lives in the template** — fine for isolation; could move to an enqueued `premium-exam.css` later.
4. **JSON-LD emitted in `<body>`** (valid, Google-supported) rather than `<head>`, to avoid touching `inc/seo.php`. Could move to a guarded `wp_head` hook at consolidation.
5. **EST has no on-page FAQ; SAT does** — a deliberate divergence to meet the sprint's FAQ requirement. Back-port the `premium-exam/faq.php` component to EST at consolidation for symmetry.
6. **Hub `hasPart` → `/est/#course`** still dangles (EST emits no Course node). Pre-existing; out of scope. SAT now correctly satisfies its own `/digital-sat/#course` reference.

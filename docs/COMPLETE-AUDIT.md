# NOVIRA ACADEMY THEME
# COMPLETE ARCHITECTURAL INVENTORY & AUDIT REPORT
# Version: 1.0.0 | Date: 2026-06-13 | Status: FROZEN

---

## 1. PROJECT FILE TREE

### Root Templates
```
novira-theme/
├── style.css                          (Theme metadata)
├── functions.php                      (360 lines — theme bootstrap)
├── front-page.php                     (Homepage)
├── page.php                           (Default page)
├── page-department.php                (Department page template)
├── page-contact.php                   (Contact page — standalone)
├── page-about.php                     (About page — standalone)
├── page-services.php                  (Services page — standalone)
├── single.php                         (Single blog post)
├── archive.php                        (Blog/Event archives)
├── search.php                         (Search results)
├── index.php                          (Ultimate fallback)
├── header.php                         (Site header wrapper)
├── footer.php                         (Site footer wrapper)
├── readme.txt                         (WordPress readme)
└── docker-compose.yml                 (Local dev environment)
```

### Assets
```
assets/
├── css/
│   ├── main.css                       (2,118 lines — design system)
│   ├── homepage.css                   (673 lines — homepage sections)
│   ├── blog-events.css                (625 lines — blog/event styles)
│   ├── department-education.css       (459 lines)
│   ├── department-translation.css     (307 lines)
│   ├── department-american-diploma.css (270 lines)
│   ├── translation-workflow.css       (134 lines)
│   ├── media-components.css           (285 lines)
│   ├── variables.css                  (372 lines — future-ready tokens)
│   ├── rtl.css                        (334 lines)
│   └── editor.css                     (43 bytes — empty stub)
└── js/
    ├── navigation.js                  (216 lines — mobile nav)
    ├── main.js                        (64 lines — scroll + counters)
    ├── customizer-preview.js          (114 lines — live preview)
    ├── form-validation.js             (177 lines — quote form)
    └── registration-validation.js     (185 lines — registration form)
```

### Include Files
```
inc/
├── customizer.php                     (237 lines)
├── custom-fields.php                  (563 lines — 6 meta boxes)
├── custom-post-types.php              (224 lines — blog_post, event)
├── form-handling.php                  (228 lines — quote AJAX)
├── registration-handling.php          (200 lines — registration AJAX)
├── translation-request-handler.php    (261 lines — translation AJAX)
├── translation-request-sanitization.php (212 lines)
├── translation-request-logging.php    (230 lines)
├── hooks.php                          (208 lines — hook documentation)
├── media-categories.php               (134 lines)
├── featured-images.php                (222 lines)
├── media-functions.php                (258 lines)
├── exam-integration.php               (281 lines — Novira_Exam_Integration class)
└── student-auth-hooks.php             (335 lines — Novira_Student_Auth class)
```

### Template Parts
```
template-parts/
├── layout/
│   ├── header.php                     (44 lines — primary nav)
│   └── footer.php                     (90 lines — footer columns)
├── sections/
│   ├── hero.php                       (106 lines)
│   ├── department-nav.php             (81 lines)
│   ├── department-hero.php            (88 lines)
│   ├── department-education.php       (87 lines)
│   ├── department-translation.php     (96 lines)
│   ├── department-american-diploma.php (91 lines)
│   ├── department-whatsapp.php        (62 lines)
│   ├── admission-details.php          (127 lines)
│   ├── trust-proof.php                (123 lines)
│   ├── media-gallery.php              (116 lines)
│   ├── whatsapp-cta.php               (64 lines)
│   ├── latest-posts.php               (60 lines)
│   └── upcoming-events.php            (63 lines)
├── content/
│   ├── program-card.php
│   ├── course-card.php
│   ├── service-card.php
│   ├── pricing-table.php
│   ├── curriculum.php
│   ├── admission-process.php          (97 lines)
│   ├── blog-post-card.php             (71 lines)
│   ├── event-card.php                 (97 lines)
│   ├── department-card.php            (74 lines)
│   └── testimonial.php                (74 lines)
├── components/
│   ├── gallery.php                    (38 lines)
│   ├── responsive-image.php           (98 lines)
│   ├── video-embed.php                (79 lines)
│   ├── video-gallery.php              (96 lines)
│   ├── quote-request-form.php         (130 lines)
│   ├── registration-interest-form.php (119 lines)
│   ├── form-success-message.php
│   └── form-error-message.php
├── portal/
│   ├── login.php                      (60 lines — placeholder)
│   └── dashboard.php                  (88 lines — placeholder)
└── (root-level legacy stubs)
    ├── departments.php
    ├── cta.php
    ├── cta-final.php
    ├── translation.php
    ├── translation-highlight.php
    ├── testimonials.php
    ├── services-grid.php
    ├── blog-activity.php
    ├── page-hero.php
    ├── proof-strip.php
    ├── hero-documentary.php
    ├── diploma.php
    └── diploma-highlight.php
```

### Plugins
```
plugins/
└── microsoft-forms-integration/
    └── microsoft-forms-integration.php (232 lines — stub plugin)
```

### Languages
```
languages/
└── novira-academy.pot                 (Translation strings)
```

### Documentation
```
docs/
├── translation-workflow.md
├── student-portal-extension.md
├── media-guidelines.md
├── exam-integration.md
└── ARCHITECTURE.md                    (Generated inventory)
```

**Total Lines of Code: ~15,114** (PHP: ~6,800, CSS: ~4,800, JS: ~836, Docs: ~2,678)

---

## 2. WORDPRESS CONTENT MODEL

### Custom Post Types

| Slug | Label | Public | Archive | Supports | Registered In |
|------|-------|--------|---------|----------|---------------|
| `blog_post` | المقالات | Yes | `/blog/` | title, editor, author, thumbnail, excerpt, comments, custom-fields | `inc/custom-post-types.php:51` |
| `event` | الأحداث | Yes | `/events/` | title, editor, author, thumbnail, excerpt, custom-fields | `inc/custom-post-types.php:114` |
| `novira_quote` | عروض الأسعار | No | No | title | `inc/form-handling.php:205` |
| `novira_registration` | طلبات التسجيل | No | No | title | `inc/registration-handling.php:177` |
| `novira_translation_request` | طلبات الترجمة | No | No | title | `inc/translation-request-handler.php:252` |
| `novira_exam` | الامتحانات | No | No | title, editor, thumbnail | `inc/exam-integration.php:99` |

### Taxonomies

| Slug | Label | Attached To | Hierarchical | Registered In |
|------|-------|-------------|--------------|---------------|
| `blog_category` | تصنيفات المقالات | `blog_post` | Yes | `inc/custom-post-types.php:54` |
| `event_type` | أنواع الأحداث | `event` | Yes | `inc/custom-post-types.php:117` |
| `media_category` | تصنيفات الوسائط | `attachment` | Yes | `inc/media-categories.php:43` |

### Custom Fields (Meta Keys)

**Department Pages (`page-department.php`):**
| Meta Key | Type | Repeatable | Saved In |
|----------|------|------------|----------|
| `_education_programs` | array of arrays | Yes (dynamic rows) | `inc/custom-fields.php:490` |
| `_education_courses` | array of arrays | Yes (dynamic rows) | `inc/custom-fields.php:505` |
| `_translation_services` | array of arrays | Yes (dynamic rows) | `inc/custom-fields.php:520` |
| `_translation_pricing` | array of arrays | Yes (dynamic rows) | `inc/custom-fields.php:535` |
| `_diploma_curriculum` | array of arrays | Yes (dynamic rows) | `inc/custom-fields.php:551` |
| `_diploma_admission` | associative array | No | `inc/custom-fields.php:560` |

**Events:**
| Meta Key | Type | Saved In |
|----------|------|----------|
| `_event_date` | string (Y-m-d) | `inc/custom-post-types.php:208` |
| `_event_time` | string (H:i) | `inc/custom-post-types.php:212` |
| `_event_location` | string | `inc/custom-post-types.php:216` |

**Exams:**
| Meta Key | Type | Saved In |
|----------|------|----------|
| `_novira_exam_url` | string (URL) | `inc/exam-integration.php:199` |
| `_novira_exam_duration` | integer | `inc/exam-integration.php:199` |
| `_novira_exam_passing_score` | integer | `inc/exam-integration.php:199` |
| `_novira_exam_provider` | string | `inc/exam-integration.php:199` |

**Testimonials (query-based):**
| Meta Key | Type | Queried In |
|----------|------|------------|
| `_testimonial_role` | string | `template-parts/sections/trust-proof.php:45` |
| `_wp_page_template` | string (`testimonial`) | `template-parts/sections/trust-proof.php:34` |

### Attachment Handling
- `media_category` taxonomy on `attachment` post type
- 8 default categories auto-created on `init` (priority 20)
- Custom admin column for category display
- Sortable column filter
- Admin filtering by category

### Media Architecture
- Custom image sizes: `novira-hero` (1920×1080 crop), `novira-card` (600×400 crop), `novira-thumb` (300×300 crop)
- Responsive image helper with auto-generated `srcset`
- Gallery data helper for JavaScript lightbox integration
- Video type detection (YouTube, Vimeo, self-hosted)

---

## 3. WORDPRESS HOOKS

### Actions Registered (38 total)

| Hook | Priority | Callback | File:Line |
|------|----------|----------|-----------|
| `after_setup_theme` | 10 | `novira_setup` | `functions.php:72` |
| `widgets_init` | 10 | `novira_widgets_init` | `functions.php:108` |
| `wp_enqueue_scripts` | 10 | `novira_enqueue_assets` | `functions.php:215` |
| `wp_head` | 10 | `novira_pingback_header` | `functions.php:273` |
| `customize_register` | 10 | `novira_customize_register` | `inc/customizer.php:208` |
| `wp_enqueue_scripts` | 20 | `novira_customizer_css` | `inc/customizer.php:224` |
| `customize_preview_init` | 10 | `novira_customize_preview_js` | `inc/customizer.php:237` |
| `add_meta_boxes` | 10 | `novira_add_department_meta_boxes` | `inc/custom-fields.php:73` |
| `save_post` | 10 | `novira_save_department_meta` | `inc/custom-fields.php:563` |
| `wp_ajax_novira_quote_request` | 10 | `novira_handle_quote_request` | `inc/form-handling.php:152` |
| `wp_ajax_nopriv_novira_quote_request` | 10 | `novira_handle_quote_request` | `inc/form-handling.php:153` |
| `init` | 10 | `novira_register_quote_cpt` | `inc/form-handling.php:207` |
| `wp_enqueue_scripts` | 10 | `novira_enqueue_form_validation` | `inc/form-handling.php:228` |
| `wp_ajax_novira_registration_interest` | 10 | `novira_handle_registration_interest` | `inc/registration-handling.php:139` |
| `wp_ajax_nopriv_novira_registration_interest` | 10 | `novira_handle_registration_interest` | `inc/registration-handling.php:140` |
| `init` | 10 | `novira_register_registration_cpt` | `inc/registration-handling.php:179` |
| `wp_enqueue_scripts` | 10 | `novira_enqueue_registration_validation` | `inc/registration-handling.php:200` |
| `init` | 10 | `novira_register_blog_post_cpt` | `inc/custom-post-types.php:76` |
| `init` | 10 | `novira_register_event_cpt` | `inc/custom-post-types.php:139` |
| `add_meta_boxes` | 10 | `novira_add_event_meta_boxes` | `inc/custom-post-types.php:154` |
| `save_post` | 10 | `novira_save_event_meta` | `inc/custom-post-types.php:219` |
| `wp_ajax_novira_translation_request` | 10 | `novira_handle_translation_request` | `inc/translation-request-handler.php:81` |
| `wp_ajax_nopriv_novira_translation_request` | 10 | `novira_handle_translation_request` | `inc/translation-request-handler.php:82` |
| `init` | 10 | `novira_register_translation_request_cpt` | `inc/translation-request-handler.php:254` |
| `init` | 10 | `novira_register_media_category_taxonomy` | `inc/media-categories.php:45` |
| `manage_media_custom_column` | 10 | `novira_display_media_category_column` | `inc/media-categories.php:79` |
| `parse_query` | 10 | `novira_filter_media_by_category` | `inc/media-categories.php:111` |
| `init` | 20 | `novira_add_default_media_categories` | `inc/media-categories.php:134` |
| `after_setup_theme` | 10 | `novira_register_image_sizes` | `inc/featured-images.php:208` |
| `novira_after_store_translation_request` | 10 | `novira_log_translation_request` | `inc/translation-request-logging.php:230` |
| `init` | 10 | `Novira_Exam_Integration::register_post_types` | `inc/exam-integration.php:59` |
| `add_meta_boxes` | 10 | `Novira_Exam_Integration::add_exam_meta_boxes` | `inc/exam-integration.php:60` |
| `save_post_novira_exam` | 10 | `Novira_Exam_Integration::save_exam_meta` | `inc/exam-integration.php:61` |
| `plugins_loaded` | 10 | `novira_ms_forms_init` | `plugins/.../microsoft-forms-integration.php:232` |

### Filters Registered (7 total)

| Filter | Priority | Callback | File:Line |
|--------|----------|----------|-----------|
| `body_class` | 10 | `novira_body_classes` | `functions.php:289` |
| `excerpt_length` | 999 | `novira_excerpt_length` | `functions.php:297` |
| `excerpt_more` | 10 | `novira_excerpt_more` | `functions.php:305` |
| `manage_media_columns` | 10 | `novira_add_media_category_column` | `inc/media-categories.php:54` |
| `manage_upload_sortable_columns` | 10 | `novira_sortable_media_category_column` | `inc/media-categories.php:88` |
| `image_size_names_choose` | 10 | `novira_add_custom_image_sizes` | `inc/featured-images.php:222` |
| `novira_exam_embed_code` | 10 | `Novira_Microsoft_Forms_Integration::render_embed` | `plugins/.../microsoft-forms-integration.php:76` |

### Custom Hooks Defined (37 total)

**Filters (16):**
| Hook | Parameters | File:Line |
|------|------------|-----------|
| `novira_content_width` | `$width` | `functions.php:67` |
| `novira_validate_translation_request` | `$result`, `$post_data` | `inc/translation-request-handler.php:28` |
| `novira_sanitize_translation_request` | `$data` | `inc/translation-request-handler.php:36` |
| `novira_before_process_translation_request` | `$data` | `inc/translation-request-handler.php:59` |
| `novira_before_store_translation_request` | `$data` | `inc/translation-request-handler.php:131` |
| `novira_send_translation_notifications` | `$send`, `$request_id`, `$data` | `inc/translation-request-handler.php:156` |
| `novira_translation_notification_template` | `$template`, `$type`, `$data` | `inc/translation-request-handler.php:183` |
| `novira_translation_log_entry` | `$log_entry`, `$data` | `inc/translation-request-logging.php:36` |
| `novira_available_languages` | `$languages` | `inc/translation-request-sanitization.php:181` |
| `novira_available_services` | `$services` | `inc/translation-request-sanitization.php:201` |
| `novira_homepage_testimonials` | `$testimonials` | `template-parts/sections/trust-proof.php:25` |
| `novira_homepage_gallery` | `$gallery_images` | `template-parts/sections/media-gallery.php:25` |
| `novira_latest_posts_query` | `$args` | `template-parts/sections/latest-posts.php:20` |
| `novira_upcoming_events_query` | `$args` | `template-parts/sections/upcoming-events.php:20` |
| `novira_whatsapp_cta` | `$cta_data` | `template-parts/sections/whatsapp-cta.php:26` |
| `novira_student_capabilities_filter` | `$capabilities`, `$role` | `inc/student-auth-hooks.php:145` |
| `novira_student_password_strength_check` | `$is_strong`, `$password` | `inc/student-auth-hooks.php:204` |
| `novira_student_profile_data_filter` | `$profile_data`, `$user_id` | `inc/student-auth-hooks.php:253` |
| `novira_is_student` | `$is_student`, `$user` | `inc/student-auth-hooks.php:282` |
| `novira_student_data` | `$student_data`, `$user` | `inc/student-auth-hooks.php:321` |

**Actions (21):**
| Hook | Parameters | File:Line |
|------|------------|-----------|
| `novira_after_translation_request` | `$request_id`, `$data` | `inc/translation-request-handler.php:71` |
| `novira_after_store_translation_request` | `$request_id`, `$data` | `inc/translation-request-handler.php:146` |
| `novira_after_log_translation_request` | `$request_id`, `$log_entry` | `inc/translation-request-logging.php:52` |
| `novira_translation_request_status_changed` | `$request_id`, `$new_status`, `$log_entry` | `inc/translation-request-logging.php:154` |
| `novira_register_exam_providers` | `$integration` | `inc/exam-integration.php:64` |
| `novira_exam_provider_registered` | `$provider_id`, `$args` | `inc/exam-integration.php:224` |
| `novira_save_exam_meta` | `$post_id`, `$post_data` | `inc/exam-integration.php:203` |
| `novira_student_login_after` | `$user_id`, `$user_data` | `inc/student-auth-hooks.php:87` |
| `novira_student_logout_after` | `$user_id` | `inc/student-auth-hooks.php:101` |
| `novira_student_register_after` | `$user_id`, `$user_data` | `inc/student-auth-hooks.php:117` |
| `novira_student_role_created_after` | `$role` | `inc/student-auth-hooks.php:159` |
| `novira_student_session_started` | `$user_id` | `inc/student-auth-hooks.php:173` |
| `novira_student_session_ended` | `$user_id` | `inc/student-auth-hooks.php:187` |
| `novira_student_password_reset_after` | `$user_id`, `$new_password` | `inc/student-auth-hooks.php:220` |
| `novira_student_profile_updated` | `$user_id`, `$profile_data` | `inc/student-auth-hooks.php:236` |

---

## 4. TEMPLATE HIERARCHY

### Template Relationships

```
WordPress Request
├── Front Page
│   └── front-page.php
│       ├── get_header() → header.php → get_template_part('template-parts/layout/header')
│       ├── get_template_part('template-parts/sections/hero')
│       ├── get_template_part('template-parts/sections/department-nav')
│       ├── get_template_part('template-parts/sections/trust-proof')
│       ├── get_template_part('template-parts/sections/media-gallery')
│       ├── get_template_part('template-parts/sections/latest-posts')
│       ├── get_template_part('template-parts/sections/upcoming-events')
│       ├── get_template_part('template-parts/sections/whatsapp-cta')
│       ├── [WhatsApp floating button — inline]
│       └── get_footer() → footer.php → get_template_part('template-parts/layout/footer')
│
├── Department Page (page-department.php)
│   ├── Validates slug against allowed list: ['education', 'translation', 'american-diploma']
│   ├── get_template_part('template-parts/sections/department-hero', $slug)
│   ├── get_template_part('template-parts/sections/department-{slug}')
│   │   ├── department-education.php → program-card.php, course-card.php
│   │   ├── department-translation.php → service-card.php, pricing-table.php, quote-request-form.php
│   │   └── department-american-diploma.php → curriculum.php, admission-process.php, registration-interest-form.php
│   ├── get_template_part('template-parts/sections/admission-details', $slug)
│   └── get_template_part('template-parts/sections/department-whatsapp', $slug)
│
├── Single Post (single.php)
│   └── Loops through post
│       ├── Article header (categories, date, author, reading time)
│       ├── Featured image
│       ├── Content
│       ├── Tags
│       └── Post navigation
│
├── Archive (archive.php)
│   ├── Detects post type: blog_post → blog-post-card.php, event → event-card.php
│   ├── Handles: category, tag, author, date archives
│   └── Pagination
│
├── Search (search.php)
│   ├── Detects post type for card rendering
│   └── Fallback to generic content template
│
├── Default Page (page.php)
│   └── Basic the_content() loop
│
├── Standalone Pages (hardcoded)
│   ├── page-contact.php (self-contained, 111 lines)
│   ├── page-about.php (self-contained, 90 lines)
│   └── page-services.php (self-contained, 51 lines)
│
└── Index (index.php) — Ultimate fallback (3 lines, just get_header/get_footer)
```

### Fallback Behavior
- **Missing menu:** `novira_fallback_menu()` renders hardcoded 4-link nav
- **Missing footer menu:** `novira_fallback_footer_menu()` renders 2-link footer nav
- **Missing testimonials:** Static 3-testimonial fallback array
- **Missing gallery:** WordPress media library query
- **Missing hero image:** No image displayed (text-only hero)
- **Missing front page:** Static headline/subheadline defaults

---

## 5. TEMPLATE PARTS

### Layout (`template-parts/layout/`)
| File | Purpose | Dependencies |
|------|---------|--------------|
| `header.php` | Primary navigation with logo, menu, WhatsApp CTA | `novira_header_menu()`, `novira_fallback_menu()` |
| `footer.php` | Footer with columns, social links, copyright | `novira_footer_menu()`, `novira_fallback_footer_menu()`, Customizer settings |

### Sections (`template-parts/sections/`)
| File | Purpose | Dependencies |
|------|---------|--------------|
| `hero.php` | Homepage hero with headline, stats, CTA | WordPress page data, Customizer WhatsApp |
| `department-nav.php` | Department navigation cards | `get_pages()` by slug |
| `department-hero.php` | Department page hero with breadcrumbs | Current page data |
| `department-education.php` | Education programs/courses listing | `_education_programs`, `_education_courses` meta |
| `department-translation.php` | Translation services/pricing | `_translation_services`, `_translation_pricing` meta |
| `department-american-diploma.php` | Diploma curriculum/admission | `_diploma_curriculum`, `_diploma_admission` meta |
| `department-whatsapp.php` | Department-specific WhatsApp CTA | Customizer WhatsApp |
| `admission-details.php` | Admission details section | Page slug routing |
| `trust-proof.php` | Testimonials carousel/grid | `novira_homepage_testimonials` filter |
| `media-gallery.php` | Media gallery with video | `novira_homepage_gallery` filter |
| `whatsapp-cta.php` | WhatsApp conversion CTA | `novira_whatsapp_cta` filter |
| `latest-posts.php` | Latest blog posts grid | `WP_Query` on `blog_post` CPT |
| `upcoming-events.php` | Upcoming events list | `WP_Query` on `event` CPT |

### Content (`template-parts/content/`)
| File | Purpose | Inputs |
|------|---------|--------|
| `program-card.php` | Education program display | `$program` array |
| `course-card.php` | Education course display | `$course` array |
| `service-card.php` | Translation service display | `$service` array |
| `pricing-table.php` | Pricing comparison table | `$pricing` array |
| `curriculum.php` | Diploma curriculum subject | `$subject` array |
| `admission-process.php` | Admission process steps | `$admission` array |
| `blog-post-card.php` | Blog post card (archive) | WordPress loop |
| `event-card.php` | Event card with date badge | WordPress loop |
| `department-card.php` | Reusable department card | `$department` array |
| `testimonial.php` | Testimonial card | `$testimonial` array |

### Components (`template-parts/components/`)
| File | Purpose | Inputs | AJAX |
|------|---------|--------|------|
| `gallery.php` | WordPress gallery shortcode wrapper | `$args['ids']` | No |
| `responsive-image.php` | Responsive image with srcset | `$args['image_id']` or `$args['image_url']` | No |
| `video-embed.php` | YouTube/Vimeo embed | `$url` | No |
| `video-gallery.php` | Multiple video gallery | `$args['videos']` array | No |
| `quote-request-form.php` | Translation quote form | None | Yes |
| `registration-interest-form.php` | Diploma registration form | None | Yes |
| `form-success-message.php` | Reusable success message | `$message` | No |
| `form-error-message.php` | Reusable error message | `$message` | No |

### Portal (`template-parts/portal/`)
| File | Purpose | Status |
|------|---------|--------|
| `login.php` | Student login form | **PLACEHOLDER** — static HTML, no backend |
| `dashboard.php` | Student dashboard | **PLACEHOLDER** — static HTML, no backend |

### Root-Level Legacy Stubs
| File | Purpose | Status |
|------|---------|--------|
| `departments.php` | Department section (old) | **UNUSED** — superseded by `department-nav.php` |
| `cta.php` | Basic CTA | **UNUSED** — superseded by `whatsapp-cta.php` |
| `cta-final.php` | Final CTA with contact info | **UNUSED** — standalone |
| `translation.php` | Translation highlight | **UNUSED** — standalone |
| `translation-highlight.php` | Translation highlight (alt) | **UNUSED** — standalone |
| `testimonials.php` | Testimonials (old) | **UNUSED** — superseded by `trust-proof.php` |
| `services-grid.php` | Services grid | **UNUSED** — standalone |
| `blog-activity.php` | Blog activity | **UNUSED** — standalone |
| `page-hero.php` | Generic page hero | Used by page-about, page-contact, page-services |
| `proof-strip.php` | Trust strip | **UNUSED** — standalone |
| `hero-documentary.php` | Documentary hero | **UNUSED** — standalone |
| `diploma.php` | Diploma highlight | Used by page-services |
| `diploma-highlight.php` | Diploma highlight (alt) | **UNUSED** — standalone |

---

## 6. REUSABLE COMPONENTS

### Department Card
- **File:** `template-parts/content/department-card.php`
- **Inputs:** `$department['title']`, `$department['description']`, `$department['url']`, `$department['icon']`
- **Outputs:** Card HTML with link
- **Dependencies:** None

### Testimonial
- **File:** `template-parts/content/testimonial.php`
- **Inputs:** `$testimonial['quote']`, `$testimonial['author']`, `$testimonial['role']`, `$testimonial['avatar']`
- **Outputs:** Testimonial card HTML
- **Dependencies:** None

### Gallery
- **File:** `template-parts/components/gallery.php`
- **Inputs:** `$args['ids']`, `$args['columns']`, `$args['size']`, `$args['link']`, `$args['layout']`
- **Outputs:** WordPress gallery shortcode output
- **Dependencies:** WordPress gallery shortcode

### Responsive Image
- **File:** `template-parts/components/responsive-image.php`
- **Inputs:** `$args['image_id']` or `$args['image_url']`, `$args['alt']`, `$args['size']`, `$args['show_caption']`
- **Outputs:** `<img>` with srcset
- **Dependencies:** WordPress image functions

### Video Embed
- **File:** `template-parts/components/video-embed.php`
- **Inputs:** `$url`
- **Outputs:** YouTube/Vimeo iframe or self-hosted video
- **Dependencies:** None

### Video Gallery
- **File:** `template-parts/components/video-gallery.php`
- **Inputs:** `$args['videos']` array, `$args['columns']`
- **Outputs:** Grid of video thumbnails with modal
- **Dependencies:** Inline JS for modal

### CTA Section
- **File:** `template-parts/sections/whatsapp-cta.php`
- **Inputs:** Filter `novira_whatsapp_cta`
- **Outputs:** WhatsApp CTA section
- **Dependencies:** Customizer WhatsApp number

### Navigation
- **File:** `template-parts/layout/header.php`
- **Inputs:** `novira_header_menu()` function
- **Outputs:** Primary nav with logo, menu, CTA
- **Dependencies:** WordPress nav menus, `novira_fallback_menu()`

### Quote Request Form
- **File:** `template-parts/components/quote-request-form.php`
- **Inputs:** None (self-contained)
- **Outputs:** AJAX form
- **Dependencies:** `form-validation.js`, `novira_handle_quote_request()` AJAX handler

### Registration Interest Form
- **File:** `template-parts/components/registration-interest-form.php`
- **Inputs:** None (self-contained)
- **Outputs:** AJAX form
- **Dependencies:** `registration-validation.js`, `novira_handle_registration_interest()` AJAX handler

### Pricing Table
- **File:** `template-parts/components/pricing-table.php`
- **Inputs:** `$pricing` array
- **Outputs:** Pricing comparison table
- **Dependencies:** None

---

## 7. CUSTOMIZER AUDIT

### Global Settings

| Setting | Section | Default | Type | Status |
|---------|---------|---------|------|--------|
| `novira_whatsapp` | Contact | `201090600927` | text | ✅ Correct |
| `novira_email` | Contact | `noviraacademy@gmail.com` | email | ✅ Correct |
| `novira_phone` | Contact | `01090600927` | text | ✅ Correct |
| `novira_address` | Contact | (Arabic address) | textarea | ✅ Correct |
| `novira_facebook` | Social | Facebook URL | url | ✅ Correct |
| `novira_instagram` | Social | Instagram URL | url | ✅ Correct |
| `novira_tiktok` | Social | TikTok URL | url | ✅ Correct |
| `novira_youtube` | Social | YouTube URL | url | ✅ Correct |
| `novira_primary_color` | Colors | `#5B14E6` | color | ✅ Correct |
| `novira_secondary_color` | Colors | `#2196FF` | color | ✅ Correct |
| `novira_copyright` | Footer | `جميع الحقوق محفوظة` | text | ✅ Correct |

### Homepage Settings
**NONE** — Homepage content is managed through WordPress pages. ✅ Correct per Constitution Principle #6.

### Department Settings
**NONE** — Department content is managed through custom fields on pages. ✅ Correct.

### Settings That Should NOT Be in Customizer
**NONE found.** All settings are appropriate global configuration.

### Customizer Issues
1. **YouTube URL typo:** Default is `https://www.youtube.com/@noviraacadem` (missing 'y') — `inc/customizer.php:144`
2. **No transport for social links:** All social settings use `'transport' => 'refresh'` — could use `'postMessage'` for better UX
3. **No color output for social links:** The `novira_customizer_css()` function only outputs primary/secondary colors, not social link colors

---

## 8. PLUGIN DEPENDENCIES

### Required Plugins
**NONE** — Theme is fully self-contained using WordPress native features.

### Optional Plugins
**NONE currently.**

### Future Plugins
| Plugin | Status | Location |
|--------|--------|----------|
| Microsoft Forms Integration | **STUB** | `plugins/microsoft-forms-integration/microsoft-forms-integration.php` |

### Internal Plugin Stubs
| Component | File | Status |
|-----------|------|--------|
| Novira_Microsoft_Forms_Integration | `plugins/microsoft-forms-integration/microsoft-forms-integration.php` | Registered provider, settings page, embed filter — but no actual Microsoft Graph API integration |

---

## 9. HARDCODED DATA AUDIT

### Hardcoded Phone Numbers

| Value | File:Line | Context |
|-------|-----------|---------|
| `201090600927` | `front-page.php:29` | WhatsApp floating button default |
| `201090600927` | `template-parts/sections/hero.php:37` | Hero CTA default |
| `201090600927` | `template-parts/sections/whatsapp-cta.php:17` | WhatsApp CTA default |
| `201090600927` | `template-parts/sections/department-whatsapp.php:15` | Department WhatsApp default |
| `01090600927` | `inc/customizer.php:71` | Customizer default |
| `01090600927` | `template-parts/layout/footer.php:17` | Footer phone display |
| `01090600927` | `page-contact.php:25,33` | Contact page |
| `01556810736` | `page-contact.php:28,33` | Contact page secondary phone |
| `+201090600927` | `readme.txt:85` | Readme |
| `+201090600927` | `template-parts/cta-final.php:10` | CTA final |

### Hardcoded Email Addresses

| Value | File:Line | Context |
|-------|-----------|---------|
| `noviraacademy@gmail.com` | `inc/customizer.php:58` | Customizer default |
| `noviraacademy@gmail.com` | `template-parts/layout/footer.php:16` | Footer |
| `noviraacademy@gmail.com` | `page-contact.php:35,39` | Contact page |
| `noviraacademy@gmail.com` | `template-parts/cta-final.php:15` | CTA final |
| `noviraacademy@gmail.com` | `readme.txt:84` | Readme |

### Hardcoded URLs

| Value | File:Line | Context |
|-------|-----------|---------|
| `https://www.facebook.com/noviraacademy` | `inc/customizer.php:105` | Customizer default |
| `https://www.facebook.com/noviraacademy` | `template-parts/layout/footer.php:19` | Footer |
| `https://www.facebook.com/noviraacademy` | `page-contact.php:42` | Contact page |
| `https://www.instagram.com/noviraacademy/` | `inc/customizer.php:118` | Customizer default |
| `https://www.instagram.com/noviraacademy/` | `template-parts/layout/footer.php:20` | Footer |
| `https://www.tiktok.com/@noviraacademy` | `inc/customizer.php:131` | Customizer default |
| `https://www.tiktok.com/@noviraacademy` | `template-parts/layout/footer.php:21` | Footer |
| `https://www.youtube.com/@noviraacadem` | `inc/customizer.php:144` | Customizer default (TYPO) |
| `https://www.youtube.com/@noviraacadem` | `template-parts/layout/footer.php:22` | Footer (TYPO) |
| `https://www.google.com/maps?q=28.4988907,30.8024849` | `page-contact.php:93` | Google Maps embed |
| `https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Noto+Kufi+Arabic:wght@400;600;700;800;900&display=swap` | `functions.php:116` | Google Fonts |

### Hardcoded Address

| Value | File:Line |
|-------|-----------|
| `المنيا، بني مزار، طريق الإبراهيمية، آخر شارع مستشفى أبو عوف` | `inc/customizer.php:84` (default) |
| `المنيا، بني مزار، طريق الإبراهيمية، آخر شارع مستشفى أبو عوف` | `template-parts/layout/footer.php:18` |
| `المنيا - بني مزار - طريق الإبراهيمية - آخر شارع مستشفى أبو عوف` | `page-contact.php:53` |

### Hardcoded Statistics

| Value | File:Line | Context |
|-------|-----------|---------|
| `+500` | `template-parts/sections/hero.php:84` | Students count |
| `+50` | `template-parts/sections/hero.php:88` | Courses count |
| `+10` | `template-parts/sections/hero.php:92` | Years count |
| `+500` | `template-parts/sections/trust-proof.php:110` | Trust badge |
| `+10` | `template-parts/sections/trust-proof.php:119` | Trust badge |

### Hardcoded Working Hours

| Value | File:Line |
|-------|-----------|
| `10:00 ص - 10:00 م` | `page-contact.php:102` |
| `1:00 م - 10:00 م` | `page-contact.php:103` |

### Hardcoded Default Testimonials

| Location | Count |
|----------|-------|
| `template-parts/sections/trust-proof.php:55-75` | 3 testimonials |
| `template-parts/sections/hero.php:84-93` | 3 statistics |

---

## 10. PLACEHOLDER CONTENT AUDIT

### Placeholder Images
**NONE** — All images are loaded from WordPress media library or external sources.

### Placeholder Videos
**NONE** — Videos are loaded from YouTube/Vimeo URLs.

### Dummy Testimonials
| Location | Content | Status |
|----------|---------|--------|
| `template-parts/sections/trust-proof.php:55-75` | 3 static testimonials with Arabic names | **DUMMY** — Used as fallback when no dynamic content exists |
| `template-parts/sections/trust-proof.php:92-120` | 3 trust badges | **DUMMY** — Hardcoded badge values |

### Dummy Statistics
| Location | Content | Status |
|----------|---------|--------|
| `template-parts/sections/hero.php:84` | `+500` students | **DUMMY** |
| `template-parts/sections/hero.php:88` | `+50` courses | **DUMMY** |
| `template-parts/sections/hero.php:92` | `+10` years | **DUMMY** |

### Fake Content
| Location | Content | Status |
|----------|---------|--------|
| `template-parts/portal/dashboard.php:36,47,56` | `0` values for stats | **PLACEHOLDER** |
| `template-parts/portal/login.php` | Static login form | **PLACEHOLDER** |

### Sample Content
**NONE** — No WordPress sample content is imported.

---

## 11. FUTURE STUBS

### Student Portal
- **Files:** `template-parts/portal/login.php`, `template-parts/portal/dashboard.php`
- **Status:** **STUB** — Static HTML only, no backend functionality
- **What exists:** Login form UI, dashboard layout with stat cards
- **What's missing:** Authentication system, session management, database schema, API endpoints

### Student Authentication
- **File:** `inc/student-auth-hooks.php`
- **Status:** **STUB** — Complete class with all hooks documented, zero implementation
- **What exists:** `Novira_Student_Auth` class with singleton pattern, hook registration, capability definitions
- **What's missing:** Actual authentication logic, user role creation, session handling

### External Exam Integration
- **File:** `inc/exam-integration.php`
- **Status:** **PARTIAL** — Architecture complete, no actual exam providers
- **What exists:** `Novira_Exam_Integration` class, `novira_exam` CPT, provider registration system
- **What's missing:** Actual provider implementations, score retrieval, API integrations

### Microsoft Forms
- **File:** `plugins/microsoft-forms-integration/microsoft-forms-integration.php`
- **Status:** **STUB** — Plugin skeleton with settings page
- **What exists:** Admin settings page, provider registration, embed filter
- **What's missing:** Microsoft Graph API authentication, form embedding, score retrieval

### Future APIs
- **Status:** **NOT STARTED**
- **What exists:** Extensibility hooks and filters throughout
- **What's missing:** REST API endpoints, webhook handlers, external service integrations

---

## 12. TECHNICAL DEBT REPORT

### CRITICAL

| ID | Issue | Location | Impact | Effort |
|----|-------|----------|--------|--------|
| TD-001 | Inline `<script>` tags in meta boxes | `inc/custom-fields.php:120-412` | Cannot be cached, CSP violations, XSS risk | Medium — Move to admin JS file |
| TD-002 | Inline `<style>` tags in meta boxes | `inc/custom-fields.php:93-434`, `inc/custom-post-types.php:166-169` | Cannot be cached, violates separation of concerns | Low — Move to admin CSS file |
| TD-003 | File-based logging without rotation | `inc/form-handling.php:105`, `inc/registration-handling.php:96` | Files grow unbounded, potential disk space exhaustion | Medium — Use options table or implement rotation |
| TD-004 | Duplicate form handlers | `inc/form-handling.php` vs `inc/translation-request-handler.php` | Code duplication, maintenance burden | High — Consolidate into unified handler |

### HIGH

| ID | Issue | Location | Impact | Effort |
|----|-------|----------|--------|--------|
| TD-005 | Self-require in `custom-post-types.php` | `inc/custom-post-types.php:224` | Redundant file inclusion | Low — Remove line |
| TD-006 | `variables.css` and `media-components.css` loaded globally | `functions.php:177-188` | Unnecessary CSS on all pages | Low — Make conditional |
| TD-007 | No rate limiting on AJAX forms | All AJAX handlers | Vulnerable to spam/abuse | Medium — Implement rate limiting |
| TD-008 | No CAPTCHA or honeypot on forms | All form components | Vulnerable to bot submissions | Medium — Add honeypot fields |
| TD-009 | `novira_sanitize_{$field_name}` filter hook in sanitization | `inc/translation-request-sanitization.php:22,63` | Dynamic hook name is non-standard | Low — Use static hook name |

### MEDIUM

| ID | Issue | Location | Impact | Effort |
|----|-------|----------|--------|--------|
| TD-010 | Legacy root-level template stubs | `template-parts/*.php` (root) | Confusion about which templates are active | Low — Remove unused stubs |
| TD-011 | `page-contact.php`, `page-about.php`, `page-services.php` are self-contained | Root templates | Cannot reuse components, hardcoded content | High — Refactor to use template parts |
| TD-012 | No error logging infrastructure | Throughout | Difficult to debug in production | Medium — Implement error logging |
| TD-013 | Google Maps embed without sandbox | `page-contact.php:92-96` | Security risk from external iframe | Low — Add sandbox attribute |
| TD-014 | `novira_get_client_ip()` trusts `HTTP_CLIENT_IP` and `HTTP_X_FORWARDED_FOR` | `inc/form-handling.php:160-163` | IP spoofing possible | Low — Use `REMOTE_ADDR` only |
| TD-015 | Password passed as plaintext in action hook | `inc/student-auth-hooks.php:220` | Security risk if hook is logged | Low — Don't pass password |

### LOW

| ID | Issue | Location | Impact | Effort |
|----|-------|----------|--------|--------|
| TD-016 | `editor.css` is empty (43 bytes) | `assets/css/editor.css` | Unused file | Low — Remove or populate |
| TD-017 | `single.php` uses `get_the_category()` not `get_the_category()` for `blog_post` CPT | `single.php:20` | May not work correctly with custom taxonomy | Low — Use `get_the_terms()` with `blog_category` |
| TD-018 | Reading time calculation uses `str_word_count()` | `single.php:52` | May not work correctly with Arabic text | Medium — Use character count for Arabic |
| TD-019 | No `wp_reset_postdata()` after main loop in `single.php` | `single.php` | Minor — single post context doesn't need it | None |
| TD-020 | `novira_excerpt_length` filter at priority 999 | `functions.php:297` | May override other plugins unexpectedly | Low — Use lower priority |

---

## 13. CONSTITUTION COMPLIANCE AUDIT

### Principle #1: Trust Before Conversion
**PASS** ✅
- Hero section prioritizes institutional headline over CTA
- Testimonials section builds social proof
- Trust badges display institutional credentials
- WhatsApp CTA is secondary, not primary

### Principle #2: Real Content Before Decorative Design
**WARNING** ⚠️
- **Issue:** Static fallback testimonials exist (`trust-proof.php:55-75`)
- **Issue:** Hardcoded statistics in hero (`hero.php:84-93`)
- **Mitigation:** Filter system allows plugins to provide real content
- **Impact:** Site shows dummy data until real content is configured

### Principle #3: Institutional Identity
**PASS** ✅
- Typography: Almarai + Noto Kufi Arabic (institutional feel)
- Color palette: Purple primary, Blue secondary (professional)
- No SaaS/AI/crypto design patterns
- Documentary/institutional aesthetic throughout

### Principle #4: Homepage Philosophy
**PASS** ✅
- Homepage only has: Hero → Departments → Trust → Gallery → Posts → Events → CTA
- No conversion forms on homepage
- Department pages handle detailed content and conversion

### Principle #5: Information Architecture
**PASS** ✅
- Clear hierarchy: Homepage → Departments → Blog → Events
- Each section has distinct purpose
- Department pages route by slug

### Principle #6: WordPress Architecture
**PASS** ✅
- Custom theme, no page builders
- Modular template parts
- Reusable components
- RTL support
- Mobile-first CSS

### Principle #7: Authenticity Rule
**PASS** ✅
- No AI-generated content
- No decorative stock images
- Components designed for real photos/videos
- Filter system allows real content injection

### Principle #8: Scalability
**PASS** ✅
- Hook and filter system for extensibility
- CPT architecture for future content types
- Exam integration architecture ready
- Student auth hooks documented

### Principle #9: Design Consistency
**PASS** ✅
- Single `main.css` design system
- Consistent component styling
- CSS custom properties for theming
- RTL support throughout

### Principle #10: Non-Negotiable Rule
**WARNING** ⚠️
- **Issue:** No real photos/videos/testimonials configured
- **Mitigation:** Architecture supports real content
- **Impact:** Cannot verify real-world representation until content is added

**Overall Constitution Score: 8/10 PASS, 2/10 WARNING**

---

## 14. SPECIFICATION COMPLIANCE AUDIT

### Functional Requirements

| Req ID | Requirement | Status | Notes |
|--------|-------------|--------|-------|
| FR-001 | Homepage displays trust-building content | ✅ Implemented | Hero, testimonials, trust badges |
| FR-002 | Department pages with specific content | ✅ Implemented | Education, Translation, Diploma |
| FR-003 | Blog with categories | ✅ Implemented | `blog_post` CPT with `blog_category` |
| FR-004 | Events with types | ✅ Implemented | `event` CPT with `event_type` |
| FR-005 | Contact information display | ✅ Implemented | Customizer + hardcoded |
| FR-006 | WhatsApp integration | ✅ Implemented | Floating button + CTA sections |
| FR-007 | Translation request form | ✅ Implemented | AJAX form with validation |
| FR-008 | Registration interest form | ✅ Implemented | AJAX form with validation |
| FR-009 | Student portal | ⚠️ Placeholder | Static HTML only |
| FR-010 | External exam integration | ⚠️ Architecture only | No actual providers |
| FR-011 | Microsoft Forms integration | ⚠️ Stub only | Plugin skeleton |
| FR-012 | RTL support | ✅ Implemented | `rtl.css` + CSS logical properties |
| FR-013 | Mobile-first responsive | ✅ Implemented | CSS media queries |
| FR-014 | WordPress best practices | ✅ Implemented | Nonces, escaping, sanitization |

### User Stories

| Story | Status | Notes |
|-------|--------|-------|
| Parent discovers academy via search | ✅ | SEO-friendly templates |
| Parent explores departments | ✅ | Department navigation |
| Parent contacts via WhatsApp | ✅ | Multiple WhatsApp CTAs |
| Parent requests translation quote | ✅ | AJAX form |
| Parent registers interest in diploma | ✅ | AJAX form |
| Student accesses portal | ⚠️ | Placeholder only |
| Student takes exam | ❌ | Not implemented |
| Admin manages content | ✅ | WordPress admin |

### Deviations from Specification

1. **Student Portal** — Specified as functional, implemented as placeholder
2. **Exam Integration** — Specified as integration, implemented as architecture only
3. **Microsoft Forms** — Specified as plugin, implemented as stub
4. **Blog Comments** — CPT supports comments but no comment template customization
5. **Search Enhancement** — Basic WordPress search only, no custom search

---

## 15. FUTURE REFACTORING ROADMAP

### Sprint 1: Theme Foundation
**Goal:** Clean up technical debt in core theme files

1. **Remove self-require** in `inc/custom-post-types.php:224`
2. **Move inline JS** from `inc/custom-fields.php` to `assets/js/admin/meta-boxes.js`
3. **Move inline CSS** from `inc/custom-fields.php` to `assets/css/admin/meta-boxes.css`
4. **Remove unused legacy stubs** from `template-parts/` root
5. **Make `variables.css` and `media-components.css` conditional** (only load when needed)
6. **Remove empty `editor.css`** or populate it
7. **Fix YouTube URL typo** in customizer default

### Sprint 2: Homepage
**Goal:** Remove hardcoded dummy data

1. **Move hardcoded statistics** to Customizer settings or WordPress options
2. **Create `testimonial` CPT** or use pages with custom template (instead of static fallback)
3. **Make trust badges configurable** via Customizer
4. **Add real photo/video placeholders** with admin instructions
5. **Refactor `page-about.php`, `page-contact.php`, `page-services.php`** to use template parts

### Sprint 3: WordPress Content Model
**Goal:** Consolidate and improve content architecture

1. **Consolidate form handlers** (`form-handling.php` + `translation-request-handler.php`)
2. **Implement file-based logging rotation** or migrate to database
3. **Add rate limiting** to AJAX handlers
4. **Add honeypot fields** to all forms
5. **Fix `single.php`** to use `get_the_terms()` with `blog_category` taxonomy
6. **Improve Arabic reading time** calculation

### Sprint 4: Translation
**Goal:** Clean up translation workflow

1. **Review `novira_sanitize_{$field_name}` dynamic hook** — consider static alternative
2. **Consolidate sanitization functions** with WordPress native functions
3. **Add email template system** for notification customization
4. **Implement log viewer** in WordPress admin

### Sprint 5: American Diploma
**Goal:** Improve department page architecture

1. **Review meta box architecture** — consider CPT-based approach instead of page meta
2. **Add validation for repeater fields** (currently only server-side)
3. **Implement admin UI** for managing curriculum/pricing data

### Sprint 6: Blog & Events
**Goal:** Improve blog and event functionality

1. **Add comment template** for blog posts
2. **Implement custom search** with relevance ranking
3. **Add social sharing** buttons
4. **Implement related posts** functionality

### Sprint 7: Media
**Goal:** Improve media handling

1. **Implement lightbox** for gallery component
2. **Add video thumbnail generation** for self-hosted videos
3. **Implement media library organization** with media categories
4. **Add image optimization** recommendations

### Sprint 8: Future Architecture
**Goal:** Complete student portal and exam integration

1. **Implement student authentication** system
2. **Build student portal** with login, dashboard, course progress
3. **Implement exam integration** with actual providers
4. **Complete Microsoft Forms** plugin with Graph API
5. **Add REST API endpoints** for external integrations

---

## FINAL SUMMARY

### Scores

| Metric | Score | Notes |
|--------|-------|-------|
| **Overall Architecture** | **72/100** | Solid foundation, good patterns, but has technical debt and placeholder content |
| **Production Readiness** | **45/100** | Requires real content, missing student portal, forms need rate limiting |
| **Maintainability** | **68/100** | Good separation of concerns, but inline scripts/styles and duplicate handlers |
| **WordPress Best Practices** | **82/100** | Good security (nonces, escaping, sanitization), proper hooks, no raw SQL |
| **AI-generated Technical Debt** | **35/100** | Significant: inline JS/CSS, duplicate handlers, file logging, placeholder content |

### Final Verdict

# ⚠️ PROTOTYPE

**Reasoning:**
- The architecture is sound and follows WordPress best practices
- Security fundamentals are in place (nonces, escaping, sanitization)
- The hook/filter system provides good extensibility
- **However:** The codebase contains significant placeholder content, duplicate handlers, inline scripts, and unfinished features that prevent production deployment
- **Required before production:** Real content, rate limiting, consolidated form handlers, student portal implementation, exam integration

**This codebase is a well-structured prototype ready for the refactoring phase.**

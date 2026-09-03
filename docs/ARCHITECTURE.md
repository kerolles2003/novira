# Novira Academy Theme - Complete Architectural Inventory

## File Tree

```
novira-theme/
├── assets/
│   ├── css/
│   │   ├── main.css
│   │   ├── homepage.css
│   │   ├── rtl.css
│   │   ├── editor.css
│   │   ├── blog-events.css
│   │   ├── department-education.css
│   │   ├── department-translation.css
│   │   ├── department-american-diploma.css
│   │   ├── translation-workflow.css
│   │   ├── media-components.css
│   │   └── variables.css
│   └── js/
│       ├── navigation.js
│       ├── main.js
│       ├── customizer-preview.js
│       ├── form-validation.js
│       └── registration-validation.js
├── docs/
│   ├── translation-workflow.md
│   ├── student-portal-extension.md
│   ├── media-guidelines.md
│   └── exam-integration.md
├── inc/
│   ├── customizer.php
│   ├── custom-fields.php
│   ├── custom-post-types.php
│   ├── form-handling.php
│   ├── registration-handling.php
│   ├── translation-request-handler.php
│   ├── translation-request-sanitization.php
│   ├── translation-request-logging.php
│   ├── hooks.php
│   ├── media-categories.php
│   ├── featured-images.php
│   ├── media-functions.php
│   ├── exam-integration.php
│   └── student-auth-hooks.php
├── languages/
│   └── novira-academy.pot
├── plugins/
│   └── microsoft-forms-integration/
│       └── microsoft-forms-integration.php
├── template-parts/
│   ├── layout/
│   │   ├── header.php
│   │   └── footer.php
│   ├── sections/
│   │   ├── hero.php
│   │   ├── department-nav.php
│   │   ├── department-hero.php
│   │   ├── department-education.php
│   │   ├── department-translation.php
│   │   ├── department-american-diploma.php
│   │   ├── department-whatsapp.php
│   │   ├── admission-details.php
│   │   ├── trust-proof.php
│   │   ├── media-gallery.php
│   │   ├── whatsapp-cta.php
│   │   ├── latest-posts.php
│   │   └── upcoming-events.php
│   ├── content/
│   │   ├── program-card.php
│   │   ├── course-card.php
│   │   ├── service-card.php
│   │   ├── pricing-table.php
│   │   ├── curriculum.php
│   │   ├── admission-process.php
│   │   ├── blog-post-card.php
│   │   ├── event-card.php
│   │   ├── department-card.php
│   │   └── testimonial.php
│   ├── components/
│   │   ├── gallery.php
│   │   ├── responsive-image.php
│   │   ├── video-gallery.php
│   │   ├── video-embed.php
│   │   ├── quote-request-form.php
│   │   ├── registration-interest-form.php
│   │   ├── form-success-message.php
│   │   └── form-error-message.php
│   ├── portal/
│   │   ├── login.php
│   │   └── dashboard.php
│   └── (root-level stubs)
│       ├── departments.php
│       ├── cta.php
│       ├── cta-final.php
│       ├── translation.php
│       ├── translation-highlight.php
│       ├── testimonials.php
│       ├── services-grid.php
│       ├── blog-activity.php
│       ├── page-hero.php
│       ├── proof-strip.php
│       ├── hero-documentary.php
│       ├── diploma.php
│       └── diploma-highlight.php
├── style.css
├── functions.php
├── front-page.php
├── page-department.php
├── page-contact.php
├── page-about.php
├── page-services.php
├── page.php
├── single.php
├── archive.php
├── search.php
├── index.php
├── header.php
├── footer.php
├── readme.txt
└── docker-compose.yml
```

---

## Custom Post Types

| CPT Slug | Label | Public | Archive | Menu Position | Registered In |
|----------|-------|--------|---------|---------------|---------------|
| `blog_post` | المقالات | Yes | `/blog/` | 20 | `inc/custom-post-types.php` |
| `event` | الأحداث | Yes | `/events/` | 21 | `inc/custom-post-types.php` |
| `novira_quote` | عروض الأسعار | No | No | 25 | `inc/form-handling.php` |
| `novira_registration` | طلبات التسجيل | No | No | 26 | `inc/registration-handling.php` |
| `novira_translation_request` | طلبات الترجمة | No | No | 27 | `inc/translation-request-handler.php` |
| `novira_exam` | الامتحانات | No | No | 25 | `inc/exam-integration.php` |

---

## Taxonomies

| Taxonomy | Label | Attached To | Hierarchical | Slug |
|----------|-------|-------------|--------------|------|
| `blog_category` | تصنيفات المقالات | `blog_post` | Yes | `/blog-category/` |
| `event_type` | أنواع الأحداث | `event` | Yes | `/event-type/` |
| `media_category` | تصنيفات الوسائط | `attachment` | Yes | `/media-category/` |

### Default Media Categories
- `education` - التعليم
- `translation` - الترجمة
- `diploma` - الدبلوم الأمريكي
- `events` - الأحداث
- `blog` - المدونة
- `gallery` - المعرض
- `team` - الفريق
- `testimonials` - الشهادات

---

## WordPress Hooks

### Action Hooks

| Hook | Location | Parameters | Purpose |
|------|----------|------------|---------|
| `after_setup_theme` | `functions.php:72` | - | Theme setup |
| `widgets_init` | `functions.php:108` | - | Register widget areas |
| `wp_enqueue_scripts` | `functions.php:215` | - | Enqueue assets |
| `wp_head` | `functions.php:273` | - | Pingback header |
| `init` | `inc/custom-post-types.php:76,139` | - | Register CPTs |
| `init` | `inc/customizer.php:208` | `$wp_customize` | Register customizer |
| `save_post` | `inc/custom-post-types.php:219` | `$post_id` | Save event meta |
| `add_meta_boxes` | `inc/custom-post-types.php:154` | - | Add event meta boxes |
| `add_meta_boxes` | `inc/custom-fields.php:73` | - | Add department meta boxes |
| `save_post` | `inc/custom-fields.php:563` | `$post_id` | Save department meta |
| `customize_register` | `inc/customizer.php:208` | `$wp_customize` | Register customizer settings |
| `customize_preview_init` | `inc/customizer.php:237` | - | Enqueue customizer preview JS |
| `wp_ajax_novira_quote_request` | `inc/form-handling.php:152` | - | Handle quote request AJAX |
| `wp_ajax_nopriv_novira_quote_request` | `inc/form-handling.php:153` | - | Handle quote request AJAX (logged out) |
| `wp_ajax_novira_registration_interest` | `inc/registration-handling.php:139` | - | Handle registration interest AJAX |
| `wp_ajax_nopriv_novira_registration_interest` | `inc/registration-handling.php:140` | - | Handle registration interest AJAX (logged out) |
| `wp_ajax_novira_translation_request` | `inc/translation-request-handler.php:81` | - | Handle translation request AJAX |
| `wp_ajax_nopriv_novira_translation_request` | `inc/translation-request-handler.php:82` | - | Handle translation request AJAX (logged out) |
| `init` | `inc/media-categories.php:61` | - | Register media category taxonomy |
| `after_setup_theme` | `inc/featured-images.php:137` | - | Register custom image sizes |
| `plugins_loaded` | `plugins/microsoft-forms-integration/microsoft-forms-integration.php` | - | Initialize MS Forms plugin |

### Student Auth Action Hooks (Stub)

| Hook | Parameters | Purpose |
|------|------------|---------|
| `novira_student_login` | `$user_id`, `$user_data` | Triggered on student login |
| `novira_student_logout` | `$user_id` | Triggered on student logout |
| `novira_student_register` | `$user_id`, `$user_data` | Triggered on student registration |
| `novira_student_session_start` | `$user_id` | Session start |
| `novira_student_session_end` | `$user_id` | Session end |
| `novira_student_password_reset` | `$user_id`, `$new_password` | Password reset |
| `novira_student_profile_update` | `$user_id`, `$profile_data` | Profile update |

---

## Filters

### Active Filters (Applied in Code)

| Filter | Location | Parameters | Purpose |
|--------|----------|------------|---------|
| `body_class` | `functions.php:289` | `$classes` | Add custom body classes |
| `excerpt_length` | `functions.php:297` | `$length` | Custom excerpt length (25) |
| `excerpt_more` | `functions.php:305` | `$more` | Custom excerpt more character |
| `novira_content_width` | `functions.php:67` | `$width` | Content width (1200) |
| `novira_validate_translation_request` | `inc/translation-request-handler.php:28` | `$result`, `$post_data` | Validate translation request |
| `novira_sanitize_translation_request` | `inc/translation-request-handler.php:36` | `$data` | Sanitize translation request |
| `novira_before_process_translation_request` | `inc/translation-request-handler.php:59` | `$data` | Before processing |
| `novira_before_store_translation_request` | `inc/translation-request-handler.php:131` | `$data` | Before storage |
| `novira_send_translation_notifications` | `inc/translation-request-handler.php:156` | `$send`, `$request_id`, `$data` | Toggle notifications |
| `novira_translation_notification_template` | `inc/translation-request-handler.php:183` | `$template`, `$type`, `$data` | Custom email templates |
| `novira_is_student` | `inc/student-auth-hooks.php` | `$is_student`, `$user` | Check if user is student |
| `novira_student_data` | `inc/student-auth-hooks.php` | `$student_data`, `$user` | Filter student data |
| `novira_student_capabilities_filter` | `inc/student-auth-hooks.php` | `$capabilities`, `$role` | Add student capabilities |
| `novira_student_profile_data_filter` | `inc/student-auth-hooks.php` | `$profile_data`, `$user_id` | Filter profile data |
| `novira_exam_embed_code` | `inc/exam-integration.php` | `$embed_code`, `$exam_id`, `$provider` | Filter exam embed |
| `novira_gallery_output` | `template-parts/components/gallery.php` | `$output`, `$args` | Filter gallery output |
| `novira_detect_video_type` | `template-parts/components/video-gallery.php` | `$type`, `$url` | Detect video type |

### Documented Filters (Not Yet Applied)

| Filter | Parameters | Purpose |
|--------|------------|---------|
| `novira_homepage_testimonials` | `$testimonials` | Custom testimonials |
| `novira_homepage_gallery` | `$gallery_images` | Custom gallery images |
| `novira_whatsapp_cta` | `$cta_data` | Custom WhatsApp CTA |
| `novira_latest_posts_query` | `$args` | Modify latest posts query |
| `novira_upcoming_events_query` | `$args` | Modify upcoming events query |
| `novira_available_languages` | `$languages` | Custom languages list |
| `novira_available_services` | `$services` | Custom services list |

---

## Template Hierarchy

### WordPress Templates Used

| Template | File | Purpose |
|----------|------|---------|
| Front Page | `front-page.php` | Homepage |
| Page Template | `page-department.php` | Department pages (Education, Translation, Diploma) |
| Page Template | `page-contact.php` | Contact page |
| Page Template | `page-about.php` | About page |
| Page Template | `page-services.php` | Services page |
| Default Page | `page.php` | Default page template |
| Single Post | `single.php` | Single blog post |
| Archive | `archive.php` | Blog/events archives |
| Search | `search.php` | Search results |
| Index | `index.php` | Fallback template |
| Header | `header.php` | Site header |
| Footer | `footer.php` | Site footer |

### Template Parts

#### Layout (`template-parts/layout/`)
- `header.php` - Navigation markup
- `footer.php` - Footer content

#### Sections (`template-parts/sections/`)
- `hero.php` - Hero section (front page)
- `department-nav.php` - Department navigation
- `department-hero.php` - Department hero with breadcrumbs
- `department-education.php` - Education programs/courses
- `department-translation.php` - Translation services/pricing
- `department-american-diploma.php` - Diploma curriculum/admission
- `department-whatsapp.php` - Department WhatsApp CTA
- `admission-details.php` - Admission details
- `trust-proof.php` - Testimonials section
- `media-gallery.php` - Media gallery section
- `whatsapp-cta.php` - WhatsApp CTA section
- `latest-posts.php` - Latest blog posts
- `upcoming-events.php` - Upcoming events

#### Content (`template-parts/content/`)
- `program-card.php` - Education program card
- `course-card.php` - Education course card
- `service-card.php` - Translation service card
- `pricing-table.php` - Pricing comparison table
- `curriculum.php` - Diploma curriculum card
- `admission-process.php` - Admission process steps
- `blog-post-card.php` - Blog post card
- `event-card.php` - Event card with date badge
- `department-card.php` - Reusable department card
- `testimonial.php` - Testimonial card

#### Components (`template-parts/components/`)
- `gallery.php` - WordPress gallery shortcode integration
- `responsive-image.php` - Responsive image with srcset
- `video-gallery.php` - Video gallery (YouTube/Vimeo/self-hosted)
- `video-embed.php` - Single video embed
- `quote-request-form.php` - Translation quote form (AJAX)
- `registration-interest-form.php` - Diploma registration form (AJAX)
- `form-success-message.php` - Reusable success message
- `form-error-message.php` - Reusable error message

#### Portal (`template-parts/portal/`)
- `login.php` - Student portal login (placeholder)
- `dashboard.php` - Student portal dashboard (placeholder)

---

## Customizer Settings

### Panel: Novira Academy
**ID:** `novira_panel`

#### Section: Contact Information
**ID:** `novira_contact`

| Setting | Control | Default | Sanitization |
|---------|---------|---------|--------------|
| `novira_whatsapp` | Text | `201090600927` | `sanitize_text_field` |
| `novira_email` | Email | `noviraacademy@gmail.com` | `sanitize_email` |
| `novira_phone` | Text | `01090600927` | `sanitize_text_field` |
| `novira_address` | Textarea | `المنيا، بني مزار، طريق الإبراهيمية...` | `sanitize_text_field` |

#### Section: Social Media
**ID:** `novira_social`

| Setting | Control | Default | Sanitization |
|---------|---------|---------|--------------|
| `novira_facebook` | URL | `https://www.facebook.com/noviraacademy` | `esc_url_raw` |
| `novira_instagram` | URL | `https://www.instagram.com/noviraacademy/` | `esc_url_raw` |
| `novira_tiktok` | URL | `https://www.tiktok.com/@noviraacademy` | `esc_url_raw` |
| `novira_youtube` | URL | `https://www.youtube.com/@noviraacadem` | `esc_url_raw` |

#### Section: Theme Colors
**ID:** `novira_colors`

| Setting | Control | Default | Sanitization |
|---------|---------|---------|--------------|
| `novira_primary_color` | Color | `#5B14E6` | `sanitize_hex_color` |
| `novira_secondary_color` | Color | `#2196FF` | `sanitize_hex_color` |

#### Section: Footer Settings
**ID:** `novira_footer`

| Setting | Control | Default | Sanitization |
|---------|---------|---------|--------------|
| `novira_copyright` | Text | `جميع الحقوق محفوظة` | `sanitize_text_field` |

---

## Custom Fields (Meta Boxes)

### Department Pages (`page-department.php`)

#### Education Programs (`_education_programs`)
```php
[
  'title'        => string,
  'description'  => string,
  'duration'     => string,
  'requirements' => array,
]
```

#### Education Courses (`_education_courses`)
```php
[
  'title'       => string,
  'description' => string,
  'schedule'    => string,
]
```

#### Translation Services (`_translation_services`)
```php
[
  'type'        => string,
  'description' => string,
  'turnaround'  => string,
]
```

#### Translation Pricing (`_translation_pricing`)
```php
[
  'service'  => string,
  'price'    => string,
  'includes' => array,
]
```

#### Diploma Curriculum (`_diploma_curriculum`)
```php
[
  'subject'     => string,
  'grades'      => string,
  'hours'       => string,
  'description' => string,
]
```

#### Diploma Admission (`_diploma_admission`)
```php
[
  'deadlines' => array,
  'documents' => array,
]
```

### Events

| Meta Key | Type | Purpose |
|----------|------|---------|
| `_event_date` | string | Event date |
| `_event_time` | string | Event time |
| `_event_location` | string | Event location |

### CPT Meta

| CPT | Meta Keys |
|-----|-----------|
| `novira_quote` | All form submission fields |
| `novira_registration` | All form submission fields |
| `novira_translation_request` | All form submission fields |
| `novira_exam` | `_novira_exam_url`, `_novira_exam_duration`, `_novira_exam_passing_score`, `_novira_exam_provider` |

---

## Hardcoded Data

### Contact Information
- **WhatsApp:** `201090600927`
- **Email:** `noviraacademy@gmail.com`
- **Phone:** `01090600927`
- **Address:** `المنيا، بني مزار، طريق الإبراهيمية، آخر شارع مستشفى أبو عوف`

### Social Links
- **Facebook:** `https://www.facebook.com/noviraacademy`
- **Instagram:** `https://www.instagram.com/noviraacademy/`
- **TikTok:** `https://www.tiktok.com/@noviraacademy`
- **YouTube:** `https://www.youtube.com/@noviraacadem`

### Department Page Slugs
- `education` - قسم التعليم
- `translation` - قسم الترجمة
- `american-diploma` - الدبلوم الأمريكي

### CSS Custom Properties
```css
--primary: #5B14E6
--secondary: #2196FF
```

### Typography
- **Body:** Almarai
- **Display:** Noto Kufi Arabic

---

## Placeholder Content

### Front Page Sections
All sections use WordPress content with fallback defaults:
- Hero section reads from WordPress pages
- Department navigation queries pages by slug
- Testimonials use `apply_filters('novira_homepage_testimonials')` with static fallback
- Gallery uses `apply_filters('novira_homepage_gallery')` with WordPress media library
- WhatsApp CTA uses `apply_filters('novira_whatsapp_cta')` with customizer data

### Portal Templates
- `template-parts/portal/login.php` - Static HTML, no backend
- `template-parts/portal/dashboard.php` - Static HTML, no backend

### Exam Integration
- `novira_exam` CPT registered but no exam forms created
- Microsoft Forms plugin stub created

---

## Future Stubs

### Student Authentication
- **File:** `inc/student-auth-hooks.php`
- **Status:** Complete class with all hooks documented
- **Implementation:** None - all hooks are no-ops

### Student Portal
- **Files:** `template-parts/portal/login.php`, `template-parts/portal/dashboard.php`
- **Status:** Static HTML placeholders
- **Implementation:** None

### Exam Integration
- **File:** `inc/exam-integration.php`
- **Status:** Complete class with provider registration
- **Implementation:** Microsoft Forms stub

### Microsoft Forms Plugin
- **File:** `plugins/microsoft-forms-integration/microsoft-forms-integration.php`
- **Status:** Complete plugin skeleton
- **Implementation:** Settings page, provider registration, embed filter

### Future-ready CSS Variables
- **File:** `assets/css/variables.css`
- **Status:** Complete variable system
- **Implementation:** Variables defined but not used in main stylesheets

---

## Technical Debt

### Inline JavaScript in Meta Boxes
- **Files:** `inc/custom-fields.php`
- **Issue:** Inline `<script>` tags for dynamic meta box functionality
- **Impact:** Cannot be cached, violates CSP best practices
- **Recommendation:** Move to separate JS files

### Inline Styles in Meta Boxes
- **Files:** `inc/custom-fields.php`, `inc/custom-post-types.php`
- **Issue:** Inline `<style>` tags for meta box styling
- **Impact:** Cannot be cached, violates separation of concerns
- **Recommendation:** Move to admin CSS file

### Duplicate Form Handlers
- **Files:** `inc/form-handling.php`, `inc/translation-request-handler.php`
- **Issue:** Two similar quote/request form handlers with overlapping functionality
- **Impact:** Code duplication, maintenance burden
- **Recommendation:** Consolidate into single handler with type parameter

### File-based Logging
- **Files:** `inc/form-handling.php`, `inc/registration-handling.php`
- **Issue:** Logging to `WP_CONTENT_DIR` text files
- **Impact:** Files can grow unbounded, no rotation, no admin UI
- **Recommendation:** Use `novira_translation_request-logging.php` pattern (options table)

### No Rate Limiting
- **Files:** All AJAX handlers
- **Issue:** No rate limiting on form submissions
- **Impact:** Vulnerable to spam/abuse
- **Recommendation:** Implement rate limiting middleware

### No CAPTCHA
- **Files:** All form components
- **Issue:** No CAPTCHA or honeypot protection
- **Impact:** Vulnerable to bot submissions
- **Recommendation:** Add honeypot fields or reCAPTCHA

### Redundant CPT Registration
- **File:** `inc/custom-post-types.php` (line 224)
- **Issue:** File requires itself at the end
- **Impact:** Potential double inclusion (guarded by WordPress but unnecessary)

### Missing Error Handling
- **Files:** All form handlers
- **Issue:** Limited error handling and logging
- **Impact:** Difficult to debug in production
- **Recommendation:** Add comprehensive error logging

---

## Constitution Violations

### Principle #2: Real Content Before Decorative Design
- **Status:** ⚠️ Partial
- **Issue:** All sections use static fallback content
- **Evidence:** `trust-proof.php`, `media-gallery.php`, `whatsapp-cta.php` have hardcoded defaults
- **Impact:** Site will show placeholder content until real content is added

### Principle #4: Homepage Philosophy
- **Status:** ✅ Compliant
- **Evidence:** Front page only has trust-building and navigation sections

### Principle #6: WordPress Architecture
- **Status:** ✅ Compliant
- **Evidence:** Custom theme, modular template parts, no page builders

### Principle #8: Scalability
- **Status:** ✅ Compliant
- **Evidence:** Hooks and filters system, extensible architecture

### Principle #10: Non-Negotiable Rule
- **Status:** ⚠️ Partial
- **Issue:** No real photos, videos, or testimonials yet
- **Impact:** Cannot verify real-world representation

---

## Specification Violations

### Missing Features from Spec
1. **Student Portal** - Only placeholders, no functionality
2. **External Exam Integration** - Only architecture, no actual integration
3. **Microsoft Forms** - Only plugin stub
4. **Blog Comments** - CPT supports comments but no comment template customization
5. **Search Enhancement** - Basic WordPress search only

### Architecture Deviations
1. **CPT Registration** - Duplicate in `custom-post-types.php` (self-require at line 224)
2. **Form Handling** - Two separate handlers (`form-handling.php` and `translation-request-handler.php`)
3. **CSS Loading** - `variables.css` and `media-components.css` loaded on all pages (should be conditional)

### Missing Documentation
1. **No README** - Theme lacks installation/setup documentation
2. **No CHANGELOG** - No version history
3. **No CONTRIBUTING** - No contribution guidelines

---

## Summary Statistics

| Category | Count |
|----------|-------|
| Total PHP Files | 47 |
| Total CSS Files | 11 |
| Total JS Files | 5 |
| Custom Post Types | 6 |
| Taxonomies | 3 |
| Customizer Sections | 4 |
| Customizer Settings | 10 |
| Meta Boxes | 8 |
| AJAX Handlers | 6 |
| Action Hooks | 25+ |
| Filter Hooks | 20+ |
| Template Parts | 40+ |
| Documentation Files | 4 |

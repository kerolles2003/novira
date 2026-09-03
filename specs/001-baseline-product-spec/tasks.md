---

description: "Task list for Novira Academy WordPress Theme Implementation"
---

# Tasks: Novira Academy Baseline Product Specification

**Input**: Design documents from `/specs/001-baseline-product-spec/`

**Prerequisites**: plan.md (required), spec.md (required for user stories)

**Tests**: Not requested in specification; test tasks omitted.

**Organization**: Tasks are grouped by Epic to enable independent implementation and testing of each Epic.

## Format: `[ID] [P?] [Epic] Description`

- **[P]**: Can run in parallel (different files, no dependencies)
- **[Epic]**: Which Epic this task belongs to (e.g., E1, E2, E3)
- Include exact file paths in descriptions

## Path Conventions

- **WordPress Theme Root**: `novira-theme/` (repository root)
- **Template Parts**: `novira-theme/template-parts/`
- **Assets**: `novira-theme/assets/`
- **Includes**: `novira-theme/inc/`
- **Languages**: `novira-theme/languages/`

## Phase 1: Epic 1 - Theme Foundation

**Purpose**: Establish core theme structure, global layout, header, footer, navigation, design system, and RTL support.

**Goal**: Create a solid, maintainable WordPress theme foundation that supports all subsequent Epics.

**Independent Test**: Theme activates without errors, displays basic header/footer, navigation works, RTL stylesheet loads, design system CSS variables are defined.

### Implementation for Epic 1

- [ ] T001 [P] [E1] Verify theme metadata in `novira-theme/style.css` meets WordPress theme requirements
- [ ] T002 [P] [E1] Create theme setup function in `novira-theme/functions.php` with supports: title-tag, post-thumbnails, custom-logo, menus, html5
- [ ] T003 [P] [E1] Register primary navigation menu location in `novira-theme/functions.php`
- [ ] T004 [P] [E1] Create header template part in `novira-theme/template-parts/layout/header.php` with site logo, title, and primary menu
- [ ] T005 [P] [E1] Create footer template part in `novira-theme/template-parts/layout/footer.php` with copyright, contact info, and secondary menu
- [ ] T006 [P] [E1] Create main index template in `novira-theme/index.php` as fallback
- [ ] T007 [P] [E1] Create page template in `novira-theme/page.php` for generic pages
- [ ] T008 [P] [E1] Create CSS design system in `novira-theme/assets/css/main.css` with CSS custom properties for colors, typography, spacing, breakpoints
- [ ] T009 [P] [E1] Create RTL stylesheet in `novira-theme/assets/css/rtl.css` with logical CSS properties
- [ ] T010 [P] [E1] Enqueue styles and scripts in `novira-theme/functions.php` with proper dependencies and versioning
- [ ] T011 [P] [E1] Create JavaScript navigation handler in `novira-theme/assets/js/navigation.js` for mobile menu toggle
- [ ] T012 [P] [E1] Add customizer settings in `novira-theme/inc/customizer.php` for logo, colors, contact info
- [ ] T013 [P] [E1] Create `languages` directory and POT file generation script
- [ ] T014 [P] [E1] Add theme text domain support and load textdomain in `novira-theme/functions.php`
- [ ] T015 [P] [E1] Create `readme.txt` with theme description, installation, and changelog

**Checkpoint**: Theme foundation complete - all Epics can now be implemented in parallel.

---

## Phase 2: Epic 2 - Homepage

**Goal**: Build the digital front lobby that builds trust, presents departments, and guides visitors.

**Independent Test**: Homepage displays hero section, department navigation cards, trust-proof section, media gallery, and WhatsApp CTA. All sections are responsive and RTL-ready.

### Implementation for Epic 2

- [ ] T016 [P] [E2] Create front-page template in `novira-theme/front-page.php` with section includes
- [ ] T017 [P] [E2] Create hero section template part in `novira-theme/template-parts/sections/hero.php` with real photo/video background and trust-building headline
- [ ] T018 [P] [E2] Create department navigation section template part in `novira-theme/template-parts/sections/department-nav.php` with three department cards
- [ ] T019 [P] [E2] Create trust-proof section template part in `novira-theme/template-parts/sections/trust-proof.php` with testimonials, student activities, teacher highlights
- [ ] T020 [P] [E2] Create media gallery section template part in `novira-theme/template-parts/sections/media-gallery.php` for real photos and video embeds
- [ ] T021 [P] [E2] Create WhatsApp CTA section template part in `novira-theme/template-parts/sections/whatsapp-cta.php` with contact button
- [ ] T022 [P] [E2] Create department card component in `novira-theme/template-parts/content/department-card.php` with icon, title, description, link
- [ ] T023 [P] [E2] Create testimonial component in `novira-theme/template-parts/content/testimonial.php` with quote, author, role
- [ ] T024 [P] [E2] Create video embed component in `novira-theme/template-parts/components/video-embed.php` for YouTube/self-hosted videos
- [ ] T025 [P] [E2] Add homepage-specific CSS in `novira-theme/assets/css/homepage.css` loaded conditionally
- [ ] T026 [P] [E2] Create customizer section for homepage settings in `novira-theme/inc/customizer.php` (hero image, headline, etc.)
- [ ] T027 [P] [E2] Add homepage content via WordPress customizer or options page for non-technical staff

**Checkpoint**: Homepage fully functional with all sections, responsive, and RTL-ready.

---

## Phase 3: Epic 3 - Education Department

**Goal**: Create detailed department page for Education & Professional Development with programs, courses, and WhatsApp contact.

**Independent Test**: Education department page displays programs, courses, admission details, and WhatsApp button with pre-filled message. Form validation works.

### Implementation for Epic 3

- [ ] T028 [P] [E3] Create department page template in `novira-theme/page-department.php` with flexible content layout
- [ ] T029 [P] [E3] Create education department template part in `novira-theme/template-parts/sections/department-education.php` with programs and courses
- [ ] T030 [P] [E3] Create program card component in `novira-theme/template-parts/content/program-card.php` with title, description, duration, requirements
- [ ] T031 [P] [E3] Create course card component in `novira-theme/template-parts/content/course-card.php` with title, description, schedule
- [ ] T032 [P] [E3] Create admission details section in `novira-theme/template-parts/sections/admission-details.php` with requirements and process
- [ ] T033 [P] [E3] Create WhatsApp button component in `novira-theme/template-parts/components/whatsapp-button.php` with pre-filled message for education department
- [ ] T034 [P] [E3] Add education department CSS in `novira-theme/assets/css/department-education.css`
- [ ] T035 [P] [E3] Create custom fields for education department content (programs, courses) using WordPress custom fields or ACF
- [ ] T036 [P] [E3] Add sample content for education department via WordPress admin

**Checkpoint**: Education department page complete with all content sections and functional WhatsApp contact.

---

## Phase 4: Epic 4 - Translation Department

**Goal**: Create detailed department page for Certified Translation Services with service offerings, pricing, and quote request form.

**Independent Test**: Translation department page displays services, pricing, turnaround times, and quote request form. Form submits successfully.

### Implementation for Epic 4

- [ ] T037 [P] [E4] Create translation department template part in `novira-theme/template-parts/sections/department-translation.php` with services and pricing
- [ ] T038 [P] [E4] Create service card component in `novira-theme/template-parts/content/service-card.php` with type, pricing, turnaround
- [ ] T039 [P] [E4] Create pricing table component in `novira-theme/template-parts/components/pricing-table.php` for service comparison
- [ ] T040 [P] [E4] Create quote request form in `novira-theme/template-parts/components/quote-request-form.php` with fields: company, service, details, contact
- [ ] T041 [P] [E4] Create form validation handler in `novira-theme/assets/js/form-validation.js` for client-side validation
- [ ] T042 [P] [E4] Create form submission handler in `novira-theme/inc/form-handling.php` for server-side processing and logging
- [ ] T043 [P] [E4] Create WhatsApp button component for translation department with pre-filled message
- [ ] T044 [P] [E4] Add translation department CSS in `novira-theme/assets/css/department-translation.css`
- [ ] T045 [P] [E4] Create custom fields for translation department content (services, pricing)
- [ ] T046 [P] [E4] Add sample content for translation department via WordPress admin

**Checkpoint**: Translation department page complete with services, pricing, and functional quote request form.

---

## Phase 5: Epic 5 - American Diploma Department

**Goal**: Create detailed department page for American Diploma Programs with curriculum, admission, and registration interest form.

**Independent Test**: American Diploma page displays curriculum, admission requirements, and registration interest form. Form submits successfully.

### Implementation for Epic 5

- [ ] T047 [P] [E5] Create American Diploma department template part in `novira-theme/template-parts/sections/department-american-diploma.php` with curriculum and admission
- [ ] T048 [P] [E5] Create curriculum component in `novira-theme/template-parts/content/curriculum.php` with subjects, grades, requirements
- [ ] T049 [P] [E5] Create admission process component in `novira-theme/template-parts/content/admission-process.php` with steps, deadlines, documents
- [ ] T050 [P] [E5] Create registration interest form in `novira-theme/template-parts/components/registration-interest-form.php` with fields: parent name, student name, program, contact
- [ ] T051 [P] [E5] Create form validation handler for registration form in `novira-theme/assets/js/registration-validation.js`
- [ ] T052 [P] [E5] Create form submission handler for registration in `novira-theme/inc/registration-handling.php`
- [ ] T053 [P] [E5] Create WhatsApp button component for American Diploma department with pre-filled message
- [ ] T054 [P] [E5] Add American Diploma CSS in `novira-theme/assets/css/department-american-diploma.css`
- [ ] T055 [P] [E5] Create custom fields for American Diploma content (curriculum, admission)
- [ ] T056 [P] [E5] Add sample content for American Diploma department via WordPress admin

**Checkpoint**: American Diploma department page complete with curriculum, admission, and functional registration interest form.

---

## Phase 6: Epic 6 - Blog & Events

**Goal**: Implement blog and events sections as native WordPress Custom Post Types with templates and homepage integration.

**Independent Test**: Blog and events CPTs are registered, templates display content, homepage shows latest items, categories and tags work.

### Implementation for Epic 6

- [ ] T057 [P] [E6] Register blog_post CPT in `novira-theme/inc/custom-post-types.php` with categories, tags, thumbnail supports
- [ ] T058 [P] [E6] Register event CPT in `novira-theme/inc/custom-post-types.php` with event_type taxonomy, date, time, location fields
- [ ] T059 [P] [E6] Create single post template in `novira-theme/single.php` for blog posts
- [ ] T060 [P] [E6] Create archive template in `novira-theme/archive.php` for blog and events listings
- [ ] T061 [P] [E6] Create search template in `novira-theme/search.php` for searching blog and events
- [ ] T062 [P] [E6] Create blog post card component in `novira-theme/template-parts/content/blog-post-card.php` with title, excerpt, date, categories
- [ ] T063 [P] [E6] Create event card component in `novira-theme/template-parts/content/event-card.php` with title, date, time, location, type
- [ ] T064 [P] [E6] Create homepage sections for latest blog posts in `novira-theme/template-parts/sections/latest-posts.php`
- [ ] T065 [P] [E6] Create homepage sections for upcoming events in `novira-theme/template-parts/sections/upcoming-events.php`
- [ ] T066 [P] [E6] Add blog and events CSS in `novira-theme/assets/css/blog-events.css`
- [ ] T067 [P] [E6] Create customizer settings for blog and events display options
- [ ] T068 [P] [E6] Add sample blog posts and events via WordPress admin

**Checkpoint**: Blog and events sections functional with CPTs, templates, and homepage integration.

---

## Phase 7: Epic 7 - Translation Workflow

**Goal**: Implement plugin-based translation request intake with future extensibility.

**Independent Test**: Translation request form on department page submits successfully, logs submissions, architecture supports future plugin extensions.

### Implementation for Epic 7

- [ ] T069 [P] [E7] Create translation request form handler in `novira-theme/inc/translation-request-handler.php` with WordPress action hooks
- [ ] T070 [P] [E7] Create form field sanitization and validation in `novira-theme/inc/translation-request-sanitization.php`
- [ ] T071 [P] [E7] Create submission logging to WordPress options table in `novira-theme/inc/translation-request-logging.php`
- [ ] T072 [P] [E7] Create success message component in `novira-theme/template-parts/components/form-success-message.php`
- [ ] T073 [P] [E7] Create error message component in `novira-theme/template-parts/components/form-error-message.php`
- [ ] T074 [P] [E7] Add hooks and filters for future plugin extensions in `novira-theme/inc/hooks.php`
- [ ] T075 [P] [E7] Create documentation for translation workflow extension points in `novira-theme/docs/translation-workflow.md`
- [ ] T076 [P] [E7] Add translation workflow CSS in `novira-theme/assets/css/translation-workflow.css`

**Checkpoint**: Translation request workflow functional with plugin-based architecture.

---

## Phase 8: Epic 8 - Shared Media Components

**Goal**: Create shared media components for reuse across all pages, leveraging WordPress media library.

**Independent Test**: Media components (gallery, video embed, media categories) work across homepage, department pages, blog, events.

### Implementation for Epic 8

- [ ] T077 [P] [E8] Create gallery component in `novira-theme/template-parts/components/gallery.php` with WordPress gallery shortcode integration
- [ ] T078 [P] [E8] Create media category taxonomy in `novira-theme/inc/media-categories.php` for organizing media
- [ ] T079 [P] [E8] Create featured image handler in `novira-theme/inc/featured-images.php` with proper sizing and alt text
- [ ] T080 [P] [E8] Create media query functions in `novira-theme/inc/media-functions.php` for fetching media by category
- [ ] T081 [P] [E8] Create responsive image component in `novira-theme/template-parts/components/responsive-image.php` with srcset and sizes
- [ ] T082 [P] [E8] Create video gallery component in `novira-theme/template-parts/components/video-gallery.php` for multiple video embeds
- [ ] T083 [P] [E8] Add media components CSS in `novira-theme/assets/css/media-components.css`
- [ ] T084 [P] [E8] Create documentation for media usage guidelines in `novira-theme/docs/media-guidelines.md`

**Checkpoint**: Shared media components reusable across all sections.

---

## Phase 9: Epic 9 - Future-ready Architecture

**Goal**: Design architecture for future student portal and external exam integration without implementing full functionality.

**Independent Test**: Architectural hooks and filters are in place, placeholder templates exist, integration layer documented.

### Implementation for Epic 9

- [ ] T085 [P] [E9] Create student portal placeholder templates in `novira-theme/template-parts/portal/` (login, dashboard)
- [ ] T086 [P] [E9] Create external exam integration layer in `novira-theme/inc/exam-integration.php` with embed/API support
- [ ] T087 [P] [E9] Create hooks for future student authentication in `novira-theme/inc/student-auth-hooks.php`
- [ ] T088 [P] [E9] Create documentation for student portal extension in `novira-theme/docs/student-portal-extension.md`
- [ ] T089 [P] [E9] Create documentation for exam provider integration in `novira-theme/docs/exam-integration.md`
- [ ] T090 [P] [E9] Add future-ready CSS variables in `novira-theme/assets/css/variables.css` for portal theming
- [ ] T091 [P] [E9] Create plugin stub for Microsoft Forms integration in `novira-theme/plugins/microsoft-forms-integration/`

**Checkpoint**: Architecture ready for future student portal and exam integration.

---

## Dependencies & Execution Order

### Phase Dependencies

- **Epic 1 (Theme Foundation)**: No dependencies - can start immediately
- **Epic 2 (Homepage)**: Depends on Epic 1 completion (needs theme foundation)
- **Epic 3 (Education Department)**: Depends on Epic 1 completion
- **Epic 4 (Translation Department)**: Depends on Epic 1 completion
- **Epic 5 (American Diploma Department)**: Depends on Epic 1 completion
- **Epic 6 (Blog & Events)**: Depends on Epic 1 completion
- **Epic 7 (Translation Workflow)**: Depends on Epic 4 completion (needs translation department page)
- **Epic 8 (Shared Media Components)**: Depends on Epic 1 completion
- **Epic 9 (Future-ready Architecture)**: Depends on Epic 1 completion

### Epic Dependencies

- **Epic 1**: Foundation - blocks all other Epics
- **Epics 2-6, 8-9**: Can start after Epic 1 completion, can run in parallel
- **Epic 7**: Can start after Epic 4 completion

### Parallel Opportunities

- After Epic 1 completes, Epics 2, 3, 4, 5, 6, 8, 9 can start in parallel
- Within each Epic, tasks marked [P] can run in parallel
- Epic 7 can run in parallel with Epics 2, 3, 5, 6, 8, 9 after Epic 4 completes

---

## Implementation Strategy

### MVP First (Epic 1 + Epic 2)

1. Complete Epic 1: Theme Foundation
2. Complete Epic 2: Homepage
3. **STOP and VALIDATE**: Test homepage independently
4. Deploy/demo if ready

### Incremental Delivery

1. Complete Epic 1 → Foundation ready
2. Add Epic 2 → Homepage functional → Deploy/Demo
3. Add Epic 3 → Education department → Deploy/Demo
4. Add Epic 4 → Translation department → Deploy/Demo
5. Add Epic 5 → American Diploma department → Deploy/Demo
6. Add Epic 6 → Blog & Events → Deploy/Demo
7. Add Epic 7 → Translation workflow → Deploy/Demo
8. Add Epic 8 → Shared media → Deploy/Demo
9. Add Epic 9 → Future-ready architecture → Deploy/Demo

### Parallel Team Strategy

With multiple developers/AI agents:

1. Team completes Epic 1 together
2. Once Epic 1 is done:
   - Agent A: Epic 2 (Homepage)
   - Agent B: Epic 3 (Education Department)
   - Agent C: Epic 4 (Translation Department)
   - Agent D: Epic 5 (American Diploma Department)
   - Agent E: Epic 6 (Blog & Events)
   - Agent F: Epic 8 (Shared Media Components)
   - Agent G: Epic 9 (Future-ready Architecture)
3. After Epic 4 completes, Agent H: Epic 7 (Translation Workflow)

---

## Notes

- [P] tasks = different files, no dependencies
- [Epic] label maps task to specific Epic for traceability
- Each Epic should be independently completable and testable
- Verify each Epic against constitution principles before moving to next
- Commit after each task or logical group
- Stop at any checkpoint to validate Epic independently
- Avoid: vague tasks, same file conflicts, cross-Epic dependencies that break independence
- All tasks assume Stitch MCP will provide UI designs for implementation
- WordPress custom theme architecture is already approved
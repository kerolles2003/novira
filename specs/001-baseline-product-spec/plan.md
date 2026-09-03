# Implementation Plan: Novira Academy Baseline Product Specification

**Branch**: `001-baseline-product-spec` | **Date**: 2026-06-13 | **Spec**: [spec.md](spec.md)

**Input**: Feature specification from `/specs/001-baseline-product-spec/spec.md`

## Summary

Build a custom WordPress theme for Novira Academy, a multi-department educational institution. The theme must serve as a digital front lobby (homepage) that builds trust and presents three departments: Education & Professional Development, Certified Translation Services, and American Diploma Programs. Department pages provide detailed information and conversion paths (WhatsApp inquiries, registration interest forms, quote requests). The architecture must be future-ready for student portal, blog, events, and external exam integration while maintaining WordPress best practices, modularity, and RTL support.

## Technical Context

**Language/Version**: PHP 8.x, WordPress 6.x, JavaScript ES6+, CSS3  
**Primary Dependencies**: WordPress Core, Gutenberg blocks (optional), Contact Form 7 or WPForms for forms, WordPress Custom Post Types for blog and events  
**Storage**: WordPress database (MySQL)  
**Testing**: PHPUnit for WordPress unit tests, Cypress for end‑to‑end testing, WordPress Coding Standards checks  
**Target Platform**: WordPress CMS, modern web browsers (Chrome, Firefox, Safari, Edge), mobile devices  
**Project Type**: WordPress Custom Theme  
**Performance Goals**: Page load under 3 seconds on 3G networks, Core Web Vitals compliance (LCP <2.5s, FID <100ms, CLS <0.1)  
**Constraints**: Must follow WordPress theme review guidelines, accessibility WCAG 2.1 AA, RTL support for Arabic, mobile‑first responsive design  
**Scale/Scope**: Institutional website with moderate traffic, future scalability for student portal and additional departments

## Constitution Check

*GATE: Must pass before Phase 0 research. Re‑check after Phase 1 design.*

| Principle | Compliance Check |
|-----------|------------------|
| 1. Trust Before Conversion | Homepage builds trust before presenting conversion paths; department pages provide detailed information before call‑to‑action. |
| 2. Real Content Before Decorative Design | Theme must support real photos, videos, documents, testimonials; no AI‑generated visuals. Media library integration required. |
| 3. Institutional Identity | Design must reflect educational institution, documentary, human, premium, professional – not SaaS, startup, or generic marketing. |
| 4. Homepage Philosophy | Homepage acts as digital front lobby: builds trust, presents departments, guides visitors, encourages contact. Does not replace department pages. |
| 5. Information Architecture | Site structure follows hierarchy: Homepage → Trust & Navigation; Department Pages → Details & Conversion; Blog → Activity & News; Events → Community; Student Portal → Services (future). |
| 6. WordPress Architecture | Custom theme, modular template parts, reusable components, RTL support, mobile‑first. No page builders or tightly coupled structures. |
| 7. Authenticity Rule | Authenticity wins over aesthetics; real content must be prioritized. |
| 8. Scalability | Architecture must support future integration of Microsoft Forms, student portal, online registration, blog, events, additional departments. |
| 9. Design Consistency | All pages must feel part of one institution; consistent styling and messaging. |
| 10. Non‑Negotiable Rule | Website must accurately represent the physical institution; parents should feel comfortable visiting after seeing the website. |

## Project Structure

### Documentation (this feature)

```text
specs/001-baseline-product-spec/
├── plan.md              # This file
├── spec.md              # Feature specification
├── research.md          # Phase 0 output (to be created)
├── data-model.md        # Phase 1 output (to be created)
├── quickstart.md        # Phase 1 output (to be created)
├── contracts/           # Phase 1 output (to be created)
└── tasks.md             # Phase 2 output (to be created)
```

### Source Code (repository root)

```text
novira-theme/                     # WordPress theme root
├── assets/
│   ├── css/                      # Compiled CSS (main.css, rtl.css)
│   ├── js/                       # JavaScript files (main.js, navigation.js)
│   ├── images/                   # Theme images (icons, placeholders)
│   └── fonts/                    # Custom fonts if needed
├── template-parts/               # Modular template parts
│   ├── content/                  # Content templates (department-card, program-card, etc.)
│   ├── components/               # Reusable UI components (whatsapp-button, form-field, etc.)
│   ├── sections/                 # Page sections (hero, trust-proof, department-nav, etc.)
│   └── layout/                   # Layout parts (header, footer, sidebar, etc.)
├── languages/                    # Translation files (.pot, .po, .mo)
├── inc/                          # PHP includes
│   ├── custom-post-types.php     # Blog and Events CPT registration
│   ├── customizer.php            # Customizer settings
│   ├── widgets.php               # Widget definitions
│   └── hooks.php                 # Action and filter hooks
├── functions.php                 # Theme functions (setup, enqueue, etc.)
├── style.css                     # Theme metadata and base styles
├── index.php                     # Main template fallback
├── front-page.php                # Homepage template
├── page.php                      # Default page template
├── page-department.php           # Department page template (custom)
├── single.php                    # Single post template (blog)
├── archive.php                   # Archive template (blog, events)
├── header.php                    # Header template part
├── footer.php                    # Footer template part
├── sidebar.php                   # Sidebar template part
└── searchform.php                # Search form template
```

**Structure Decision**: The theme follows standard WordPress theme architecture with modular template parts for reusability. Custom post types for Blog and Events will be registered via `inc/custom-post-types.php`. Department pages will use a custom page template (`page-department.php`) with flexible content fields (likely using WordPress Custom Fields or Advanced Custom Fields plugin if allowed). All components are designed to be RTL‑ready and mobile‑first.

## Complexity Tracking

> No constitution violations identified. The architecture aligns with WordPress best practices and the project's principles.

| Violation | Why Needed | Simpler Alternative Rejected Because |
|-----------|------------|-------------------------------------|
| None | N/A | N/A |

## Implementation Phases

### Phase 1: Custom WordPress Theme Foundation

**Goal**: Establish a solid, maintainable theme foundation with global layout, header, footer, navigation, design system, and RTL support.

**Key Deliverables**:
- Theme setup (`functions.php`) with proper theme supports (title-tag, post-thumbnails, custom-logo, menus)
- Global layout structure (header, footer, sidebar, content area)
- Responsive navigation (mobile menu, desktop menu)
- Design system: CSS custom properties for colors, typography, spacing, breakpoints
- RTL stylesheet (`rtl.css`) generated or hand‑written
- Enqueue scripts and styles properly
- WordPress theme customizer settings for basic options (logo, colors, contact info)

**Constitution Check**: Ensures WordPress architecture (principle 6), design consistency (principle 9), and mobile‑first approach.

### Phase 2: Homepage (Front Lobby)

**Goal**: Build the digital front lobby that builds trust, presents departments, and guides visitors.

**Key Deliverables**:
- Homepage template (`front-page.php`) with sections:
  - Hero section with real photo/video and trust‑building headline
  - Department navigation cards (three departments with icons/images)
  - Trust‑proof section (real testimonials, student activities, teacher highlights)
  - Media components (gallery of real photos, video embeds)
  - Call‑to‑action for WhatsApp contact
- Dynamic content from WordPress Custom Post Types (blog posts, events) for activity section
- Integration with media library for authentic content

**Constitution Check**: Implements homepage philosophy (principle 4), trust before conversion (principle 1), real content (principle 2), institutional identity (principle 3).

### Phase 3: Department Pages

**Goal**: Create detailed department pages that provide information and conversion paths.

**Key Deliverables**:
- Custom page template `page-department.php` with flexible content layout
- Department‑specific content sections:
  - Education & Professional Development: programs, courses, admission details
  - Certified Translation Services: service offerings, pricing, turnaround times
  - American Diploma Programs: curriculum, admission requirements, registration interest form
- WhatsApp contact button with pre‑filled message per department
- Quote request form for translation services
- Registration interest form for diploma programs
- Form validation and submission logging (WordPress options table or custom table)
- Direct URL access for each department page

**Constitution Check**: Implements department pages as details & conversion (principle 5), authenticity rule (principle 7), design consistency (principle 9).

### Phase 4: Blog, Events, and Shared Media Components

**Goal**: Implement content sections for activity and community, plus shared media components.

**Key Deliverables**:
- Register Custom Post Types: `blog_post` and `event` with appropriate taxonomies (categories, tags, event_type)
- Blog templates: `single.php`, `archive.php`, `search.php`
- Event templates with date, time, location display
- Homepage sections displaying latest blog posts and upcoming events
- Shared media components:
  - Gallery shortcode or block for real photos
  - Video embed component (YouTube, self‑hosted)
  - Media categories and tagging for organization
- Integration with WordPress media library for alt text, metadata, featured images

**Constitution Check**: Implements blog and events as per constitution (principle 5), real content (principle 2), scalability (principle 8).

### Phase 5: Translation Request Workflow

**Goal**: Implement plugin‑based translation request intake with future extensibility.

**Key Deliverables**:
- Translation request form on Certified Translation Services department page
- Form fields: company name, service needed, document details, contact information
- Form submission handling (WordPress action hooks)
- Basic validation and success message
- Logging of submissions (WordPress options or custom table)
- Architecture designed for future plugin extensions (document upload, status tracking, payment)
- No complex workflow in baseline; simple intake only

**Constitution Check**: Plugin‑based intake (clarification), future‑ready architecture (principle 8), WordPress native approach (principle 6).

### Phase 6: Future‑ready Student Portal Architecture

**Goal**: Design architecture that can support a student portal without committing to full implementation.

**Key Deliverables**:
- Architectural hooks and filters for future student authentication
- Placeholder templates for portal pages (student login, dashboard)
- Integration layer for external exam providers (Microsoft Forms, Google Forms, etc.) via embed or API
- Documentation of extension points for future developers
- No actual portal functionality in baseline; only scaffolding

**Constitution Check**: Future‑ready architecture (principle 8), scalability (principle 8), avoids over‑engineering (technical principle).

## Technical Decisions

1. **WordPress Custom Fields**: Use Advanced Custom Fields (ACF) or WordPress native custom fields for department‑specific content (programs, services). This keeps content flexible and editor‑friendly.
2. **Forms**: Use Contact Form 7 or WPForms for registration interest and quote request forms. Both are WordPress‑native plugins with extensibility.
3. **Custom Post Types**: Register via `register_post_type()` in `inc/custom-post-types.php`. Keep labels and supports minimal.
4. **RTL Support**: Use `add_theme_support('html5', array('script', 'style'))` and generate `rtl.css` via automated tools or hand‑write.
5. **Performance**: Optimize images, lazy‑load videos, minify CSS/JS, leverage browser caching. Consider a caching plugin for production.
6. **Security**: Follow WordPress security best practices: nonce verification, data sanitization, output escaping.

## Risk Mitigation

- **Content Migration**: Ensure existing real photos, videos, and testimonials from current Wix site are migrated and optimized.
- **RTL Complexity**: Test RTL layout thoroughly with Arabic content; use CSS logical properties where possible.
- **Plugin Dependencies**: Minimize plugin dependencies; prefer WordPress native features. Document any required plugins.
- **Future Scalability**: Design hooks and filters for future extensions; avoid hard‑coding business logic.

## Next Steps

1. Complete Phase 1 foundation and validate with WordPress theme check.
2. Proceed through phases sequentially, testing each deliverable against constitution principles.
3. After each phase, run WordPress coding standards checks and accessibility audits.
4. Document any deviations or additional requirements in `research.md`.
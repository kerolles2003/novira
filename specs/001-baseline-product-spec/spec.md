# Feature Specification: Novira Academy Baseline Product Specification

**Feature Branch**: `001-baseline-product-spec`

**Created**: 2026-06-13

**Status**: Draft

**Input**: User description: "Build the baseline product specification for Novira Academy. Context: Novira Academy is a multi-department educational institution. It consists of three primary departments: Education & Professional Development, Certified Translation Services, American Diploma Programs. The website is built as a custom WordPress theme. The homepage acts as the digital front lobby. Department pages provide detailed information and conversion paths. Primary goals: Build trust, Present departments, Generate WhatsApp inquiries, Generate registrations."

## User Scenarios & Testing *(mandatory)*

### User Story 1 - Prospective Student Explores Departments and Contacts via WhatsApp (Priority: P1)

A prospective student visits the homepage, learns about the three departments, selects the "Education & Professional Development" department, reviews program details, and initiates a WhatsApp inquiry to ask about enrollment.

**Why this priority**: This is the core conversion path for the primary audience. It directly supports the goal of generating WhatsApp inquiries and demonstrates trust-building through transparent information.

**Independent Test**: Can be fully tested by navigating from homepage to department page to WhatsApp link, verifying that the inquiry prompt appears and is functional. Delivers value by enabling direct communication.

**Acceptance Scenarios**:

1. **Given** a visitor is on the homepage, **When** they click on the "Education & Professional Development" department card, **Then** they are taken to the department page with program details.
2. **Given** a visitor is on a department page, **When** they click the WhatsApp contact button, **Then** a WhatsApp chat opens with a pre-filled message referencing the department.
3. **Given** a visitor is on any page, **When** they view the WhatsApp contact button, **Then** it is clearly visible and accessible.

---

### User Story 2 - Parent Researches American Diploma Programs and Submits Registration Interest (Priority: P2)

A parent visits the homepage, navigates to the American Diploma Programs department, reviews curriculum and admission details, and completes a registration interest form to receive more information.

**Why this priority**: This supports the goal of generating registrations and caters to a key decision‑maker (parents) for the diploma programs.

**Independent Test**: Can be tested by navigating to the department page, filling out the registration interest form, and verifying submission confirmation. Delivers value by capturing leads.

**Acceptance Scenarios**:

1. **Given** a parent is on the homepage, **When** they click on the "American Diploma Programs" department card, **Then** they are taken to the department page with relevant details.
2. **Given** a parent is on the department page, **When** they fill out the registration interest form with required fields, **Then** the form is submitted successfully and a confirmation message is displayed.
3. **Given** a parent submits the form, **When** the submission is processed, **Then** the inquiry is logged for follow‑up.

---

### User Story 3 - Business Client Seeks Certified Translation Services and Requests Quote (Priority: P3)

A business client visits the homepage, navigates to the Certified Translation Services department, reviews service offerings, and submits a quote request via a contact form.

**Why this priority**: This expands the institution's revenue stream and targets a different audience segment (businesses). It is secondary to the primary educational goals.

**Independent Test**: Can be tested by navigating to the department page, filling out the quote request form, and verifying submission. Delivers value by generating business leads.

**Acceptance Scenarios**:

1. **Given** a client is on the homepage, **When** they click on the "Certified Translation Services" department card, **Then** they are taken to the department page with service details.
2. **Given** a client is on the department page, **When** they fill out the quote request form, **Then** the form is submitted successfully and a confirmation is shown.
3. **Given** a client submits the form, **When** the submission is processed, **Then** the request is logged for follow‑up.

---

### Edge Cases

- What happens when a visitor clicks a WhatsApp link but does not have WhatsApp installed? The system should fallback to a web‑based WhatsApp prompt or display instructions.
- How does the system handle invalid form submissions (missing required fields)? The system should display clear validation errors and preserve entered data.
- What happens when a department page is accessed directly via URL without visiting the homepage first? The page should still be fully functional and self‑explanatory.
- How does the system handle high traffic spikes during enrollment periods? The system should maintain performance and not degrade user experience.

## Requirements *(mandatory)*

### Functional Requirements

- **FR-001**: System MUST display a homepage that introduces the three departments with clear navigation.
- **FR-002**: System MUST provide a dedicated page for each department with detailed information.
- **FR-003**: System MUST include a WhatsApp contact button on department pages that opens a chat with a pre‑filled message.
- **FR-004**: System MUST allow visitors to submit a registration interest form on the American Diploma Programs page.
- **FR-005**: System MUST allow visitors to submit a quote request form on the Certified Translation Services page.
- **FR-006**: System MUST display validation errors for form submissions with missing required fields.
- **FR-007**: System MUST log all form submissions (WhatsApp inquiries, registration interests, quote requests) for follow‑up.
- **FR-008**: System MUST ensure all pages are accessible via direct URL without requiring a homepage visit.
- **FR-009**: System MUST maintain consistent navigation and branding across all pages.
- **FR-010**: System MUST support right‑to‑left (RTL) languages for all text content.
- **FR-011**: System architecture MUST be future-ready to support a student portal with login, course access, document access, Microsoft Forms exams, announcements, and additional capabilities without requiring major rewrites.
- **FR-012**: System MUST support pluggable integration with external exam providers (e.g., Microsoft Forms, Google Forms, custom exam systems, LMS) through a flexible integration layer, without tight coupling to any specific provider.
- **FR-013**: Translation request intake MUST be plugin-based, allowing for future extension of the workflow (e.g., adding document upload, status tracking, payment processing) without major architectural changes.
- **FR-014**: System MUST provide a blog section implemented as a native WordPress Custom Post Type, supporting articles, news, and educational content with categories and tags.
- **FR-015**: System MUST provide an events section implemented as a native WordPress Custom Post Type, supporting upcoming events, academy activities, workshops, and seminars with basic event information (no complex event management or ticketing in baseline).
- **FR-016**: System MUST use the native WordPress media library as the primary media management system, supporting image metadata, alt text, organized media categories, featured images, gallery support, and video embedding from external providers (e.g., YouTube) or self-hosted videos.

### Key Entities

- **Department**: Represents an educational division (e.g., Education & Professional Development). Key attributes: name, description, programs/services, contact method.
- **Program**: A specific course or offering within a department. Key attributes: title, description, duration, admission requirements.
- **Service**: A service offered by the translation department. Key attributes: service type, pricing model, turnaround time.
- **User Inquiry**: A record of a WhatsApp contact initiated by a visitor. Key attributes: timestamp, department, pre‑filled message.
- **Registration Interest**: A form submission from a parent expressing interest in a program. Key attributes: parent name, student name, program, contact information.
- **Quote Request**: A form submission from a client requesting a translation service quote. Key attributes: company name, service needed, document details, contact information.
- **Blog Post**: An article, news item, or educational content. Key attributes: title, content, excerpt, categories, tags, publication date, author.
- **Event**: An upcoming academy activity, workshop, or seminar. Key attributes: title, description, date, time, location, event type (workshop, seminar, etc.).
- **Media Asset**: A photo, video, or document stored in the WordPress media library. Key attributes: file URL, alt text, metadata, media category, upload date. Media assets are reusable across homepage, department pages, blog, events, testimonials, and galleries.

## Success Criteria *(mandatory)*

### Measurable Outcomes

- **SC-001**: 90% of first‑time visitors can identify the three departments within 30 seconds of landing on the homepage.
- **SC-002**: WhatsApp inquiry volume increases by 20% within three months of launch.
- **SC-003**: Registration interest form completion rate is at least 70% (i.e., 70% of visitors who start the form complete it).
- **SC-004**: Quote request form completion rate is at least 60%.
- **SC-005**: Average page load time is under 3 seconds on a standard mobile connection.
- **SC-006**: 95% of users report feeling confident about the institution’s legitimacy after visiting the website (measured via optional feedback survey).

## Assumptions

- Target users have stable internet connectivity and access via desktop or mobile devices.
- WhatsApp is the preferred communication channel for the primary audience (students and parents).
- The institution will provide real photos, videos, and testimonials for use on the website (as per constitution principle #2).
- No e‑commerce or payment processing is required in this baseline version.
- The website will be maintained by non‑technical staff using a content management system.
- Analytics tools will be integrated to track form submissions and WhatsApp clicks.
- The website must comply with accessibility standards (WCAG 2.1 AA).
- Future scalability will include a student portal with login, course access, document access, external exam integration (Microsoft Forms, Google Forms, custom systems, LMS), announcements, and additional capabilities (as per constitution principle #8). The baseline architecture must be future-ready but not commit to a full student management system, and external exam integration must be provider-agnostic.
- Translation request intake must be plugin-based to allow future extension of the workflow (e.g., adding document upload, status tracking, payment processing).
- Blog and Events will be implemented as native WordPress Custom Post Types, allowing categories, tags, taxonomies, and filtering, with homepage displaying latest items from these sections.
- Media management will use the native WordPress media library, with authentic photos and videos treated as shared content reusable across all sections, not page-specific assets.

## Clarifications

### Session 2026-06-13

- Q: Future Student Portal requirements → A: Future-ready portal architecture only (design for future expansion, keep public website as current priority, avoid committing to full student management system in baseline, allow future integration for student login, course access, document access, Microsoft Forms exams, announcements, additional portal capabilities)
- Q: Microsoft Forms integration expectations → A: Pluggable external exam provider (Microsoft Forms treated as external service, baseline architecture supports embedding or linking to external exam providers through flexible integration layer, not tightly coupled to Microsoft Forms, allow future support for Microsoft Forms, Google Forms, custom exam systems, LMS integrations, public website remains priority, architecture provider-agnostic and future-ready)
- Q: Translation request workflow → A: Plugin-based intake, extensible later (translation request workflow should be plugin-based, allowing for future extension, baseline architecture supports flexible intake process that can be expanded later)
- Q: Blog and Events strategy → A: Blog and Events as native WordPress Custom Post Types (articles, news, educational content with categories and tags; events: upcoming events, academy activities, workshops, seminars with basic event information; no complex event management or ticketing in baseline; architecture allows future extensions through WordPress plugins; homepage displays latest items from these sections)
- Q: Media management strategy → A: Use native WordPress media library as primary media management system (WordPress-first, easy for academy staff to manage; requirements: WordPress Media Library, image metadata, alt text support, organized media categories, featured images, gallery support; videos: self-hosted when appropriate, external providers (YouTube) through embedding; no custom media management platform; future enhancements through WordPress plugins; media reusable across homepage, department pages, blog, events, testimonials, galleries; authentic media is core trust asset, treated as shared content not page-specific assets)

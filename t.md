Epic 2 Review: Senior WordPress Architect
Date: 2026-06-13
Reviewer: Senior WordPress Architect
Scope: Homepage (Epic 2) - Full Architecture Review
Executive Summary
The homepage implementation follows the correct section structure and properly uses template parts. However, there are critical architectural violations where content that should be managed through WordPress (posts, pages, Custom Post Types) is instead hardcoded in PHP or stored in the Customizer.
Overall Score: 6/10
1. Homepage Philosophy
Check	Status	Notes
Builds trust	✅	Testimonials, trust badges, institutional messaging
Introduces departments	✅	Three department cards with clear navigation
Encourages exploration	✅	WhatsApp CTAs, department links
Does NOT duplicate department pages	✅	Routes users to department pages
Acts as digital front lobby	✅	Proper information hierarchy
Pass. The homepage fulfills its role as the digital front lobby.
2. Template Architecture
Check	Status	Notes
front-page.php clean	✅	Only includes template parts
Sections properly organized	✅	template-parts/sections/
Components reusable	✅	template-parts/components/
No business logic in templates	⚠️	Some hardcoded content in sections
Pass with concerns. Structure is correct, but content management is problematic.
3. Customizer Audit
What Belongs in Customizer (Appropriate)
- ✅ Contact Information (WhatsApp, email, phone, address)
- ✅ Social Media URLs
- ✅ Brand Colors
- ✅ Footer Copyright Text
What Does NOT Belong in Customizer
Setting	Why It's Wrong	Should Be
novira_hero_badge	Homepage-specific content	Page content or ACF field
novira_hero_title	Homepage-specific content	Page content or ACF field
novira_hero_subtitle	Homepage-specific content	Page content or ACF field
novira_hero_image	Homepage-specific content	Page featured image or ACF
novira_hero_cta	Homepage-specific content	Page content or ACF field
novira_gallery_title	Section content	Page content
novira_gallery_subtitle	Section content	Page content
novira_video_url	Section content	Page content or ACF
novira_cta_title	Section content	Page content
novira_cta_text	Section content	Page content
novira_cta_button	Section content	Page content
CRITICAL VIOLATION. The Customizer is being used as a page builder. Non-technical staff should edit page content, not Customizer settings, for homepage section copy.
4. Content Management Violations
Violation 1: Hardcoded Department Data
File: template-parts/sections/department-nav.php (lines 15-49)
$departments = array(
    array(
        'title' => __( 'التعليم والتطوير المهني', 'novira-academy' ),
        // ...
    ),
    // ...
);
Constitution Principle Violated: #6 (WordPress Architecture), #8 (Scalability)
What should happen: Departments should be a Custom Post Type or pulled from WordPress pages. Adding a department requires editing PHP files.
Violation 2: Hardcoded Testimonials
File: template-parts/sections/trust-proof.php (lines 15-34)
$testimonials = array(
    array(
        'quote' => __( '...', 'novira-academy' ),
        // ...
    ),
    // ...
);
Constitution Principle Violated: #2 (Real Content), #6 (WordPress Architecture), #8 (Scalability)
What should happen: Testimonials should be a Custom Post Type or pulled from WordPress posts. Adding a testimonial requires editing PHP files.
Violation 3: Placeholder Gallery Images
File: template-parts/sections/media-gallery.php (lines 31-57)
$gallery_images = array(
    array(
        'url' => NOVIRA_URI . '/assets/images/gallery-1.jpg',
        // ...
    ),
    // ...
);
Constitution Principle Violated: #2 (Real Content Before Decorative Design), #16 (Media Library)
What should happen: Gallery should pull from WordPress media library using gallery shortcode, WP_Query with attachment posts, or a gallery CPT.
Violation 4: Blog Uses Standard Post Type
File: template-parts/sections/latest-posts.php (line 16)
'post_type' => 'post',
Specification Violated: FR-014 (Blog as native WordPress Custom Post Type)
What should happen: Blog should use novira_blog_post CPT as specified in Epic 6 tasks (T057).
Violation 5: Events CPT Not Registered
File: template-parts/sections/upcoming-events.php (line 16)
'post_type' => 'novira_event',
The query references novira_event but this CPT is not registered anywhere. The homepage will silently fail to show events.
5. Component Review
Component	Reusable	Generic	Homepage-Specific	Verdict
Department Card	✅	✅	No	PASS
Testimonial	✅	✅	No	PASS
Video Embed	✅	✅	No	PASS
Pass. Components are properly generic and reusable.
6. CSS Review
Check	Status	Notes
Homepage styles isolated	✅	homepage.css loaded conditionally
Design tokens reused	✅	Uses var(--space-), var(--fs-), etc.
No duplication	✅	Styles only in homepage.css
Future department pages can reuse	⚠️	.section, .section-header, .section-tag are reusable
Responsive breakpoints	✅	1024px, 768px, 480px
Pass. CSS architecture is clean and follows design tokens.
7. Constitution Compliance
Principle	Status	Notes
1. Trust Before Conversion	✅	Trust badges, testimonials before CTA
2. Real Content Before Decorative	❌	Hardcoded placeholder content, not WordPress media
3. Institutional Identity	✅	Educational institution tone
4. Homepage Philosophy	✅	Front lobby role fulfilled
5. Information Architecture	✅	Proper hierarchy
6. WordPress Architecture	❌	Hardcoded content violates WordPress-first
7. Authenticity Rule	⚠️	Placeholder content until real content added
8. Scalability	❌	Adding departments/testimonials requires code changes
9. Design Consistency	✅	Consistent styling
10. Non-Negotiable Rule	⚠️	Cannot verify without real content
3 VIOLATIONS (Principles 2, 6, 8)
8. Future Compatibility
Feature	Support	Notes
Department pages	⚠️	Hardcoded data blocks dynamic departments
Blog	❌	Uses standard 'post' type, not CPT
Events	❌	CPT not registered, query will fail
Translation workflow	✅	No conflicts
Media components	⚠️	Gallery hardcoded, not using media library
ACF migration	⚠️	Would require rewriting hardcoded arrays
9. Critical Issues
#	Severity	Issue	Location
1	CRITICAL	Department data hardcoded in PHP	department-nav.php
2	CRITICAL	Testimonials hardcoded in PHP	trust-proof.php
3	CRITICAL	Gallery uses placeholder images, not media library	media-gallery.php
4	HIGH	Customizer used as page builder for homepage content	customizer.php
5	HIGH	Blog uses standard 'post' instead of CPT	latest-posts.php
6	HIGH	Events CPT not registered	upcoming-events.php
7	MEDIUM	No mechanism for non-technical staff to manage content	Multiple files
10. Architecture Risks
1. Content Lock-in: Adding any department, testimonial, or gallery image requires editing PHP files and deploying code
2. Editorial Workflow Impossible: Non-technical staff cannot manage homepage content
3. ACF Migration Cost: Moving to ACF later requires rewriting all hardcoded arrays
4. Performance: Hardcoded content cannot be cached independently
11. Technical Debt
Item	Debt Level	Remediation Effort
Hardcoded departments	HIGH	Create CPT + refactor template
Hardcoded testimonials	HIGH	Create CPT + refactor template
Placeholder gallery	HIGH	Integrate with media library
Customizer homepage content	MEDIUM	Move to page content or ACF
Blog post type mismatch	LOW	Already planned for Epic 6
Events CPT not registered	LOW	Already planned for Epic 6
12. Epic 3 Readiness
Epic 3 (Education Department) can proceed only if:
1. Department data is moved to a Custom Post Type or WordPress pages
2. Department card component accepts dynamic data from WordPress queries
3. The page-department.php template is created to pull from WordPress content
Current architecture blocks Epic 3 because department data is hardcoded.
Final Decision
NOT READY
Reason: Three critical violations of WordPress-first architecture (Constitution Principle #6) and scalability (Principle #8). Homepage content that should be managed through WordPress is hardcoded in PHP or stored in the Customizer.
Required Before Proceeding
1. Create Department Custom Post Type or use WordPress pages for department data
2. Create Testimonial Custom Post Type for testimonial management
3. Integrate gallery with WordPress media library instead of placeholder images
4. Remove homepage content from Customizer - move to page content or ACF fields
5. Register Events CPT (or defer homepage events section to Epic 6)
Acceptable Shortcut
If CPTs are deferred to Epic 6, the homepage sections that depend on them (latest-posts, upcoming-events) should be removed from front-page.php until the CPTs are registered. Displaying broken queries is worse than not displaying the section.
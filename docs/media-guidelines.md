# Media Usage Guidelines

## Overview

This document provides guidelines for using media components in the Novira Academy theme.

## Media Categories

The theme includes a custom `media_category` taxonomy for organizing media attachments. Default categories:

- **education** - الصور والفيديوهات المتعلقة بالتعليم
- **translation** - الصور والفيديوهات المتعلقة بالترجمة
- **diploma** - الصور والفيديوهات المتعلقة بالدبلوم الأمريكي
- **events** - الصور والفيديوهات المتعلقة بالأحداث
- **blog** - الصور والفيديوهات المتعلقة بالمدونة
- **gallery** - صور المعرض
- **team** - صور الفريق
- **testimonials** - صور شهادات العملاء

## Components

### 1. Gallery Component

**Template Path:** `template-parts/components/gallery.php`

**Usage:**
```php
get_template_part( 'template-parts/components/gallery', null, array(
	'ids'     => '1,2,3,4,5',  // Attachment IDs (comma-separated)
	'columns' => 3,             // Number of columns
	'size'    => 'medium_large', // Image size
	'link'    => 'file',        // Link to: file, none
	'layout'  => 'grid',        // Layout: grid, masonry
) );
```

### 2. Responsive Image Component

**Template Path:** `template-parts/components/responsive-image.php`

**Usage:**
```php
get_template_part( 'template-parts/components/responsive-image', null, array(
	'image_id'     => 123,           // Attachment ID (preferred)
	'image_url'    => '',             // Or image URL
	'alt'          => 'Alt text',     // Alt text
	'caption'      => 'Caption',      // Optional caption
	'size'         => 'medium_large', // Image size
	'class'        => '',             // Additional CSS class
	'show_caption' => false,          // Show caption
	'link'         => '',             // Optional link URL
) );
```

### 3. Video Gallery Component

**Template Path:** `template-parts/components/video-gallery.php`

**Usage:**
```php
get_template_part( 'template-parts/components/video-gallery', null, array(
	'videos' => array(
		array(
			'url'       => 'https://youtube.com/watch?v=xxx',
			'title'     => 'Video Title',
			'thumbnail' => 'https://example.com/thumb.jpg',
			'duration'  => '10:30',
		),
		// Add more videos...
	),
	'columns' => 3,
	'autoplay' => false,
) );
```

## Helper Functions

### Media Queries

```php
// Get media by category
$media = novira_get_media_by_category( 'education', 12, 'DESC' );

// Get media by tag
$media = novira_get_media_by_tag( 'featured', 12 );

// Get media by multiple categories
$media = novira_get_media_by_categories( array( 'education', 'blog' ), 12, 'OR' );

// Get recent media
$media = novira_get_recent_media( 12, 'image' );

// Get featured images from posts
$images = novira_get_featured_images( 'post', 12 );

// Get media count
$count = novira_get_media_count_by_category( 'education' );

// Get all categories
$categories = novira_get_media_categories();

// Get gallery data for JavaScript
$gallery = novira_get_gallery_data( array(
	'category' => 'education',
	'limit'    => 12,
) );
```

### Featured Images

```php
// Get featured image HTML
$image = novira_get_featured_image( $post_id, 'medium_large', array(
	'class' => 'my-class',
) );

// Get featured image URL
$url = novira_get_featured_image_url( $post_id, 'full' );

// Get featured image ID
$id = novira_get_featured_image_id( $post_id );

// Get featured image alt text
$alt = novira_get_featured_image_alt( $post_id );

// Get responsive featured image with srcset
$image = novira_get_responsive_featured_image( $post_id, 'medium_large' );

// Check if post has featured image
$has_image = novira_has_featured_image( $post_id );
```

## Image Sizes

The theme registers custom image sizes:

- **novira-hero** - 1920x1080 (cropped)
- **novira-card** - 600x400 (cropped)
- **novira-thumb** - 300x300 (cropped)

## Best Practices

1. **Always use appropriate image sizes** - Use `medium_large` for cards, `novira-hero` for hero sections
2. **Add alt text** - Always provide descriptive alt text for accessibility
3. **Use lazy loading** - Components include `loading="lazy"` by default
4. **Categorize media** - Assign media to appropriate categories for organization
5. **Optimize images** - Compress images before uploading (recommended: TinyPNG)
6. **Use responsive images** - Components generate srcset automatically
7. **Video thumbnails** - Provide custom thumbnails for better UX

## Hooks and Filters

The media system provides extensibility through WordPress hooks:

```php
// Modify gallery output
add_filter( 'novira_gallery_output', function( $output, $args ) {
	return $output;
}, 10, 2 );

// Add custom video types
add_filter( 'novira_detect_video_type', function( $type, $url ) {
	// Add custom detection logic
	return $type;
}, 10, 2 );

// Modify media query arguments
add_filter( 'novira_media_query_args', function( $args, $query_type ) {
	// Modify query arguments
	return $args;
}, 10, 2 );
```

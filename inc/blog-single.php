<?php
/**
 * Premium learning-article layer for single `blog_post` views.
 *
 * Additive and self-contained:
 *   - Enqueues blog-article.css + blog-article.js on single blog posts only.
 *   - Prepares article content: injects heading IDs, builds the table-of-contents,
 *     and wraps bare tables for horizontal scroll — without a build step.
 *   - Registers educational "learning block" shortcodes (tip / note / warning /
 *     mistakes / key takeaways / summary / what-you'll-learn / callout / fact /
 *     pull-quote) that editors drop into the content on their own line.
 *
 * Reuses the shared helpers from inc/blog-archive.php (reading time, primary
 * category, accent). Header/footer untouched.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue the learning-article stylesheet + script on single blog posts.
 */
function novira_blog_single_assets() {
	if ( ! is_singular( 'blog_post' ) ) {
		return;
	}
	wp_enqueue_style(
		'novira-blog-article',
		NOVIRA_URI . '/assets/css/blog-article.css',
		array( 'novira-main' ),
		filemtime( NOVIRA_DIR . '/assets/css/blog-article.css' )
	);
	wp_enqueue_script(
		'novira-blog-article',
		NOVIRA_URI . '/assets/js/blog-article.js',
		array(),
		filemtime( NOVIRA_DIR . '/assets/js/blog-article.js' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'novira_blog_single_assets', 20 );

/**
 * Prepare rendered article HTML: add stable IDs to h2/h3 (for anchors), collect a
 * table-of-contents, and wrap tables in a horizontally scrollable region.
 *
 * @param string $html Content already run through the `the_content` filters.
 * @return array{0:string,1:array} [ processed HTML, TOC list ( id, level, text ) ]
 */
function novira_blog_prepare_article( $html ) {
	$toc     = array();
	$counter = 0;

	// Drop empty paragraphs wpautop can leave around standalone block shortcodes.
	$html = preg_replace( '/<p>(?:\s|&nbsp;|<br\s*\/?>)*<\/p>/i', '', $html );

	// Wrap bare tables so wide data scrolls instead of breaking the layout.
	$html = preg_replace_callback(
		'/<table\b(?![^>]*\bnvblog-tablewrap\b)([^>]*)>(.*?)<\/table>/is',
		function ( $m ) {
			return '<div class="nvblog-tablewrap" role="region" aria-label="' . esc_attr__( 'جدول', 'novira-academy' ) . '" tabindex="0"><table' . $m[1] . '>' . $m[2] . '</table></div>';
		},
		$html
	);

	// Add IDs + focus targets to h2/h3 and record them for the TOC.
	$html = preg_replace_callback(
		'/<h([23])\b([^>]*)>(.*?)<\/h\1>/is',
		function ( $m ) use ( &$toc, &$counter ) {
			$level = (int) $m[1];
			$attrs = $m[2];
			$inner = $m[3];
			$text  = trim( wp_strip_all_tags( $inner ) );

			if ( '' === $text ) {
				return $m[0];
			}

			if ( preg_match( '/\bid=("|\')(.*?)\1/i', $attrs, $idm ) ) {
				$id = $idm[2];
			} else {
				$counter++;
				$id     = 'nv-h-' . $counter;
				$attrs .= ' id="' . esc_attr( $id ) . '"';
			}

			if ( false === stripos( $attrs, 'tabindex' ) ) {
				$attrs .= ' tabindex="-1"';
			}

			$toc[] = array(
				'id'    => $id,
				'level' => $level,
				'text'  => $text,
			);

			return '<h' . $level . $attrs . '>' . $inner . '</h' . $level . '>';
		},
		$html
	);

	return array( $html, $toc );
}

/**
 * Brand-styled inline icon for the learning blocks.
 *
 * @param string $key Icon key.
 * @return string Inline SVG.
 */
function novira_nv_icon( $key ) {
	$open = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">';
	switch ( $key ) {
		case 'target':
			return $open . '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="4.6"/><circle cx="12" cy="12" r="1.2" fill="currentColor" stroke="none"/></svg>';
		case 'checklist':
			return $open . '<path d="M10 6h10M10 12h10M10 18h10"/><path d="M4 5.6l1.3 1.3L7.6 4.6M4 11.6l1.3 1.3 2.3-2.3M4 17.6l1.3 1.3 2.3-2.3"/></svg>';
		case 'sparkle':
			return $open . '<path d="M12 3l1.9 5.1L19 10l-5.1 1.9L12 17l-1.9-5.1L5 10l5.1-1.9z"/></svg>';
		case 'info':
			return $open . '<circle cx="12" cy="12" r="9"/><path d="M12 11v5"/><circle cx="12" cy="7.9" r="1.1" fill="currentColor" stroke="none"/></svg>';
		case 'bulb':
			return $open . '<path d="M9.5 18h5M10.5 21h3"/><path d="M12 3a6 6 0 0 0-3.8 10.6c.7.6 1.1 1.3 1.2 2.4h5.2c.1-1.1.5-1.8 1.2-2.4A6 6 0 0 0 12 3Z"/></svg>';
		case 'alert':
			return $open . '<path d="M12 3.6 22 20.4H2z"/><path d="M12 10v4.2"/><circle cx="12" cy="17.4" r="1" fill="currentColor" stroke="none"/></svg>';
		case 'x':
			return $open . '<circle cx="12" cy="12" r="9"/><path d="M15 9l-6 6M9 9l6 6"/></svg>';
	}
	return $open . '</svg>';
}

/**
 * Render a standard learning block (icon + title + rich body).
 *
 * @param string $type    Modifier slug (styles the colour + icon tint).
 * @param string $title   Heading label.
 * @param string $icon    Icon key.
 * @param string $content Inner shortcode content.
 * @return string
 */
function novira_nv_block( $type, $title, $icon, $content ) {
	$body = wpautop( do_shortcode( trim( (string) $content ) ) );

	return sprintf(
		'<aside class="nv-block nv-block--%1$s" role="note" aria-label="%2$s"><div class="nv-block__head"><span class="nv-block__icon">%3$s</span><span class="nv-block__title">%2$s</span></div><div class="nv-block__body">%4$s</div></aside>',
		esc_attr( $type ),
		esc_html( $title ),
		novira_nv_icon( $icon ),
		$body
	);
}

/**
 * Register the learning-block shortcodes. Each takes an optional `title` and its
 * inner content becomes the body — e.g.  [nv_tip]نصّك هنا[/nv_tip].
 */
function novira_register_learning_shortcodes() {
	$blocks = array(
		'nv_learn'     => array( 'learn', __( 'ماذا ستتعلّم', 'novira-academy' ), 'target' ),
		'nv_takeaways' => array( 'takeaways', __( 'أبرز النقاط', 'novira-academy' ), 'checklist' ),
		'nv_summary'   => array( 'summary', __( 'ملخّص سريع', 'novira-academy' ), 'sparkle' ),
		'nv_note'      => array( 'note', __( 'ملاحظة مهمة', 'novira-academy' ), 'info' ),
		'nv_tip'       => array( 'tip', __( 'نصيحة نوفيرا', 'novira-academy' ), 'bulb' ),
		'nv_warning'   => array( 'warning', __( 'تنبيه', 'novira-academy' ), 'alert' ),
		'nv_mistakes'  => array( 'mistakes', __( 'أخطاء شائعة', 'novira-academy' ), 'x' ),
		'nv_callout'   => array( 'callout', __( 'للانتباه', 'novira-academy' ), 'info' ),
	);

	foreach ( $blocks as $tag => $conf ) {
		list( $type, $default_title, $icon ) = $conf;
		add_shortcode(
			$tag,
			function ( $atts, $content = '' ) use ( $type, $default_title, $icon ) {
				$atts = shortcode_atts( array( 'title' => $default_title ), $atts, 'nv_block' );
				return novira_nv_block( $type, $atts['title'], $icon, $content );
			}
		);
	}

	// Highlighted fact — a large, glanceable stat or truth.
	add_shortcode(
		'nv_fact',
		function ( $atts, $content = '' ) {
			$atts  = shortcode_atts( array( 'label' => '' ), $atts, 'nv_fact' );
			$label = '' !== $atts['label'] ? '<span class="nv-fact__label">' . esc_html( $atts['label'] ) . '</span>' : '';
			return '<aside class="nv-fact" role="note">' . $label . '<div class="nv-fact__value">' . wp_kses_post( do_shortcode( trim( (string) $content ) ) ) . '</div></aside>';
		}
	);

	// Pull quote — an emphasised in-body quotation.
	add_shortcode(
		'nv_pullquote',
		function ( $atts, $content = '' ) {
			$atts = shortcode_atts( array( 'cite' => '' ), $atts, 'nv_pullquote' );
			$cite = '' !== $atts['cite'] ? '<cite class="nv-pull__cite">' . esc_html( $atts['cite'] ) . '</cite>' : '';
			return '<figure class="nv-pull"><blockquote class="nv-pull__q">' . wp_kses_post( do_shortcode( trim( (string) $content ) ) ) . '</blockquote>' . $cite . '</figure>';
		}
	);
}
add_action( 'init', 'novira_register_learning_shortcodes' );

/* =============================================================================
 * SEARCH INTELLIGENCE (BLOG-01.2B) — metadata + structured data for articles.
 *
 * Everything below REUSES the existing SEO foundation (inc/seo.php): it extends
 * the shared breadcrumb trail, appends nodes to the shared JSON-LD @graph, and
 * references the global @ids (#organization, #website, #webpage, #breadcrumb)
 * instead of ever redefining them. Nothing here duplicates a global entity.
 * ========================================================================== */

/**
 * Expand a single blog post's breadcrumb to Home › Blog › Category › Article.
 * Feeds BOTH the visible crumb and the BreadcrumbList JSON-LD (both read
 * novira_breadcrumb_trail()), so they can never drift apart.
 *
 * @param array[] $trail Default trail.
 * @return array[]
 */
function novira_blog_breadcrumb_trail( $trail ) {
	if ( ! is_singular( 'blog_post' ) ) {
		return $trail;
	}

	$id     = get_queried_object_id();
	$crumbs = array(
		array( 'name' => __( 'الرئيسية', 'novira-academy' ), 'url' => home_url( '/' ) ),
	);

	$blog_url = get_post_type_archive_link( 'blog_post' );
	if ( $blog_url ) {
		$crumbs[] = array( 'name' => __( 'المقالات', 'novira-academy' ), 'url' => $blog_url );
	}

	$cat = novira_blog_primary_category( $id );
	if ( $cat ) {
		$term_link = get_term_link( $cat );
		if ( ! is_wp_error( $term_link ) ) {
			$crumbs[] = array( 'name' => $cat->name, 'url' => $term_link );
		}
	}

	$crumbs[] = array( 'name' => get_the_title( $id ), 'url' => get_permalink( $id ) );

	return $crumbs;
}
add_filter( 'novira_breadcrumb_trail', 'novira_blog_breadcrumb_trail' );

/**
 * Article-specific Open Graph / Twitter metadata (runs after novira_head_meta,
 * which already emits the shared description, canonical, og:image and og:type).
 */
function novira_blog_article_meta() {
	if ( ! is_singular( 'blog_post' ) ) {
		return;
	}
	$id = get_queried_object_id();

	printf( "\t<meta property=\"article:published_time\" content=\"%s\">\n", esc_attr( get_the_date( 'c', $id ) ) );
	printf( "\t<meta property=\"article:modified_time\" content=\"%s\">\n", esc_attr( get_the_modified_date( 'c', $id ) ) );

	$author = get_the_author_meta( 'display_name', (int) get_post_field( 'post_author', $id ) );
	if ( $author ) {
		printf( "\t<meta property=\"article:author\" content=\"%s\">\n", esc_attr( $author ) );
	}

	$cat = novira_blog_primary_category( $id );
	if ( $cat ) {
		printf( "\t<meta property=\"article:section\" content=\"%s\">\n", esc_attr( $cat->name ) );
	}

	$terms = get_the_terms( $id, 'blog_category' );
	if ( $terms && ! is_wp_error( $terms ) ) {
		foreach ( $terms as $term ) {
			printf( "\t<meta property=\"article:tag\" content=\"%s\">\n", esc_attr( $term->name ) );
		}
	}

	if ( has_post_thumbnail( $id ) ) {
		$thumb_id = get_post_thumbnail_id( $id );
		$src      = wp_get_attachment_image_src( $thumb_id, 'full' );
		if ( $src ) {
			printf( "\t<meta property=\"og:image:width\" content=\"%s\">\n", esc_attr( $src[1] ) );
			printf( "\t<meta property=\"og:image:height\" content=\"%s\">\n", esc_attr( $src[2] ) );
		}
		$alt = trim( (string) get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) );
		if ( '' === $alt ) {
			$alt = get_the_title( $id );
		}
		printf( "\t<meta property=\"og:image:alt\" content=\"%s\">\n", esc_attr( $alt ) );
	}
}
add_action( 'wp_head', 'novira_blog_article_meta', 2 );

/**
 * Article sources / references (dormant EEAT extension point). Returns rows of
 * [ 'title' => string, 'url' => string ]; empty by default. A future meta box or
 * filter populates it, feeding BOTH the visible references list and the Article
 * `citation` schema — one source of truth.
 *
 * @param int|null $post_id
 * @return array
 */
function novira_blog_article_sources( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();

	/**
	 * Filter the article's sources / references.
	 *
	 * @param array $sources Rows of [ 'title' => string, 'url' => string ].
	 * @param int   $post_id Article ID.
	 */
	return array_values( array_filter( (array) apply_filters( 'novira_blog_article_sources', array(), $post_id ) ) );
}

/**
 * Render the visible "المصادر والمراجع" section when the article has sources.
 * Dormant (prints nothing) until sources are supplied.
 *
 * @param int|null $post_id
 */
function novira_blog_render_sources( $post_id = null ) {
	$sources = novira_blog_article_sources( $post_id );
	if ( empty( $sources ) ) {
		return;
	}
	?>
	<aside class="nv-sources" aria-labelledby="nv-sources-title">
		<h2 id="nv-sources-title" class="nv-sources__title"><?php esc_html_e( 'المصادر والمراجع', 'novira-academy' ); ?></h2>
		<ol class="nv-sources__list">
			<?php
			foreach ( $sources as $source ) :
				if ( empty( $source['url'] ) ) {
					continue;
				}
				?>
				<li><a href="<?php echo esc_url( $source['url'] ); ?>" target="_blank" rel="nofollow noopener"><?php echo esc_html( ! empty( $source['title'] ) ? $source['title'] : $source['url'] ); ?></a></li>
			<?php endforeach; ?>
		</ol>
	</aside>
	<?php
}

/**
 * Build a VideoObject when the content embeds a YouTube video. uploadDate
 * defaults to the article's publish date (the date the video went live on this
 * page) and is filterable so the true date can be supplied without inventing one.
 *
 * @param int    $post_id
 * @param string $org_id
 * @return array|null
 */
function novira_blog_article_video_node( $post_id, $org_id ) {
	$content = (string) get_post_field( 'post_content', $post_id );
	if ( ! preg_match( '#(?:youtube\.com/(?:watch\?v=|embed/|shorts/)|youtu\.be/)([A-Za-z0-9_-]{11})#i', $content, $m ) ) {
		return null;
	}
	$vid = $m[1];

	return array(
		'@type'        => 'VideoObject',
		'@id'          => novira_canonical_url() . '#video',
		'name'         => get_the_title( $post_id ),
		'description'  => novira_meta_description(),
		'thumbnailUrl' => 'https://i.ytimg.com/vi/' . $vid . '/hqdefault.jpg',
		/** Filter the video uploadDate (ISO 8601); defaults to the publish date. */
		'uploadDate'   => apply_filters( 'novira_blog_video_upload_date', get_the_date( 'c', $post_id ), $post_id ),
		'embedUrl'     => 'https://www.youtube.com/embed/' . $vid,
		'contentUrl'   => 'https://www.youtube.com/watch?v=' . $vid,
		'publisher'    => array( '@id' => $org_id ),
	);
}

/**
 * Attach the article's structured data to the shared @graph. Every node
 * references the global Organization / WebSite / WebPage entities (never
 * redefines them). Dormant nodes (reviewer / sources / FAQ / video / topical
 * relationships) appear only when real data exists — nothing is invented.
 *
 * @param array  $graph      The @graph.
 * @param string $webpage_id Current WebPage @id.
 * @param string $org_id     Organization @id.
 * @return array
 */
function novira_blog_article_schema( $graph, $webpage_id, $org_id ) {
	if ( ! is_singular( 'blog_post' ) ) {
		return $graph;
	}

	$id         = get_queried_object_id();
	$canonical  = novira_canonical_url();
	$article_id = $canonical . '#article';
	$image_id   = $canonical . '#primaryimage';
	$author_uid = (int) get_post_field( 'post_author', $id );
	$author_id  = home_url( '/#person-' . $author_uid );
	$lang       = function_exists( 'novira_content_language' ) ? novira_content_language() : 'ar';

	// headline — Google caps ~110 chars.
	$title    = get_the_title( $id );
	$headline = $title;
	if ( function_exists( 'mb_strlen' ) && mb_strlen( $headline ) > 110 ) {
		$headline = rtrim( mb_substr( $headline, 0, 109 ) ) . '…';
	}

	// Unicode-aware word count.
	$plain      = trim( wp_strip_all_tags( strip_shortcodes( (string) get_post_field( 'post_content', $id ) ) ) );
	$word_count = ( '' === $plain ) ? 0 : count( preg_split( '/\s+/u', $plain ) );

	$article = array(
		'@type'            => 'BlogPosting',
		'@id'              => $article_id,
		'isPartOf'         => array( '@id' => $webpage_id ),
		'mainEntityOfPage' => array( '@id' => $webpage_id ),
		'headline'         => $headline,
		'name'             => $title,
		'description'      => novira_meta_description(),
		'datePublished'    => get_the_date( 'c', $id ),
		'dateModified'     => get_the_modified_date( 'c', $id ),
		'author'           => array( '@id' => $author_id ),
		'publisher'        => array( '@id' => $org_id ),
		'inLanguage'       => $lang,
		'url'              => $canonical,
	);
	if ( $word_count > 0 ) {
		$article['wordCount'] = $word_count;
	}

	$cat = novira_blog_primary_category( $id );
	if ( $cat ) {
		$article['articleSection'] = $cat->name;
	}
	$terms = get_the_terms( $id, 'blog_category' );
	if ( $terms && ! is_wp_error( $terms ) ) {
		$article['keywords'] = implode( ', ', wp_list_pluck( $terms, 'name' ) );
	}

	// Primary image → ImageObject node.
	$image_node = null;
	if ( has_post_thumbnail( $id ) ) {
		$thumb_id = get_post_thumbnail_id( $id );
		$src      = wp_get_attachment_image_src( $thumb_id, 'full' );
		if ( $src ) {
			$article['image'] = array( '@id' => $image_id );
			$image_node       = array(
				'@type'      => 'ImageObject',
				'@id'        => $image_id,
				'url'        => $src[0],
				'contentUrl' => $src[0],
				'width'      => $src[1],
				'height'     => $src[2],
			);
			$caption = wp_get_attachment_caption( $thumb_id );
			if ( $caption ) {
				$image_node['caption'] = wp_strip_all_tags( $caption );
			}
		}
	}

	// Author → Person node (tied to the org via worksFor for EEAT).
	$person = array(
		'@type'    => 'Person',
		'@id'      => $author_id,
		'name'     => get_the_author_meta( 'display_name', $author_uid ),
		'url'      => get_author_posts_url( $author_uid ),
		'worksFor' => array( '@id' => $org_id ),
	);
	$bio = trim( (string) get_the_author_meta( 'description', $author_uid ) );
	if ( '' !== $bio ) {
		$person['description'] = $bio;
	}
	$avatar = get_avatar_url( $author_uid, array( 'size' => 256 ) );
	if ( $avatar ) {
		$person['image'] = $avatar;
	}
	/** Filter: author sameAs profile URLs (dormant EEAT extension point). */
	$author_same = array_values( array_filter( (array) apply_filters( 'novira_blog_author_sameas', array(), $author_uid ) ) );
	if ( $author_same ) {
		$person['sameAs'] = $author_same;
	}

	// Reviewer → Person contributor (dormant EEAT extension point).
	$reviewer      = (array) apply_filters( 'novira_blog_article_reviewer', array(), $id );
	$reviewer_node = null;
	if ( ! empty( $reviewer['name'] ) ) {
		$reviewer_id   = $canonical . '#reviewer';
		$reviewer_node = array( '@type' => 'Person', '@id' => $reviewer_id, 'name' => $reviewer['name'] );
		if ( ! empty( $reviewer['url'] ) ) {
			$reviewer_node['url'] = $reviewer['url'];
		}
		$article['contributor'] = array( '@id' => $reviewer_id );
	}

	// Sources → citation (dormant EEAT extension point).
	$sources = novira_blog_article_sources( $id );
	if ( $sources ) {
		$citations = array();
		foreach ( $sources as $source ) {
			if ( empty( $source['url'] ) ) {
				continue;
			}
			$citations[] = array(
				'@type' => 'CreativeWork',
				'name'  => ! empty( $source['title'] ) ? $source['title'] : $source['url'],
				'url'   => $source['url'],
			);
		}
		if ( $citations ) {
			$article['citation'] = $citations;
		}
	}

	// Topical relationships (dormant — future entity architecture: link an article
	// to a program / exam / course @id to build topical authority over time).
	$map_ids = function ( $refs ) {
		return array_map(
			function ( $ref ) {
				return array( '@id' => $ref );
			},
			$refs
		);
	};
	$about = array_values( array_filter( (array) apply_filters( 'novira_blog_article_about', array(), $id ) ) );
	if ( $about ) {
		$article['about'] = $map_ids( $about );
	}
	$mentions = array_values( array_filter( (array) apply_filters( 'novira_blog_article_mentions', array(), $id ) ) );
	if ( $mentions ) {
		$article['mentions'] = $map_ids( $mentions );
	}

	// Point the shared WebPage node at the article + primary image.
	foreach ( $graph as $i => $node ) {
		if ( isset( $node['@id'] ) && $node['@id'] === $webpage_id ) {
			$graph[ $i ]['mainEntity'] = array( '@id' => $article_id );
			if ( $image_node ) {
				$graph[ $i ]['primaryImageOfPage'] = array( '@id' => $image_id );
			}
			break;
		}
	}

	// Append the article nodes.
	$graph[] = $article;
	$graph[] = $person;
	if ( $image_node ) {
		$graph[] = $image_node;
	}
	if ( $reviewer_node ) {
		$graph[] = $reviewer_node;
	}

	// FAQPage — dormant; only when the article supplies real Q&A.
	$faq_items    = (array) apply_filters( 'novira_blog_article_faq', array(), $id );
	$faq_entities = array();
	foreach ( $faq_items as $item ) {
		if ( empty( $item['q'] ) || empty( $item['a'] ) ) {
			continue;
		}
		$faq_entities[] = array(
			'@type'          => 'Question',
			'name'           => $item['q'],
			'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $item['a'] ),
		);
	}
	if ( $faq_entities ) {
		$graph[] = array(
			'@type'      => 'FAQPage',
			'@id'        => $canonical . '#faq',
			'mainEntity' => $faq_entities,
		);
	}

	// VideoObject — only when a YouTube embed exists.
	$video = novira_blog_article_video_node( $id, $org_id );
	if ( $video ) {
		$graph[] = $video;
	}

	return $graph;
}
add_filter( 'novira_jsonld_graph', 'novira_blog_article_schema', 10, 3 );

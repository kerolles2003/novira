<?php
/**
 * Semantic Entity Layer (BLOG-01.3A) — data architecture only.
 *
 * Lets every article connect to educational *concepts* (programs, exams,
 * subjects, universities, countries, languages, student levels, audience,
 * skills, study techniques, difficulty, journey stage) beyond flat categories.
 *
 * Each concept type is a WordPress taxonomy attached to `blog_post`. They are
 * INTENTIONALLY INTERNAL for now:
 *   - public / publicly_queryable / rewrite  => false  (no front-end, no archives)
 *   - show_ui / show_in_rest                  => false  (no default screens, not in REST)
 * so nothing is exposed publicly and nothing is emitted to SEO yet — the editor
 * manages them through one consolidated, searchable meta box.
 *
 * Future-proofing: the registry below is the single source of truth (add a type
 * by adding one row), each row carries its schema.org mapping, and a read-API
 * (novira_blog_entities / novira_blog_entity_terms) is provided so a later task
 * can feed the dormant `novira_blog_article_about` / `_mentions` schema filters
 * with zero rework here.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The semantic entity registry — SINGLE SOURCE OF TRUTH.
 *
 * key => [ plural, singular, group, schema (schema.org type for future SEO), seeds[] ]
 *   group: 'topic' | 'context' | 'geo' — how the editor meta box is grouped.
 *
 * @return array
 */
function novira_blog_entity_registry() {
	$registry = array(
		'nv_program'    => array( 'plural' => 'البرامج', 'singular' => 'برنامج', 'group' => 'topic', 'schema' => 'EducationalOccupationalProgram', 'seeds' => array( 'الدبلومة الأمريكية' ) ),
		'nv_exam'       => array( 'plural' => 'الاختبارات', 'singular' => 'اختبار', 'group' => 'topic', 'schema' => 'Course', 'seeds' => array( 'EST', 'Digital SAT', 'ACT' ) ),
		'nv_subject'    => array( 'plural' => 'المواد الدراسية', 'singular' => 'مادة', 'group' => 'topic', 'schema' => 'Thing', 'seeds' => array( 'الرياضيات', 'اللغة الإنجليزية', 'العلوم', 'القراءة والكتابة' ) ),
		'nv_skill'      => array( 'plural' => 'المهارات', 'singular' => 'مهارة', 'group' => 'topic', 'schema' => 'DefinedTerm', 'seeds' => array( 'مهارات الدراسة', 'إدارة الوقت', 'التقديم الجامعي', 'كتابة المقال' ) ),
		'nv_technique'  => array( 'plural' => 'أساليب المذاكرة', 'singular' => 'أسلوب', 'group' => 'topic', 'schema' => 'DefinedTerm', 'seeds' => array( 'الاختبارات التجريبية', 'الاسترجاع النشط', 'التكرار المتباعد' ) ),
		'nv_audience'   => array( 'plural' => 'الجمهور المستهدف', 'singular' => 'فئة', 'group' => 'context', 'schema' => 'Audience', 'seeds' => array( 'الطلاب', 'أولياء الأمور', 'المعلمون' ) ),
		'nv_level'      => array( 'plural' => 'المستوى الدراسي', 'singular' => 'مستوى', 'group' => 'context', 'schema' => 'DefinedTerm', 'seeds' => array( 'الصف العاشر', 'الصف الحادي عشر', 'الصف الثاني عشر' ) ),
		'nv_difficulty' => array( 'plural' => 'مستوى الصعوبة', 'singular' => 'صعوبة', 'group' => 'context', 'schema' => 'DefinedTerm', 'seeds' => array( 'مبتدئ', 'متوسط', 'متقدم' ) ),
		'nv_stage'      => array( 'plural' => 'مرحلة الرحلة', 'singular' => 'مرحلة', 'group' => 'context', 'schema' => 'DefinedTerm', 'seeds' => array( 'بداية الاستعداد', 'أثناء الإعداد', 'قبل الاختبار', 'بعد النتيجة' ) ),
		'nv_university' => array( 'plural' => 'الجامعات', 'singular' => 'جامعة', 'group' => 'geo', 'schema' => 'CollegeOrUniversity', 'seeds' => array() ),
		'nv_country'    => array( 'plural' => 'الدول', 'singular' => 'دولة', 'group' => 'geo', 'schema' => 'Country', 'seeds' => array( 'مصر', 'الولايات المتحدة', 'ألمانيا', 'فرنسا', 'المملكة المتحدة', 'كندا' ) ),
		'nv_language'   => array( 'plural' => 'اللغات', 'singular' => 'لغة', 'group' => 'geo', 'schema' => 'Language', 'seeds' => array( 'العربية', 'الإنجليزية', 'الألمانية', 'الفرنسية' ) ),
	);

	/**
	 * Filter the semantic entity registry (extension point — add entity types).
	 *
	 * @param array $registry key => definition.
	 */
	return apply_filters( 'novira_blog_entity_registry', $registry );
}

/**
 * Register every entity type as an internal (non-public) taxonomy on `blog_post`.
 */
function novira_blog_register_entities() {
	foreach ( novira_blog_entity_registry() as $tax => $def ) {
		register_taxonomy(
			$tax,
			array( 'blog_post' ),
			array(
				'labels'             => array(
					'name'          => $def['plural'],
					'singular_name' => $def['singular'],
					'search_items'  => $def['plural'],
					'all_items'     => $def['plural'],
					'menu_name'     => $def['plural'],
				),
				// Internal only — not exposed publicly, not in REST, no archives.
				'public'             => false,
				'publicly_queryable' => false,
				'show_ui'            => false,
				'show_in_menu'       => false,
				'show_in_nav_menus'  => false,
				'show_in_rest'       => false,
				'show_admin_column'  => false,
				'show_tagcloud'      => false,
				'hierarchical'       => false,
				'query_var'          => false,
				'rewrite'            => false,
			)
		);
	}
}
add_action( 'init', 'novira_blog_register_entities', 11 );

/**
 * Seed the controlled vocabularies once, so editors have sensible starters to
 * pick from. Idempotent (guarded by a version option); never overwrites edits.
 */
function novira_blog_seed_entities() {
	if ( get_option( 'novira_blog_entities_seeded' ) ) {
		return;
	}
	foreach ( novira_blog_entity_registry() as $tax => $def ) {
		if ( empty( $def['seeds'] ) || ! taxonomy_exists( $tax ) ) {
			continue;
		}
		foreach ( $def['seeds'] as $seed ) {
			if ( ! term_exists( $seed, $tax ) ) {
				wp_insert_term( $seed, $tax );
			}
		}
	}
	update_option( 'novira_blog_entities_seeded', '1', false );
}
add_action( 'init', 'novira_blog_seed_entities', 12 );

/* -----------------------------------------------------------------------------
 * Editor integration — one consolidated, searchable meta box.
 * -------------------------------------------------------------------------- */

/**
 * Register the "الروابط المعرفية" meta box on the blog_post editor.
 */
function novira_blog_entities_add_metabox() {
	add_meta_box(
		'nv_entities',
		__( 'الروابط المعرفية', 'novira-academy' ),
		'novira_blog_entities_render_metabox',
		'blog_post',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes_blog_post', 'novira_blog_entities_add_metabox' );

/**
 * Render the grouped, searchable entity pickers.
 *
 * @param WP_Post $post Current post.
 */
function novira_blog_entities_render_metabox( $post ) {
	wp_nonce_field( 'nv_entities_save', 'nv_entities_nonce' );

	$groups = array(
		'topic'   => __( 'الموضوع الأكاديمي', 'novira-academy' ),
		'context' => __( 'السياق والجمهور', 'novira-academy' ),
		'geo'     => __( 'روابط جغرافية ولغوية', 'novira-academy' ),
	);
	$registry = novira_blog_entity_registry();
	?>
	<p class="nv-ent-help"><?php esc_html_e( 'اربط هذا المقال بالمفاهيم التعليمية ذات الصلة لبناء شبكة معرفية بين المقالات والبرامج والاختبارات. جميع الحقول اختيارية.', 'novira-academy' ); ?></p>
	<?php foreach ( $groups as $group_key => $group_label ) : ?>
		<fieldset class="nv-ent-group">
			<legend><?php echo esc_html( $group_label ); ?></legend>
			<?php
			foreach ( $registry as $tax => $def ) :
				if ( $def['group'] !== $group_key ) {
					continue;
				}
				$assigned = wp_get_object_terms( $post->ID, $tax, array( 'fields' => 'names' ) );
				if ( is_wp_error( $assigned ) ) {
					$assigned = array();
				}
				?>
				<div class="nv-ent-field" data-tax="<?php echo esc_attr( $tax ); ?>">
					<label class="nv-ent-label"><?php echo esc_html( $def['plural'] ); ?></label>
					<div class="nv-ent-control">
						<div class="nv-ent-chips"></div>
						<input type="text" class="nv-ent-search" autocomplete="off" spellcheck="false" placeholder="<?php echo esc_attr( sprintf( __( 'ابحث أو أضف %s…', 'novira-academy' ), $def['singular'] ) ); ?>">
						<ul class="nv-ent-menu" role="listbox" hidden></ul>
					</div>
					<input type="hidden" class="nv-ent-input" name="nv_entities[<?php echo esc_attr( $tax ); ?>]" value="<?php echo esc_attr( wp_json_encode( array_values( $assigned ) ) ); ?>">
				</div>
				<?php
			endforeach;
			?>
		</fieldset>
	<?php endforeach; ?>
	<?php
}

/**
 * Persist the article's entity connections. Names are set directly, so typing a
 * new value creates its term (non-hierarchical). An empty field clears it.
 *
 * @param int $post_id Post ID.
 */
function novira_blog_entities_save( $post_id ) {
	if ( ! isset( $_POST['nv_entities_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['nv_entities_nonce'] ), 'nv_entities_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$raw = isset( $_POST['nv_entities'] ) && is_array( $_POST['nv_entities'] ) ? wp_unslash( $_POST['nv_entities'] ) : array();

	foreach ( array_keys( novira_blog_entity_registry() ) as $tax ) {
		$json  = isset( $raw[ $tax ] ) ? (string) $raw[ $tax ] : '[]';
		$names = json_decode( $json, true );
		if ( ! is_array( $names ) ) {
			$names = array();
		}
		$clean = array();
		foreach ( $names as $name ) {
			$name = sanitize_text_field( $name );
			if ( '' !== $name ) {
				$clean[] = $name;
			}
		}
		$clean = array_values( array_unique( $clean ) );
		wp_set_object_terms( $post_id, $clean, $tax, false );
	}
}
add_action( 'save_post_blog_post', 'novira_blog_entities_save' );

/**
 * Enqueue the searchable-picker assets + existing-term data on the blog_post editor.
 *
 * @param string $hook Current admin page.
 */
function novira_blog_entities_admin_assets( $hook ) {
	if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
		return;
	}
	$screen = get_current_screen();
	if ( ! $screen || 'blog_post' !== $screen->post_type ) {
		return;
	}

	wp_enqueue_style( 'nv-entities-admin', NOVIRA_URI . '/assets/css/blog-entities-admin.css', array(), filemtime( NOVIRA_DIR . '/assets/css/blog-entities-admin.css' ) );
	wp_enqueue_script( 'nv-entities-admin', NOVIRA_URI . '/assets/js/blog-entities-admin.js', array(), filemtime( NOVIRA_DIR . '/assets/js/blog-entities-admin.js' ), true );

	$terms = array();
	foreach ( array_keys( novira_blog_entity_registry() ) as $tax ) {
		$list = get_terms( array( 'taxonomy' => $tax, 'hide_empty' => false, 'fields' => 'names' ) );
		$terms[ $tax ] = is_wp_error( $list ) ? array() : array_values( $list );
	}

	wp_localize_script(
		'nv-entities-admin',
		'NV_ENT',
		array(
			'terms' => $terms,
			'i18n'  => array(
				'add'    => __( 'إضافة', 'novira-academy' ),
				'none'   => __( 'لا توجد نتائج — اكتب للإضافة', 'novira-academy' ),
				'remove' => __( 'إزالة', 'novira-academy' ),
			),
		)
	);
}
add_action( 'admin_enqueue_scripts', 'novira_blog_entities_admin_assets' );

/* -----------------------------------------------------------------------------
 * Read API + schema mapping — provided for FUTURE use (SEO / frontend). Not
 * called anywhere yet, per this task's "data architecture only" constraint.
 * -------------------------------------------------------------------------- */

/**
 * The schema.org type mapped to an entity taxonomy (future entity-graph wiring).
 *
 * @param string $tax Taxonomy key.
 * @return string schema.org @type.
 */
function novira_blog_entity_schema_type( $tax ) {
	$registry = novira_blog_entity_registry();
	return isset( $registry[ $tax ]['schema'] ) ? $registry[ $tax ]['schema'] : 'Thing';
}

/**
 * Terms of one entity taxonomy assigned to a post.
 *
 * @param int    $post_id Post ID.
 * @param string $tax     Taxonomy key.
 * @return WP_Term[]
 */
function novira_blog_entity_terms( $post_id, $tax ) {
	$terms = get_the_terms( $post_id, $tax );
	return is_array( $terms ) ? $terms : array();
}

/**
 * All entity connections for a post, grouped by taxonomy (non-empty only).
 *
 * @param int|null $post_id Post ID.
 * @return array<string,WP_Term[]>
 */
function novira_blog_entities( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$out     = array();
	foreach ( array_keys( novira_blog_entity_registry() ) as $tax ) {
		$terms = novira_blog_entity_terms( $post_id, $tax );
		if ( $terms ) {
			$out[ $tax ] = $terms;
		}
	}
	return $out;
}

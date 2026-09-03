<?php
/**
 * External Exam Integration Layer
 *
 * Provides architecture for integrating with external exam providers.
 * This is a stub for future implementation.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Novira_Exam_Integration
 *
 * Handles integration with external exam providers.
 */
class Novira_Exam_Integration {

	/**
	 * Singleton instance
	 *
	 * @var Novira_Exam_Integration|null
	 */
	private static $instance = null;

	/**
	 * Registered exam providers
	 *
	 * @var array
	 */
	private $providers = array();

	/**
	 * Get singleton instance
	 *
	 * @return Novira_Exam_Integration
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor
	 */
	private function __construct() {
		$this->init_hooks();
	}

	/**
	 * Initialize hooks
	 */
	private function init_hooks() {
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'add_meta_boxes', array( $this, 'add_exam_meta_boxes' ) );
		add_action( 'save_post_novira_exam', array( $this, 'save_exam_meta' ) );
		
		// Allow plugins to register exam providers
		do_action( 'novira_register_exam_providers', $this );
	}

	/**
	 * Register exam post type
	 */
	public function register_post_types() {
		$labels = array(
			'name'               => _x( 'الامتحانات', 'post type general name', 'novira-academy' ),
			'singular_name'      => _x( 'امتحان', 'post type singular name', 'novira-academy' ),
			'menu_name'          => _x( 'الامتحانات', 'admin menu', 'novira-academy' ),
			'add_new'            => __( 'إضافة امتحان جديد', 'novira-academy' ),
			'add_new_item'       => __( 'إضافة امتحان جديد', 'novira-academy' ),
			'edit_item'          => __( 'تعديل الامتحان', 'novira-academy' ),
			'new_item'           => __( 'امتحان جديد', 'novira-academy' ),
			'view_item'          => __( 'عرض الامتحان', 'novira-academy' ),
			'search_items'       => __( 'بحث في الامتحانات', 'novira-academy' ),
			'not_found'          => __( 'لا توجد اमتحانات', 'novira-academy' ),
			'not_found_in_trash' => __( 'لا توجد امتحانات في سلة المهملات', 'novira-academy' ),
			'all_items'          => __( 'جميع الامتحانات', 'novira-academy' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'menu_position'      => 25,
			'menu_icon'          => 'dashicons-welcome-learn-more',
			'supports'           => array( 'title', 'editor', 'thumbnail' ),
			'has_archive'        => false,
			'rewrite'            => false,
			'show_in_rest'       => true,
		);

		register_post_type( 'novira_exam', $args );
	}

	/**
	 * Add exam meta boxes
	 */
	public function add_exam_meta_boxes() {
		add_meta_box(
			'novira_exam_details',
			__( 'تفاصيل الامتحان', 'novira-academy' ),
			array( $this, 'render_exam_details_meta_box' ),
			'novira_exam',
			'normal',
			'high'
		);

		add_meta_box(
			'novira_exam_provider',
			__( 'مزود الامتحان', 'novira-academy' ),
			array( $this, 'render_exam_provider_meta_box' ),
			'novira_exam',
			'side',
			'high'
		);
	}

	/**
	 * Render exam details meta box
	 *
	 * @param WP_Post $post Current post object
	 */
	public function render_exam_details_meta_box( $post ) {
		wp_nonce_field( 'novira_exam_details', 'novira_exam_details_nonce' );
		
		$exam_url      = get_post_meta( $post->ID, '_novira_exam_url', true );
		$exam_duration = get_post_meta( $post->ID, '_novira_exam_duration', true );
		$exam_passing  = get_post_meta( $post->ID, '_novira_exam_passing_score', true );
		?>
		<p>
			<label for="novira_exam_url"><?php esc_html_e( 'رابط الامتحان', 'novira-academy' ); ?></label>
			<input type="url" id="novira_exam_url" name="novira_exam_url" value="<?php echo esc_attr( $exam_url ); ?>" class="widefat">
		</p>
		<p>
			<label for="novira_exam_duration"><?php esc_html_e( 'مدة الامتحان (دقيقة)', 'novira-academy' ); ?></label>
			<input type="number" id="novira_exam_duration" name="novira_exam_duration" value="<?php echo esc_attr( $exam_duration ); ?>" class="widefat" min="1">
		</p>
		<p>
			<label for="novira_exam_passing_score"><?php esc_html_e( 'درجة النجاح (%)', 'novira-academy' ); ?></label>
			<input type="number" id="novira_exam_passing_score" name="novira_exam_passing_score" value="<?php echo esc_attr( $exam_passing ); ?>" class="widefat" min="0" max="100">
		</p>
		<?php
	}

	/**
	 * Render exam provider meta box
	 *
	 * @param WP_Post $post Current post object
	 */
	public function render_exam_provider_meta_box( $post ) {
		$provider = get_post_meta( $post->ID, '_novira_exam_provider', true );
		?>
		<p>
			<label for="novira_exam_provider"><?php esc_html_e( 'مزود الامتحان', 'novira-academy' ); ?></label>
			<select id="novira_exam_provider" name="novira_exam_provider" class="widefat">
				<option value=""><?php esc_html_e( 'اختر مزود الامتحان', 'novira-academy' ); ?></option>
				<option value="microsoft_forms" <?php selected( $provider, 'microsoft_forms' ); ?>><?php esc_html_e( 'Microsoft Forms', 'novira-academy' ); ?></option>
				<option value="google_forms" <?php selected( $provider, 'google_forms' ); ?>><?php esc_html_e( 'Google Forms', 'novira-academy' ); ?></option>
				<option value="custom" <?php selected( $provider, 'custom' ); ?>><?php esc_html_e( 'مخصص', 'novira-academy' ); ?></option>
			</select>
		</p>
		<?php
	}

	/**
	 * Save exam meta
	 *
	 * @param int $post_id Post ID
	 */
	public function save_exam_meta( $post_id ) {
		if ( ! isset( $_POST['novira_exam_details_nonce'] ) || ! wp_verify_nonce( $_POST['novira_exam_details_nonce'], 'novira_exam_details' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		$fields = array(
			'novira_exam_url',
			'novira_exam_duration',
			'novira_exam_passing_score',
			'novira_exam_provider',
		);

		foreach ( $fields as $field ) {
			if ( isset( $_POST[ $field ] ) ) {
				update_post_meta( $post_id, '_' . $field, sanitize_text_field( $_POST[ $field ] ) );
			}
		}

		do_action( 'novira_save_exam_meta', $post_id, $_POST );
	}

	/**
	 * Register an exam provider
	 *
	 * @param string $provider_id Provider identifier
	 * @param array  $args Provider arguments
	 */
	public function register_provider( $provider_id, $args ) {
		$defaults = array(
			'name'        => '',
			'description' => '',
			'embed_url'   => '',
			'api_url'     => '',
			'callback'    => '',
		);

		$args = wp_parse_args( $args, $defaults );
		$this->providers[ $provider_id ] = $args;
		
		do_action( 'novira_exam_provider_registered', $provider_id, $args );
	}

	/**
	 * Get registered providers
	 *
	 * @return array
	 */
	public function get_providers() {
		return $this->providers;
	}

	/**
	 * Get provider by ID
	 *
	 * @param string $provider_id Provider identifier
	 * @return array|false Provider data or false if not found
	 */
	public function get_provider( $provider_id ) {
		return isset( $this->providers[ $provider_id ] ) ? $this->providers[ $provider_id ] : false;
	}

	/**
	 * Render exam embed
	 *
	 * @param int $exam_id Exam post ID
	 * @return string HTML embed code
	 */
	public function render_exam_embed( $exam_id ) {
		$provider = get_post_meta( $exam_id, '_novira_exam_provider', true );
		$exam_url = get_post_meta( $exam_id, '_novira_exam_url', true );

		if ( empty( $provider ) || empty( $exam_url ) ) {
			return '';
		}

		/**
		 * Filter the exam embed code
		 *
		 * @param string $embed_code The embed code
		 * @param int    $exam_id    The exam ID
		 * @param string $provider   The provider ID
		 */
		return apply_filters( 'novira_exam_embed_code', '', $exam_id, $provider );
	}
}

/**
 * Get exam integration instance
 *
 * @return Novira_Exam_Integration
 */
function novira_get_exam_integration() {
	return Novira_Exam_Integration::get_instance();
}

// Initialize exam integration
novira_get_exam_integration();

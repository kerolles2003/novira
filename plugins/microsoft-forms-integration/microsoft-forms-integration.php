<?php
/**
 * Plugin Name: Novira Microsoft Forms Integration
 * Plugin URI: https://novira-academy.com/plugins/microsoft-forms-integration
 * Description: Microsoft Forms integration for Novira Academy theme
 * Version: 1.0.0
 * Author: Novira Academy
 * Author URI: https://novira-academy.com
 * License: GPL-2.0+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: novira-microsoft-forms
 * Domain Path: /languages
 * Requires at least: 5.0
 * Requires PHP: 7.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin Constants
 */
define( 'NOVIRA_MS_FORMS_VERSION', '1.0.0' );
define( 'NOVIRA_MS_FORMS_DIR', plugin_dir_path( __FILE__ ) );
define( 'NOVIRA_MS_FORMS_URL', plugin_dir_url( __FILE__ ) );

/**
 * Class Novira_Microsoft_Forms_Integration
 *
 * Main plugin class
 */
class Novira_Microsoft_Forms_Integration {

	/**
	 * Singleton instance
	 *
	 * @var Novira_Microsoft_Forms_Integration|null
	 */
	private static $instance = null;

	/**
	 * Get singleton instance
	 *
	 * @return Novira_Microsoft_Forms_Integration
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
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
		
		add_action( 'init', array( $this, 'init' ) );
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		
		// Register with Novira Exam Integration
		add_action( 'novira_register_exam_providers', array( $this, 'register_provider' ) );
		
		// Embed filter
		add_filter( 'novira_exam_embed_code', array( $this, 'render_embed' ), 10, 3 );
	}

	/**
	 * Plugin activation
	 */
	public function activate() {
		// Set default options
		add_option( 'novira_ms_forms_client_id', '' );
		add_option( 'novira_ms_forms_tenant_id', '' );
		add_option( 'novira_ms_forms_api_key', '' );
		
		// Flush rewrite rules
		flush_rewrite_rules();
	}

	/**
	 * Plugin deactivation
	 */
	public function deactivate() {
		flush_rewrite_rules();
	}

	/**
	 * Initialize plugin
	 */
	public function init() {
		load_plugin_textdomain( 'novira-microsoft-forms', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Add admin menu
	 */
	public function add_admin_menu() {
		add_options_page(
			__( 'Microsoft Forms Integration', 'novira-microsoft-forms' ),
			__( 'Microsoft Forms', 'novira-microsoft-forms' ),
			'manage_options',
			'novira-ms-forms',
			array( $this, 'render_settings_page' )
		);
	}

	/**
	 * Register settings
	 */
	public function register_settings() {
		register_setting( 'novira_ms_forms_settings', 'novira_ms_forms_client_id' );
		register_setting( 'novira_ms_forms_settings', 'novira_ms_forms_tenant_id' );
		register_setting( 'novira_ms_forms_settings', 'novira_ms_forms_api_key' );
	}

	/**
	 * Render settings page
	 */
	public function render_settings_page() {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Microsoft Forms Integration Settings', 'novira-microsoft-forms' ); ?></h1>
			<form method="post" action="options.php">
				<?php settings_fields( 'novira_ms_forms_settings' ); ?>
				<table class="form-table">
					<tr>
						<th scope="row"><?php esc_html_e( 'Client ID', 'novira-microsoft-forms' ); ?></th>
						<td>
							<input type="text" name="novira_ms_forms_client_id" value="<?php echo esc_attr( get_option( 'novira_ms_forms_client_id' ) ); ?>" class="regular-text">
							<p class="description"><?php esc_html_e( 'Azure AD Application Client ID', 'novira-microsoft-forms' ); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Tenant ID', 'novira-microsoft-forms' ); ?></th>
						<td>
							<input type="text" name="novira_ms_forms_tenant_id" value="<?php echo esc_attr( get_option( 'novira_ms_forms_tenant_id' ) ); ?>" class="regular-text">
							<p class="description"><?php esc_html_e( 'Azure AD Tenant ID', 'novira-microsoft-forms' ); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'API Key', 'novira-microsoft-forms' ); ?></th>
						<td>
							<input type="password" name="novira_ms_forms_api_key" value="<?php echo esc_attr( get_option( 'novira_ms_forms_api_key' ) ); ?>" class="regular-text">
							<p class="description"><?php esc_html_e( 'Microsoft Graph API Key (optional)', 'novira-microsoft-forms' ); ?></p>
						</td>
					</tr>
				</table>
				<?php submit_button(); ?>
			</form>
			
			<h2><?php esc_html_e( 'Usage', 'novira-microsoft-forms' ); ?></h2>
			<p><?php esc_html_e( 'To use Microsoft Forms in your exams:', 'novira-microsoft-forms' ); ?></p>
			<ol>
				<li><?php esc_html_e( 'Create a form in Microsoft Forms', 'novira-microsoft-forms' ); ?></li>
				<li><?php esc_html_e( 'Copy the form URL', 'novira-microsoft-forms' ); ?></li>
				<li><?php esc_html_e( 'Create a new exam in WordPress', 'novira-microsoft-forms' ); ?></li>
				<li><?php esc_html_e( 'Select "Microsoft Forms" as the provider', 'novira-microsoft-forms' ); ?></li>
				<li><?php esc_html_e( 'Paste the form URL', 'novira-microsoft-forms' ); ?></li>
			</ol>
		</div>
		<?php
	}

	/**
	 * Register with Novira Exam Integration
	 *
	 * @param object $integration Exam integration instance
	 */
	public function register_provider( $integration ) {
		$integration->register_provider( 'microsoft_forms', array(
			'name'        => __( 'Microsoft Forms', 'novira-microsoft-forms' ),
			'description' => __( 'Microsoft Forms integration for exams and surveys', 'novira-microsoft-forms' ),
			'embed_url'   => 'https://forms.office.com',
			'api_url'     => 'https://graph.microsoft.com/v1.0',
			'callback'    => array( $this, 'render_embed' ),
		) );
	}

	/**
	 * Render Microsoft Forms embed
	 *
	 * @param string $embed_code Current embed code
	 * @param int    $exam_id    Exam post ID
	 * @param string $provider   Provider ID
	 * @return string Modified embed code
	 */
	public function render_embed( $embed_code, $exam_id, $provider ) {
		if ( 'microsoft_forms' !== $provider ) {
			return $embed_code;
		}

		$exam_url = get_post_meta( $exam_id, '_novira_exam_url', true );
		
		if ( empty( $exam_url ) ) {
			return $embed_code;
		}

		// Convert forms.office.com URL to embed format
		$embed_url = str_replace( '/response.aspx', '/embed', $exam_url );
		
		// Add UTM parameters for tracking
		$separator = strpos( $embed_url, '?' ) !== false ? '&' : '?';
		$embed_url .= $separator . 'utm_source=novira_academy&utm_medium=portal';

		return sprintf(
			'<div class="novira-ms-forms-embed">
				<iframe src="%s" width="100%%" height="600" frameborder="0" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
			</div>',
			esc_url( $embed_url )
		);
	}
}

/**
 * Initialize plugin
 */
function novira_ms_forms_init() {
	return Novira_Microsoft_Forms_Integration::get_instance();
}
add_action( 'plugins_loaded', 'novira_ms_forms_init' );

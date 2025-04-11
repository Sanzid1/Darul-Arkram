<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main CRT Manage Core Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class CRT_Manage_Extension {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Elementor_Test_Extension The single instance of the class.
	 */
	private static $_instance = null;


    protected $crt_manage_theme_name;
    /**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Test_Extension An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {

        $this->crt_manage_theme_name = get_option( 'template' );
        // Check if Elementor installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
            return;
        }

        // Check for required Elementor version
        if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
            return;
        }

        // Check for required PHP version
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
            return;
        }

        // Add Plugin actions
        add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );

        // Register widget scripts
        add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'widget_scripts' ]);

        // category register
        add_action( 'elementor/elements/categories_registered',[ $this, 'crt_manage_elementor_widget_categories' ] );

    }

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'crt-manage' ),
			'<strong>' . esc_html__( 'CRT Manage Core', 'crt-manage' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'crt-manage' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'crt-manage' ),
			'<strong>' . esc_html__( 'CRT Manage Core', 'crt-manage' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'crt-manage' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'crt-manage' ),
			'<strong>' . esc_html__( 'CRT Manage Core', 'crt-manage' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'crt-manage' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {

        if(file_exists(CRT_MANAGE_DIR .'/includes/customizer/addons/widgets/'.$this->crt_manage_theme_name.'/'.$this->crt_manage_theme_name.'.php')):
            require_once( CRT_MANAGE_DIR .'/includes/customizer/addons/widgets/'.$this->crt_manage_theme_name.'/'.$this->crt_manage_theme_name.'.php' );
        else:
            // Include Widget files
            require_once( CRT_MANAGE_DIR .'/includes/customizer/addons/widgets/crt-manage-widget-section-title.php' );
            require_once( CRT_MANAGE_DIR .'/includes/customizer/addons/widgets/crt-manage-widget-faq.php' );
            require_once( CRT_MANAGE_DIR .'/includes/customizer/addons/widgets/crt-manage-widget-resume.php' );
            require_once( CRT_MANAGE_DIR .'/includes/customizer/addons/widgets/crt-manage-widget-blog-post.php' );
            require_once( CRT_MANAGE_DIR .'/includes/customizer/addons/widgets/crt-manage-widget-contact-info.php' );

            // Register widget
            \Elementor\Plugin::instance()->widgets_manager->register( new \CRT_Manage_Section_Title_Widget() );
            \Elementor\Plugin::instance()->widgets_manager->register( new \CRT_Manage_Faq() );
            \Elementor\Plugin::instance()->widgets_manager->register( new \CRT_Manage_Resume() );
            \Elementor\Plugin::instance()->widgets_manager->register( new \CRT_Manage_Blog_Post() );
            \Elementor\Plugin::instance()->widgets_manager->register( new \CRT_Manage_Contact_Form() );
        endif;

	}

    public function widget_scripts() {
        wp_register_script('crt-manage-lazy-load',get_template_directory_uri() . '/assets/build/js/main.bundle.js', array('jquery'),false,true);
	}
	

    function crt_manage_elementor_widget_categories( $elements_manager ) {
        $elements_manager->add_category(
            'crt_manage_theme',
            [
                'title' => __( 'CRThemes', 'crt-manage' ),
                'icon' 	=> 'fa fa-plug',
            ]
        );
        $elements_manager->add_category(
            'crt_manage_footer_elements',
            [
                'title' => __( 'CRThemes Footer Elements', 'crt-manage' ),
                'icon' 	=> 'fa fa-plug',
            ]
		);

		$elements_manager->add_category(
            'crt_manage_header_elements',
            [
                'title' => __( 'CRThemes Header Elements', 'crt-manage' ),
                'icon' 	=> 'fa fa-plug',
            ]
        );

	}

}

CRT_Manage_Extension::instance();
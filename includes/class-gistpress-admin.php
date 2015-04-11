<?php
/**
 * GistPress Admin
 *
 * @package   GistPress
 * @subpackage  Admin
 * @author    terry chay <tychay@php.net>
 * @copyright Copyright (c) 2015, terry chay
 * @license   GPL-2.0+
 */

/**
 * Plugin class for handling admin page(s).
 */
class GistPress_Admin {
	const SLUG = 'gistpress';
	const SETTINGS_PAGE_ID = 'gistpress-settings';

	//
	// LOGGER
	// 
	/** @var object Logger object. */
	protected $logger = null;
	/**
	 * Sets a logger instance on the object.
	 *
	 * Since logging is optional, the dependency injection is done via this
	 * method, instead of being required through a constructor.
	 *
	 * Under PSR-1, this method would be called setLogger().
	 *
	 * @see https://github.com/php-fig/log/blob/master/Psr/Log/LoggerAwareInterface.php
	 *
	 * @since 1.1.0
	 *
	 * @param object $logger
	 */
	public function set_logger( $logger ) {
		$this->logger = $logger;
	}
	/**
	 * Return logger instance.
	 *
	 * Under PSR-1, this method would be called getLogger().
	 *
	 * @since 1.1.0
	 *
	 * @return object
	 */
	public function get_logger() {
		return $this->$logger;
	}
	//
	// PRIVATE PROPERTIES
	// 
	/**
	 * The gistpress object
	 * @var GistPress
	 */
	private $_gistpress = null;
	/**
	 * Path to the templates for this plugin
	 * @var string
	 */
	private $_template_dir = '';
	/** @var string suffix returned from add_admin_page for options/settings */
	private $_settings_suffix = '';
	//
	// CONSTRUCTORS
	//
	/**
	 * Just makes sure it has a reference to the gistpress object
	 * @param gistpress $gistpress The gistpress obejt
	 */
	public function __construct( $gistpress ) {
		$this->_gistpress    = $gistpress;
		$this->_template_dir = dirname(dirname(__FILE__)).'/templates';
	}

	/**
	 * Initialize stuff: To be called when plugin_loaded and in admin page.
	 * 
	 * @return [type] [description]
	 */
	public function run() {
		add_action( 'admin_init', array( $this, 'init') );
		add_action( 'admin_menu', array( $this, 'add_menu' ) );
	}

	/**
	 * Triggers on admin_init
	 */
	public function init() {
	}
	
	/**
	 * Add settings menu to wp_admin (and it's action)
	 * 
	 * @return void
	 */
	public function add_menu() {
		$this->_settings_suffix = add_options_page(
			__( 'GistPress Settings', self::SLUG ), // page title
			__( 'GistPress', self::SLUG ), //menu title
			'manage_options', // capability needed
			self::SETTINGS_PAGE_ID, // menu slug
			array( $this, 'show_settings_page' )	// content output callback
		);
		if ( $this->_settings_suffix ) {
			add_action( 'load-'.$this->_settings_suffix, array($this, 'on_load_settings' ) );
		}
	}

	/**
	 * Trigger on loading the settings page specifically (before output).
	 *
	 * - Process settings form
	 * - Add help tab and sidebar
	 * 
	 * @return void
	 */
	public function on_load_settings() {
		if ( !empty( $_POST['action'] ) ) {
			switch ( $_POST['action'] ) {
				// handle defaults form
				case self::SLUG.'-defaults':
					check_admin_referer( self::SLUG.'-defaults-verify' );
					// uncheck checkboxes are silent
					$settings = array(
						'embed_stylesheet'  => !empty( $_POST[self::SLUG.'-default-embed_stylesheet'] ),
						'show_line_numbers' => !empty( $_POST[self::SLUG.'-default-show_line_numbers'] ),
						'show_meta'         => !empty( $_POST[self::SLUG.'-default-show_meta'] ),
					);
					if ( array_key_exists( self::SLUG.'-default-highlight_color', $_POST ) ) {
						$settings['highlight_color'] = $_POST[ self::SLUG.'-default-highlight_color' ];
					}
					$this->_gistpress->update_settings( $settings );
					break;
			}
		}
		$screen = get_current_screen();
		$screen->remove_help_tabs();
		$screen->add_help_tab( array(
			'id'      => self::SLUG.'-options',
			'title'    => __( 'GistPress Defaults', self::SLUG ),
			'content'  => '',
			'callback' => array( $this, 'show_settings_help_defaults' ),
		));
		$screen->set_help_sidebar( $this->_get_settings_help_sidebar() );
		return;
	}
	/**
	 * Render the settings page
	 * 
	 * @return void
	 */
	public function show_settings_page() {
		// set some variables
		$settings = $this->_gistpress->settings;
		//  include the template
		include $this->_template_dir.'/page.settings.php';
	}
	/**
	 * Render the first help panel
	 *
	 * @return  void 
	 */
	public function show_settings_help_defaults()
	{
		include $this->_template_dir.'/help.settings-defaults.php';
	}
	/**
	 * Return contents of the help sidebar for the Settings page
	 */
	private function _get_settings_help_sidebar()
	{
		ob_start();
		include $this->_template_dir.'/help.settings-sidebar.php';
		return ob_get_clean();
	}
}
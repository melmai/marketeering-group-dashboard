<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://marketeeringgroup.com
 * @since      1.0.0
 *
 * @package    Marketeering_Group_Dashboard
 * @subpackage Marketeering_Group_Dashboard/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Marketeering_Group_Dashboard
 * @subpackage Marketeering_Group_Dashboard/admin
 * @author     Your Name <email@example.com>
 */
class Marketeering_Group_Dashboard_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $marketeering_group_dashboard    The ID of this plugin.
	 */
	private $marketeering_group_dashboard;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $marketeering_group_dashboard       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $marketeering_group_dashboard, $version ) {

		$this->marketeering_group_dashboard = $marketeering_group_dashboard;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Marketeering_Group_Dashboard_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Marketeering_Group_Dashboard_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->marketeering_group_dashboard, plugin_dir_url( __FILE__ ) . 'css/marketeering-group-dashboard-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Marketeering_Group_Dashboard_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Marketeering_Group_Dashboard_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->marketeering_group_dashboard, plugin_dir_url( __FILE__ ) . 'js/marketeering-group-dashboard-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function add_editor_capability() {
		/**
		 * Adds access to the appearance menu for the Editor role
		 */
		$role = get_role( 'editor' );
		if ($role->capabilities["edit_theme_options"]) return;
		$role->add_cap('edit_theme_options');
	}

	public function hide_menus() {
		/**
		 * Hides unnecessary menu options for Editors
		 */
		if ( current_user_can('editor') ) {

			// Hide main sidebar menu items
			remove_menu_page('tools.php');

			// Hide main sidebar submenu items
			remove_submenu_page( 'themes.php', 'themes.php' );
			remove_submenu_page( 'index.php', 'simple_history_page' );
			
		}
	}

	public function remove_dashboard_meta() {
		/**
		 * Removes unnecessary dashboard widgets
		 */
		if ( ! current_user_can( 'manage_options' ) ) {
			remove_meta_box( 'dashboard_activity', 'dashboard', 'normal'); 					// Activity
			remove_meta_box( 'dashboard_primary', 'dashboard', 'side' ); 					// WordPress Events & News
			remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); 				// At a Glance
			remove_meta_box( 'wpe_dify_news_feed', 'dashboard', 'normal' ); 				// WP Engine Widget
			remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'normal' ); 			// Yoast SEO Widget
			remove_meta_box( 'simple_history_dashboard_widget', 'dashboard', 'normal' ); 	// Simple History
		}
	}

	public function add_custom_dashboard_widgets() {
		/**
		 * Adds Marketeering Group customer support widget
		 */
		wp_add_dashboard_widget(
			'marketeering_dashboard_widget', 	// Widget slug.
			'Marketeering Group Support', 		// Title.
			'custom_dashboard_widget_content' 	// Display function.
		);

		function custom_dashboard_widget_content() {
			echo "<h3>Welcome to your WordPress Dashboard!</h3><p>Here you can add and edit pages, blog posts and menus. Check out the links below for a few video tutorials on working in WordPress.</p><p>If you ever need assistance with edits, don't hesitate to contact the Marketeering Group Development Team! Simply send a message to <a href='mailto:siteupdates@markteeringgroup.com'>siteupdates@markteeringgroup.com</a>, and we'll be happy to help you out!</p><h4>Tutorial Links</h4><ul><li><strong>Writing Blog Posts in WordPress:</strong> <a href='https://www.youtube.com/watch?v=rld_XRvAOfs' target='_blank'>WordPress Gutenberg Editor - Quick Start Tutorial</a></li><li><strong>Editing Pages with WPBakery Page Builder:</strong> <a href='https://www.youtube.com/watch?v=Vp7TaaJZKeU' target='_blank'>WPBakery Page Builder Beginners Guide</a></li><li><strong>Adding Links to the Menu:</strong> <a href='https://www.youtube.com/watch?v=ZzNwCHG_VWk' target='_blank'>How to Add Navigation Menu in WordPress</a></li></ul>";
		}
	} 
}

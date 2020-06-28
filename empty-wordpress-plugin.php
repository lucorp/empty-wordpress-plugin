<?php
/*
Plugin Name: Empty Wordpress Plugin 
Plugin URI: 
Version: 
Description: 
Author: 
Author URI: 
Text Domain: empty-wordpress-plugin
Domain Path: /languages/

License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/



// For woocommerce plugins
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	// Prevent to run this file directly
	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	// Load wordpres dashicons font on frontend
	add_action( 'wp_enqueue_scripts', 'load_dashicons_front_end' );
	function load_dashicons_front_end() {
		wp_enqueue_style( 'dashicons' );
	}

    // Plugin locale
	load_plugin_textdomain( 'empty-wordpress-plugin', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	if (!class_exists('empty_wordpress_plugin')) {

		class empty_wordpress_plugin {

			public function __construct() {
				// action for load action
				add_action('woocommerce_before_single_product', array($this, 'empty_wordpress_plugin_assets'));
			}

			// Inject Assets to frontend
			function empty_wordpress_plugin_assets() {
				wp_enqueue_style('pdc-layout-styles', plugins_url('/assets/css/layout.css', __FILE__ ), '', '', '');
				wp_enqueue_script('wc-pdc-script', plugins_url('/assets/js/script.js', __FILE__));
				echo $this->empty_wordpress_plugin_assets();
			}

			function empty_wordpress_plugin_assets() {
				return 'Im empty wordpress plugin';
			}
		}

		$empty_wordpress_plugin = new empty_wordpress_plugin();
	}
}


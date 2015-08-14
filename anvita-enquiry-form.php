<?php
/*
 * Plugin Name: Anvita Enquiry Form
 * Author: Vishnu M
 * Text Domain: anvita-enquiry-form
 * Description: Plugin for generating enquiry forms
 * Version: 0.4
 */
 if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}
define( 'ANVITA_ENQUIRY_VERSION', '2.1' );
define( 'ANVITA_ENQUIRY_MINIMUM_WP_VERSION', '3.1' );
define( 'ANVITA_ENQUIRY_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'ANVITA_ENQUIRY_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'ANVITA_ENQUIRY_DELETE_LIMIT', 100000 );

register_activation_hook( __FILE__, array( 'Enquiry', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'Enquiry', 'plugin_deactivation' ) );

require_once( ANVITA_ENQUIRY_PLUGIN_DIR . 'class.enquiry.php' );
add_action( 'init', array( 'Enquiry', 'init' ) );

if ( is_admin() ) {
	require_once( ANVITA_ENQUIRY_PLUGIN_DIR . 'class.enquiry-admin.php' );
	add_action( 'init', array( 'Enquiryadmin', 'init' ) );
}

?>
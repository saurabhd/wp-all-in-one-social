<?php
/**
* Plugin Name: WP All In One Social
* Plugin URI: http://www.addwebsolution.com
* Description: WP All In One Social Plugin shows very attractive responsive social sharing buttons of  Facebook, Twitter, Google+, Pinterest, LinkedIn, Email, Reddit & Whatsapp (for mobile browsers only) to wordpress posts, pages and custom posts.
* Author: AddWeb Solution Pvt. Ltd.
* Author URI: http://www.addwebsolution.com
* Version: 1.0
* Text Domain: wp-all-in-one-social
* License: License: GPLv2 or later
**/

/**
* Restricting user to access this file directly (Security Purpose).
**/
if( ! defined( "ABSPATH" ) ) {
  die( "Sorry You Don't Have Permission To Access This Page." );
  exit;
}

/**
* Defining constant variable for plugin version, plugin path, plugin url and plugin domian name
**/
define( "WPAIOS_PLUGIN_VERSION", 1.0 );
define( "WPAIOS_PLUGIN_DIR", plugin_dir_path( __FILE__ ) );
define( "WPAIOS_PLUGIN_URL", plugins_url( '/', __FILE__ ) );
define( "WPAIOS_TEXT_DOMAIN", "wp-all-in-one-social" );

require_once WPAIOS_PLUGIN_DIR.'includes/social-widget.php';

if( is_admin() ) {
  require_once WPAIOS_PLUGIN_DIR.'includes/admin-class.php';
  new WPAIOS_AdminClass;
}
else {
  require_once WPAIOS_PLUGIN_DIR.'includes/public-class.php';
  new WPAIOS_PublicClass;
}
register_activation_hook( __FILE__, array( 'WPAIOS_AdminClass', 'wpaios_setDefault_values' ) );
register_deactivation_hook( __FILE__, array( 'WPAIOS_AdminClass', 'wpaios_deleteDefault_values' ) );
?>
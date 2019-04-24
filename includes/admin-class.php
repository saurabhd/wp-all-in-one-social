<?php
/**
* Restricting user to access this file directly (Security Purpose).
**/
if( !defined( 'ABSPATH' ) ) {
  die( "You Don't Have Permission To Access This Page" );
  exit;
}

class WPAIOS_AdminClass {
  public function __construct() {
    add_action( 'admin_menu', array( $this, 'wpaios_addmenu_page' ) );
    add_action( 'admin_head', array( $this, 'set_custom_font_icon' ) );
    add_action( 'admin_init', array( $this, 'wpaios_register_settings' ) );
    add_action( 'admin_footer', array( $this, 'wpaios_sorting_icons' ) );
    add_action( 'admin_enqueue_scripts', array( $this, 'wpaios_admin_style_and_js' ) );
    add_filter( 'plugin_action_links_'.WPAIOS_TEXT_DOMAIN.'/'.WPAIOS_TEXT_DOMAIN.'.php', array( $this, 'wpaios_add_setting_link' ) );
    add_action( 'wp_ajax_'.WPAIOS_TEXT_DOMAIN.'-icon-order', array( $this,'wpaios_change_icon_order_action' ) );
  }
  /**
  * Add plugin setting page link in plugin activation/deactivation page.
  **/
  public function wpaios_add_setting_link ( $links ) {
    $wpaios_setting_link = '<a href="admin.php?page='.WPAIOS_TEXT_DOMAIN.'">'.__( 'Settings', WPAIOS_TEXT_DOMAIN ).'</a>';
    array_unshift( $links, $wpaios_setting_link );
    return $links;
  }
  /**
  * Add Plugin Menu Page
  **/
  public function wpaios_addmenu_page() {
    add_menu_page( __( 'WP All In One Social',WPAIOS_TEXT_DOMAIN ), __( 'WPAIOS',WPAIOS_TEXT_DOMAIN ), 'manage_options', WPAIOS_TEXT_DOMAIN, array( $this, 'wpaios_plugin_setting_page' ) );
    add_submenu_page( WPAIOS_TEXT_DOMAIN, __( 'WP All In One Social',WPAIOS_TEXT_DOMAIN ), __( '&nbsp; Settings',WPAIOS_TEXT_DOMAIN ), 'manage_options', WPAIOS_TEXT_DOMAIN, array( $this, 'wpaios_plugin_setting_page' ) );
    add_submenu_page( WPAIOS_TEXT_DOMAIN, __( 'WP All In One Social',WPAIOS_TEXT_DOMAIN ), __( '&nbsp; About Us',WPAIOS_TEXT_DOMAIN ), 'manage_options', WPAIOS_TEXT_DOMAIN . '-about', array( $this, 'wpaios_plugin_about_us_page' ) );
  }
  /**
  * Add menu template
  **/
  public function wpaios_plugin_setting_page() {
    $wpaios_option = get_option( WPAIOS_TEXT_DOMAIN );
    $post_types = get_post_types( array( 'public' => true ), 'objects' );
    include WPAIOS_PLUGIN_DIR.'includes/plugin-setting-page.php';
  }
  /**
  * Add About Us Page
  **/
  public function wpaios_plugin_about_us_page() {
    $arrAddwebPlugins = array(
      'woo-cart-customizer' => 'Woo Cart Customizer',
      'aws-cookies-popup' => 'AWS Cookies Popup',
      'post-timer' => 'Post Timer',
      'football-match-tracker' => 'Football Match Tracker',
      'widget-social-share' => 'Widget Social Share'
      );
    include_once WPAIOS_PLUGIN_DIR.'includes/about-us-page.php';
  }
  /**
  * Register settings for plugin
  **/
  public function wpaios_register_settings() {
    register_setting( WPAIOS_TEXT_DOMAIN, WPAIOS_TEXT_DOMAIN, array( $this, 'wpaios_sanatize_setting' ) );
  }
  /**
  * Sanitizing the submitted text
  **/
  public function wpaios_sanatize_setting( $settings ) {
    $settings['share_text'] = trim( strip_tags( $settings['share_text'] ) );
    return $settings;
  }
  /**
  * Adding Script and style file
  **/
  public function wpaios_admin_style_and_js() {
    wp_enqueue_script( 'wpaios-admin-js', WPAIOS_PLUGIN_URL.'assets/js/wpaios-admin.js', array( 'wp-color-picker', 'jquery' ), WPAIOS_PLUGIN_VERSION, true ); 
    wp_enqueue_style( 'wpaios-admin-css', WPAIOS_PLUGIN_URL.'assets/css/admin.css', array( ), WPAIOS_PLUGIN_VERSION );
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_style( 'wpaios-font-awesome', WPAIOS_PLUGIN_URL.'assets/font-awesome/css/font-awesome.min.css', array( ), WPAIOS_PLUGIN_VERSION );
  }

  /**
  * Add icon to Plugin Menu 
  **/
  public function set_custom_font_icon() {
    ?><style type="text/css">
      /* for top level menu pages replace `{menu-slug}` with the slug name passed to `add_menu_page()` */
      #toplevel_page_<?php echo WPAIOS_TEXT_DOMAIN;?> .wp-menu-image:before {
              font-family: FontAwesome !important;
              content: '\f1e0' !important;
      }
      #toplevel_page_<?php echo WPAIOS_TEXT_DOMAIN;?> .wp-first-item a:before {
        font-family: FontAwesome !important;
        content: '\f013' !important;
        font-size: 18px;
      }
      #toplevel_page_<?php echo WPAIOS_TEXT_DOMAIN;?> li a:before {
        font-family: FontAwesome !important;
        content: '\f05a' !important;
        font-size: 18px;
      }
    </style><?php
  }

  /**
  * Sorting Social Icons
  **/
  public function wpaios_sorting_icons() {
    wp_enqueue_script( 'jquery-ui-sortable' );?>
    <script type="text/javascript">
      jQuery(document).ready(function($) {
        $('.wpaios-change-icon-order').sortable( {
          stop:function( event, ui ) {
            var wpaios_new_icon_order = '';
            $( '.wpaios-change-icon-order > div > div' ).each(function(e,i) {
              wpaios_new_icon_order += $(i).attr('id')+','; 
            });
            wpaios_new_icon_order = wpaios_new_icon_order.slice(0,wpaios_new_icon_order.length-1);
            var ajax_data={'action':'<?php echo WPAIOS_TEXT_DOMAIN.'-icon-order';?>','wpaios_new_icon_order':wpaios_new_icon_order};
            $.post(ajaxurl, ajax_data, function(response){});
          }
        } );
      });
    </script><?php
  }

  /**
   * This function is used for update order of social icons
   */
  public function wpaios_change_icon_order_action(){
    update_option( WPAIOS_TEXT_DOMAIN.'-icon-order', rtrim( $_POST['wpaios_new_icon_order'], ',' ) );
    $get_icon_order = get_option(WPAIOS_TEXT_DOMAIN.'-icon-order');
    $get_icon_order = explode( ',', trim( $get_icon_order ) );
    foreach ($get_icon_order as $key => $get_icon_order_value) {
      if( $get_icon_order_value != 'undefined' ) {
        $new_icon_order[] = $get_icon_order_value;
      }
    }
    update_option( WPAIOS_TEXT_DOMAIN.'-icon-order', $new_icon_order );
    die;
  }

  /**
  * Register Default Setting When Plugin Activate
  **/
  public function wpaios_setDefault_values(){
    $default_values = array(
      'text_enable' => '0',
      'social_icons' => array('email','facebook','twitter','googleplus','reddit','pinterest','linkedin','whatsapp'),
      'icon_size' => 'medium',
      'icon_type' => 'square',
      'facebook_color' => '#3b5998',
      'twitter_color' => '#00aced',
      'email_color' => '#848484',
      'google_color' => '#dd4b39',
      'reddit_color' => '#ff4500',
      'pinterest_color' => '#cb2027',
      'linkedin_color' => '#007bb6',
      'whatsapp_color' => '#34af23',
      'icons_position' => 'before-content',
      'icons_posts' => array('post')
      );
    $default_order = array('wpaios-email','wpaios-facebook','wpaios-twitter','wpaios-google','wpaios-reddit','wpaios-pinterest','wpaios-linkedin','wpaios-whatsapp');
    update_option( WPAIOS_TEXT_DOMAIN, $default_values );
    update_option( WPAIOS_TEXT_DOMAIN.'-icon-order', $default_order );
  }

  /**
  * Delete Default Value When Plugin Deactivate
  **/
  public function wpaios_deleteDefault_values() {
    delete_option( WPAIOS_TEXT_DOMAIN );
    delete_option( WPAIOS_TEXT_DOMAIN.'icon-order' );
  }
}
?>
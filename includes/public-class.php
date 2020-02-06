<?php
/**
* Restricting user to access this file directly (Security Purpose).
**/
if( ! defined( 'ABSPATH' ) ) {
  die( "Sorry You Don't Have Permission To Access This Page" );
  exit;
}

class WPAIOS_PublicClass {
  public function __construct() {
    add_filter( 'the_content', array( $this, 'wpaios_show_icon_content' ) );
    add_shortcode( 'wpaios', array( $this, 'wpaios_social_icon' ) );
    add_action( 'wp_enqueue_scripts', array( $this, 'wpaios_style_and_js' ) );
    add_action( 'wp_footer', array( $this, 'wpaios_show_icon_floating' ) );
    add_action( 'wp_head', array( $this, 'wpaios_icon_color_style' ) );
  }
  /**
  * Adding Social Icon Before Or After The Content
  **/
  public function wpaios_show_icon_content( $content ) {
    $option = get_option( WPAIOS_TEXT_DOMAIN );
    $icon_on = false;
    if( ! empty( $option['icons_posts'] ) && in_array( get_post_type(), $option['icons_posts'] ) ) {
      $icon_on = true;
    }

    if( !$icon_on ) {
      return $content;
    }

    $option['wpaios_icon_order'] = get_option( WPAIOS_TEXT_DOMAIN.'-icon-order' );
    if( ( is_single() || is_page() ) &&  ( $option['icons_position'] == 'before-content' ) && $icon_on ) {
      return $this->wpaios_social_icon( $option ) . $content;
    }
    elseif( ( is_single() || is_page() ) && ( $option['icons_position'] == 'after-content' ) && $icon_on ) {
      return $content . $this->wpaios_social_icon( $option );
    }
    else {
      return $content;
    }
  }

  /**
  * Adding Social Icon Floating Left Or Right Side
  **/
  public function wpaios_show_icon_floating($content) {
    $option = get_option( WPAIOS_TEXT_DOMAIN );
    $icon_on = false;
    if( ! empty( $option['icons_posts'] ) && in_array( get_post_type(), $option['icons_posts'] ) ) {
      $icon_on = true;
    }

    $option['wpaios_icon_order'] = get_option( WPAIOS_TEXT_DOMAIN.'-icon-order' );
    if( ( is_single() || is_page() ) &&  ( $option['icons_position'] == 'floating-left' ) && $icon_on ) {
      echo '<div class="wpaios-floating-left">'.$this->wpaios_social_icon( $option ).'</div>';
    }
    elseif( ( is_single() || is_page() ) &&  ( $option['icons_position'] == 'floating-right' ) && $icon_on ) {
      echo '<div class="wpaios-floating-right">'.$this->wpaios_social_icon( $option ).'</div>';
    }
    else {
      return $content;
    }
  }

  /**
  * Adding Style and Script Files
  **/
  public function wpaios_style_and_js() {
    wp_enqueue_style( 'wpaios-style-css', WPAIOS_PLUGIN_URL.'assets/css/style.css', array(), WPAIOS_PLUGIN_VERSION );
    wp_enqueue_style( 'wpaios-font-awesome', WPAIOS_PLUGIN_URL.'assets/font-awesome/css/font-awesome.min.css', array(), WPAIOS_PLUGIN_VERSION );
  }

  /**
  * Adding Icon Color Style
  **/
  public function wpaios_icon_color_style() {
    $color_options = get_option( WPAIOS_TEXT_DOMAIN );
    echo '<style>';
      echo '.wpaios-em-color { background-color: ' . $color_options['email_color'] . '; }';
      echo '.wpaios-fb-color { background-color: ' . $color_options['facebook_color'] . '; }';
      echo '.wpaios-tw-color { background-color: ' . $color_options['twitter_color'] . '; }';
      echo '.wpaios-gp-color { background-color: ' . $color_options['google_color'] . '; }';
      echo '.wpaios-tu-color { background-color: ' . $color_options['reddit_color'] . '; }';
      echo '.wpaios-pi-color { background-color: ' . $color_options['pinterest_color'] . '; }';
      echo '.wpaios-li-color { background-color: ' . $color_options['linkedin_color'] . '; }';
      echo '.wpaios-wa-color { background-color: ' . $color_options['whatsapp_color'] . '; }';
    echo '</style>';
  }

  /**
  * Function That Use for show social icon and shortcode
  **/
  public function wpaios_social_icon( $atts ) {
    $option = get_option( WPAIOS_TEXT_DOMAIN );
    $option_order = get_option( WPAIOS_TEXT_DOMAIN . '-icon-order' );
    extract( shortcode_atts( array(
      'text_enable' => '1',
      'share_text' => '',
      'social_icons' => $option['social_icons'],
      'icon_size' => $option['icon_size'],
      'icon_type' => $option['icon_type'],
      'wpaios_icon_order' => $option_order,
      'icon_color' => '',
      'icon_hover_animation' => '1',
      'icon_animation' => $option['icon_animation'],
      ), $atts ) );
    if( !is_array( $wpaios_icon_order ) ) {
      $wpaios_icon_order = array_map( 'trim', explode( ',', $wpaios_icon_order ) );
      array_walk( $wpaios_icon_order, function( &$value, $key ) {
        $value = 'wpaios-' . $value;
      });
      $icon_order_ArrDiff = array_diff( $option_order, $wpaios_icon_order );
      if( !empty( $icon_order_ArrDiff ) ) {
        $wpaios_icon_order = array_merge( $wpaios_icon_order, $icon_order_ArrDiff );
      }
    }

    if( !is_array( $social_icons ) ) {
      $social_icons = array_map( 'trim', explode(',', $social_icons ) );
    }
    $icon_color = explode( ',', $icon_color );
    $wpaios_color = array();
    
    if( !is_array($icon_color) && !empty($icon_color)){
      foreach ( $icon_color as $icon_color_value ) {
        list( $wpaios_icon_name , $wpaios_color_name ) = explode( '=', $icon_color_value );
        $wpaios_color[$wpaios_icon_name] = $wpaios_color_name;
      }
    }
    $wpaios_color = array_combine( array_map( function( $key ) { return 'wpaios-'.$key; }, array_keys( $wpaios_color ) ), $wpaios_color );
    $wpaios_color = array_map( 'trim', $wpaios_color );
    $wpaios_icon_size = '';
    if( $icon_size == 'small') {
      $wpaios_icon_size = 'wpaios-small';
    }
    else {
      $wpaios_icon_size = 'wpaios-medium';
    }

    if( $icon_type == 'circle' ) {
        $wpaios_icon_type = 'wpaios-circle';
      }
    else {
        $wpaios_icon_type = 'wpaios-square';
    }

    remove_filter( 'the_title', 'wptexturize' );
    $post_title_get = urlencode( html_entity_decode( get_the_title() ) );
    add_filter( 'the_title', 'wptexturize' );

    $wpaios_url_link = get_the_permalink();
    $wpaios_url_link = urlencode_deep(  $wpaios_url_link );
    if( $icon_hover_animation == '1') {
      $icon_animate = $icon_animation;
    }

    $wpaios_structure = '<div class="wpaios-social-share">';
      if( $text_enable == '1' && !empty( $share_text ) && ( $option['icons_position'] != 'floating-left' && $option['icons_position'] != 'floating-right' ) ) {
        $wpaios_structure .= '<h3>'.$share_text.'</h3> &nbsp;';
      }

      foreach ( $wpaios_icon_order as $wpaios_icon_order_value ) {
        //$wpaios_icon_color = $wpaios_color[$wpaios_icon_order_value];
        $wpaios_icon_color = $wpaios_icon_order_value;
        
        switch ( $wpaios_icon_order_value ) {
          case 'wpaios-email':
            if( in_array( 'email', $social_icons ) ) {
              $wpaios_structure .= '<a href="mailto:?subject='. $post_title_get .'&body='.$wpaios_url_link.'" target="_blank" title="Email" class="' . $wpaios_icon_type . ' ' . $wpaios_icon_size . ' wpaios-em-color icon-animation ' . $icon_animate . '" style="background-color:' . $wpaios_icon_color . '"><i class="fa fa-envelope"></i></a>';
            }
            break;

          case 'wpaios-facebook':
            if( in_array( 'facebook', $social_icons ) ) {
              $wpaios_structure .= '<a href="http://www.facebook.com/sharer/sharer.php?u='.$wpaios_url_link.'" target="_blank" title="Facebook" class="' . $wpaios_icon_type . ' ' . $wpaios_icon_size . ' wpaios-fb-color icon-animation ' . $icon_animate . '" style="background-color:' . $wpaios_icon_color . '"><i class="fa fa-facebook"></i></a>';
            }
            break;

          case 'wpaios-twitter':
            if( in_array( 'twitter', $social_icons ) ) {
              $wpaios_structure .= '<a href="http://twitter.com/share?text='.$post_title_get.'&url='.$wpaios_url_link.'" target="_blank" title="Twitter" class="' . $wpaios_icon_type . ' ' . $wpaios_icon_size . ' wpaios-tw-color icon-animation ' . $icon_animate . '" style="background-color:' . $wpaios_icon_color . '"><i class="fa fa-twitter"></i></a>';
            }
            break;

          case 'wpaios-google':
            if( in_array( 'googleplus', $social_icons ) ) {
              $wpaios_structure .= '<a href="http://plus.google.com/share?url='.$wpaios_url_link.'" target="_blank" title="Google Plus" class="' . $wpaios_icon_type . ' ' . $wpaios_icon_size . ' wpaios-gp-color icon-animation ' . $icon_animate . '" style="background-color:' . $wpaios_icon_color . '"><i class="fa fa-google-plus"></i></a>';
            }
            break;

          case 'wpaios-reddit':
            if( in_array( 'reddit', $social_icons ) ) {
              $wpaios_structure .= '<a href="http://reddit.com/submit?url='.$wpaios_url_link.'&title='.$post_title_get.'" target="_blank" title="Reddit" class="' . $wpaios_icon_type . ' ' . $wpaios_icon_size . ' wpaios-tu-color icon-animation ' . $icon_animate . '" style="background-color:' . $wpaios_icon_color . '" rel="nofollow"><i class="fa fa-reddit-alien"></i></a>';
            }
            break;

          case 'wpaios-pinterest':
            if( in_array( 'pinterest', $social_icons ) ) {
              $wpaios_structure .= '<a href="http://pinterest.com/pin/create/button/?url='.$wpaios_url_link.'&description='.$post_title_get.'" target="_blank" title="Pinterest" class="' . $wpaios_icon_type . ' ' . $wpaios_icon_size . ' wpaios-pi-color icon-animation ' . $icon_animate . '" style="background-color:' . $wpaios_icon_color . '"><i class="fa fa-pinterest"></i></a>';
            }
            break;

          case 'wpaios-linkedin':
            if( in_array( 'linkedin', $social_icons ) ) {
              $wpaios_structure .= '<a href="http://www.linkedin.com/shareArticle?mini=true&url='.$wpaios_url_link.'&title='.$post_title_get.'&summary=&source=" target="_blank" title="LinkedIn" class="' . $wpaios_icon_type . ' ' . $wpaios_icon_size . ' wpaios-li-color icon-animation ' . $icon_animate . '" style="background-color:' . $wpaios_icon_color . '"><i class="fa fa-linkedin"></i></a>';
            }
            break;

          case 'wpaios-whatsapp':
            if( wp_is_mobile() ) {
              if( in_array( 'whatsapp', $social_icons ) ) {
                $wpaios_structure .= '<a href="whatsapp://send?text='.$wpaios_url_link.'" data-action="share/whatsapp/share" title="WhatsApp" class="' . $wpaios_icon_type . ' ' . $wpaios_icon_size . ' wpaios-wa-color icon-animation ' . $icon_animate . '" style="background-color:' . $wpaios_icon_color . '"><i class="fa fa-whatsapp" ></i></a>';
              }
            }
            break;
        }
      }
    $wpaios_structure .= '</div>';
    return $wpaios_structure;
  }
}
?>
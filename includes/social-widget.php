<?php 
if( ! defined('ABSPATH') ) {
  die( "Sorry You Don't Have Permission To Access This Page." );
  exit;
}
/**
* Widget Class
**/
class WPAIOS_SocialWidget extends WP_Widget {
  public function __construct() {
    parent::__construct( 'wpaios-link', __( 'WPAIOS Social Link', WPAIOS_TEXT_DOMAIN ), array( 'description' => __( 'WPAIOS Social Link Used for appear your domain page link with social icons', WPAIOS_TEXT_DOMAIN ) ) );
  }

  /**
  * Widget Admin Form Creation
  **/
  public function form( $instance ) {
    if( $instance ) {
      $wpaios_title = esc_attr( $instance[ 'wpaios_title' ] );
      $wpaios_icon_size = esc_attr( $instance[ 'wpaios_icon_size' ] );
      $wpaios_icon_type = esc_attr( $instance[ 'wpaios_icon_type' ] );
      $wpaios_icon_animation = esc_attr( $instance[ 'wpaios_icon_animation' ] );
      $wpaios_fb_url = esc_attr( $instance[ 'wpaios_fb_url' ] );
      $wpaios_tw_url = esc_attr( $instance[ 'wpaios_tw_url' ] );
      $wpaios_gp_url = esc_attr( $instance[ 'wpaios_gp_url' ] );
      $wpaios_li_url = esc_attr( $instance[ 'wpaios_li_url' ] );
      $wpaios_pi_url = esc_attr( $instance[ 'wpaios_pi_url' ] );
      $wpaios_tu_url = esc_attr( $instance[ 'wpaios_tu_url' ] );
      $wpaios_in_url = esc_attr( $instance[ 'wpaios_in_url' ] );
    }
    else {
      $wpaios_title = '';
      $wpaios_icon_size = esc_attr( 'small' );
      $wpaios_icon_type = esc_attr( 'circle' );
      $wpaios_fb_url = '';
      $wpaios_tw_url = '';
      $wpaios_gp_url = '';
      $wpaios_li_url = '';
      $wpaios_pi_url = '';
      $wpaios_tu_url = '';
      $wpaios_in_url = '';
    }

    /**
    * Widget Admin Form
    **/
    ?><p>
      <label for="<?php echo $this->get_field_id( 'wpaios_title' )?>"><?php _e( 'Title', WPAIOS_TEXT_DOMAIN ); ?></label>
      <input type="text" class="widefat" name="<?php echo $this->get_field_name( 'wpaios_title' );?>" id="<?php echo $this->get_field_id( 'wpaios_title' ); ?>" value="<?php echo $wpaios_title;?>" placeholder="i.e. Follow us on">
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'wpaios_icon_size' );?>"><?php _e( 'Select Icon Size ', WPAIOS_TEXT_DOMAIN ).' : '; ?></label>
      <select id="<?php echo $this->get_field_id( 'wpaios_icon_size' );?>" name="<?php echo $this->get_field_name( 'wpaios_icon_size' );?>" class="wpaios-select-style" style="margin-left: 5px;">
        <option value="small" <?php if( $wpaios_icon_size == 'small' ) echo 'selected="selected"';?>><?php _e( 'Small', WPAIOS_TEXT_DOMAIN ); ?></option>
        <option value="medium" <?php if( $wpaios_icon_size == 'medium' ) echo 'selected="selected"';?>><?php _e( 'Medium', WPAIOS_TEXT_DOMAIN ); ?></option>
      </select>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'wpaios_icon_type' );?>"><?php _e( 'Select Icon Type', WPAIOS_TEXT_DOMAIN ).' : '; ?></label>
      <select id="<?php echo $this->get_field_id( 'wpaios_icon_type' );?>" name="<?php echo $this->get_field_name( 'wpaios_icon_type' );?>" class="wpaios-select-style" style="margin-left: 2px;">
        <option value="circle" <?php if( $wpaios_icon_type == 'circle' ) echo 'selected="selected"';?>><?php _e( 'Circle', WPAIOS_TEXT_DOMAIN ); ?></option>
        <option value="square" <?php if( $wpaios_icon_type == 'square' ) echo 'selected="selected"';?>><?php _e( 'Square', WPAIOS_TEXT_DOMAIN ); ?></option>
      </select>
    </p>
    <p>
      <label><?php _e( 'Icon Hover Animation', WPAIOS_TEXT_DOMAIN ).' : '; ?></label>
      <div class="wpaios-switch">
        <input type="checkbox" name="<?php echo $this->get_field_name( 'wpaios_icon_animation' );?>" <?php if( $wpaios_icon_animation == '1' ) echo 'checked="checked"';?> value="1" id="<?php echo $this->get_field_id( 'wpaios_icon_animation' );?>" class="wpaios-toggle wpaios-toggle-round">
        <label for="<?php echo $this->get_field_id( 'wpaios_icon_animation' );?>"></label>
      </div>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'wpaios_fb_url' )?>"><?php _e( 'Facbook URL', WPAIOS_TEXT_DOMAIN ); ?></label>
      <input type="text" class="widefat" name="<?php echo $this->get_field_name( 'wpaios_fb_url' );?>" id="<?php echo $this->get_field_id( 'wpaios_fb_url' ); ?>" value="<?php echo $wpaios_fb_url;?>" placeholder="http://www.facebook.com/yourid">
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'wpaios_tw_url' )?>"><?php _e( 'Twitter URL', WPAIOS_TEXT_DOMAIN ); ?></label>
      <input type="text" class="widefat" name="<?php echo $this->get_field_name( 'wpaios_tw_url' );?>" id="<?php echo $this->get_field_id( 'wpaios_tw_url' ); ?>" value="<?php echo $wpaios_tw_url;?>" placeholder="http://www.twitter.com/yourid">
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'wpaios_gp_url' )?>"><?php _e( 'Google Plus URL', WPAIOS_TEXT_DOMAIN ); ?></label>
      <input type="text" class="widefat" name="<?php echo $this->get_field_name( 'wpaios_gp_url' );?>" id="<?php echo $this->get_field_id( 'wpaios_gp_url' ); ?>" value="<?php echo $wpaios_gp_url;?>" placeholder="http://plus.google.com/yourid">
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'wpaios_li_url' )?>"><?php _e( 'LinkedIn URL', WPAIOS_TEXT_DOMAIN ); ?></label>
      <input type="text" class="widefat" name="<?php echo $this->get_field_name( 'wpaios_li_url' );?>" id="<?php echo $this->get_field_id( 'wpaios_li_url' ); ?>" value="<?php echo $wpaios_li_url;?>" placeholder="http://www.linkedin.com/in/yourid">
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'wpaios_in_url' )?>"><?php _e( 'Instagram URL', WPAIOS_TEXT_DOMAIN ); ?></label>
      <input type="text" class="widefat" name="<?php echo $this->get_field_name( 'wpaios_in_url' );?>" id="<?php echo $this->get_field_id( 'wpaios_in_url' ); ?>" value="<?php echo $wpaios_in_url;?>" placeholder="http://www.instagram.com/yourid">
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'wpaios_pi_url' )?>"><?php _e( 'Pinterest URL', WPAIOS_TEXT_DOMAIN ); ?></label>
      <input type="text" class="widefat" name="<?php echo $this->get_field_name( 'wpaios_pi_url' );?>" id="<?php echo $this->get_field_id( 'wpaios_pi_url' ); ?>" value="<?php echo $wpaios_pi_url;?>" placeholder="http://www.pinterest.com/yourid">
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'wpaios_tu_url' )?>"><?php _e( 'Tumblr URL', WPAIOS_TEXT_DOMAIN ); ?></label>
      <input type="text" class="widefat" name="<?php echo $this->get_field_name( 'wpaios_tu_url' );?>" id="<?php echo $this->get_field_id( 'wpaios_tu_url' ); ?>" value="<?php echo $wpaios_tu_url;?>" placeholder="http://yourid.tumblr.com">
    </p><?php
  }
  /**
  * Widget Value Update
  **/
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['wpaios_title'] = esc_attr( $new_instance['wpaios_title'] );
    $instance['wpaios_icon_size'] = esc_attr( $new_instance['wpaios_icon_size'] );
    $instance['wpaios_icon_type'] = esc_attr( $new_instance['wpaios_icon_type'] );
    $instance['wpaios_icon_animation'] = esc_attr( $new_instance['wpaios_icon_animation'] );
    $instance['wpaios_fb_url'] = esc_attr( $new_instance['wpaios_fb_url'] );
    $instance['wpaios_tw_url'] = esc_attr( $new_instance['wpaios_tw_url'] );
    $instance['wpaios_gp_url'] = esc_attr( $new_instance['wpaios_gp_url'] );
    $instance['wpaios_li_url'] = esc_attr( $new_instance['wpaios_li_url'] );
    $instance['wpaios_pi_url'] = esc_attr( $new_instance['wpaios_pi_url'] );
    $instance['wpaios_tu_url'] = esc_attr( $new_instance['wpaios_tu_url'] );
    $instance['wpaios_in_url'] = esc_attr( $new_instance['wpaios_in_url'] );

    return $instance;
  }

  /**
  * Widget Frontend View
  **/
  public function widget( $args, $instance ){
    $wpaios_title = apply_filters( 'wpaios_widget_title', $instance['wpaios_title'] );
    if( $instance['wpaios_icon_type'] == 'circle' ) {
      $wpaios_fb_icon_url = WPAIOS_PLUGIN_URL.'assets/wpaios-icons/facebook-circle.svg';
      $wpaios_tw_icon_url = WPAIOS_PLUGIN_URL.'assets/wpaios-icons/twitter-circle.svg';
      $wpaios_gp_icon_url = WPAIOS_PLUGIN_URL.'assets/wpaios-icons/google-plus-circle.svg';
      $wpaios_pi_icon_url = WPAIOS_PLUGIN_URL.'assets/wpaios-icons/pinterest-circle.svg';
      $wpaios_li_icon_url = WPAIOS_PLUGIN_URL.'assets/wpaios-icons/linkedin-circle.svg';
      $wpaios_tu_icon_url = WPAIOS_PLUGIN_URL.'assets/wpaios-icons/tumblr-circle.svg';
      $wpaios_in_icon_url = WPAIOS_PLUGIN_URL.'assets/wpaios-icons/instagram-circle.svg';
    }
    else {
      $wpaios_fb_icon_url = WPAIOS_PLUGIN_URL.'assets/wpaios-icons/facebook-square.svg';
      $wpaios_tw_icon_url = WPAIOS_PLUGIN_URL.'assets/wpaios-icons/twitter-square.svg';
      $wpaios_gp_icon_url = WPAIOS_PLUGIN_URL.'assets/wpaios-icons/google-plus-square.svg';
      $wpaios_pi_icon_url = WPAIOS_PLUGIN_URL.'assets/wpaios-icons/pinterest-square.svg';
      $wpaios_li_icon_url = WPAIOS_PLUGIN_URL.'assets/wpaios-icons/linkedin-square.svg';
      $wpaios_tu_icon_url = WPAIOS_PLUGIN_URL.'assets/wpaios-icons/tumblr-square.svg';
      $wpaios_in_icon_url = WPAIOS_PLUGIN_URL.'assets/wpaios-icons/instagram-square.svg';
    }
    /**
    * Apply Filter On Icon Url So User Can Change Path Of Icon Url By Add Filter
    **/
    $wpaios_fb_icon_url = apply_filters( 'wpaios_fb_icon_url', $wpaios_fb_icon_url );
    $wpaios_tw_icon_url = apply_filters( 'wpaios_tw_icon_url', $wpaios_tw_icon_url );
    $wpaios_gp_icon_url = apply_filters( 'wpaios_gp_icon_url', $wpaios_gp_icon_url );
    $wpaios_pi_icon_url = apply_filters( 'wpaios_pi_icon_url', $wpaios_pi_icon_url );
    $wpaios_li_icon_url = apply_filters( 'wpaios_li_icon_url', $wpaios_li_icon_url );
    $wpaios_tu_icon_url = apply_filters( 'wpaios_tu_icon_url', $wpaios_tu_icon_url );
    $wpaios_in_icon_url = apply_filters( 'wpaios_in_icon_url', $wpaios_in_icon_url );

    if( $instance[ 'wpaios_icon_size' ] == 'small' ) {
      $wpaios_icon_size = 'wpaios-widget-social-small';
    }
    else {
      $wpaios_icon_size = 'wpaios-widget-social-medium';
    }

    if( $instance[ 'wpaios_icon_animation' ] == '1' ) {
      $wpaios_animate_class = 'icon-animation icon-rotate';
    }
    else {
      $wpaios_animate_class = '';
    }

    echo $args[ 'before_widget' ];
      if( !empty( $wpaios_title ) ) {
        echo $args[ 'before_title' ] . __( $wpaios_title, WPAIOS_TEXT_DOMAIN ). $args[ 'after_title' ];
      }
      echo '<div class="wpaios-social-icon-wg">';
        if( !empty( $instance[ 'wpaios_fb_url' ] ) ) {
          echo '<a href="'.$instance['wpaios_fb_url'].'" target="_blank" title="Facebook Page"><img src="'.$wpaios_fb_icon_url.'" class="'.$wpaios_animate_class.' '.$wpaios_icon_size.' wpaios-icon-space"></a>';
        }
        if( !empty( $instance[ 'wpaios_tw_url' ] ) ) {
          echo '<a href="'.$instance['wpaios_tw_url'].'" target="_blank" title="Twitter Page"><img src="'.$wpaios_tw_icon_url.'" class="'.$wpaios_animate_class.' '.$wpaios_icon_size.' wpaios-icon-space"></a>';
        }
        if( !empty( $instance[ 'wpaios_gp_url' ] ) ) {
          echo '<a href="'.$instance['wpaios_gp_url'].'" target="_blank" title="Google Plus Page"><img src="'.$wpaios_gp_icon_url.'" class="'.$wpaios_animate_class.' '.$wpaios_icon_size.' wpaios-icon-space"></a>';
        }
        if( !empty( $instance[ 'wpaios_li_url' ] ) ) {
          echo '<a href="'.$instance['wpaios_li_url'].'" target="_blank" title="LinkedIn Page"><img src="'.$wpaios_li_icon_url.'" class="'.$wpaios_animate_class.' '.$wpaios_icon_size.' wpaios-icon-space"></a>';
        }
        if( !empty( $instance[ 'wpaios_in_url' ] ) ) {
          echo '<a href="'.$instance['wpaios_in_url'].'" target="_blank" title="Instagram Page" ><img src="'.$wpaios_in_icon_url.'" class="'.$wpaios_animate_class.' '.$wpaios_icon_size.' wpaios-icon-space"></a>';
        }
        if( !empty( $instance[ 'wpaios_pi_url' ] ) ) {
          echo '<a href="'.$instance['wpaios_pi_url'].'" target="_blank" title="Pinterest Page"><img src="'.$wpaios_pi_icon_url.'" class="'.$wpaios_animate_class.' '.$wpaios_icon_size.' wpaios-icon-space"></a>';
        }
        if( !empty( $instance[ 'wpaios_tu_url' ] ) ) {
          echo '<a href="'.$instance['wpaios_tu_url'].'" target="_blank" title="Tumblr Page" ><img src="'.$wpaios_tu_icon_url.'" class="'.$wpaios_animate_class.' '.$wpaios_icon_size.' wpaios-icon-space"></a>';
        }
      echo '</div>';
    echo $args['after_widget'];
  }
}

/**
* Register and Load Widget
**/
function wpaios_social_widget_register() {
  register_widget( 'WPAIOS_SocialWidget' );
}
add_action( 'widgets_init', 'wpaios_social_widget_register' );
?>
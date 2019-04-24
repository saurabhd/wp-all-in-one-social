<?php
/**
* Restricting user to access this file directly (Security Purpose).
**/
  if( ! defined( 'ABSPATH' ) ) {
    die( "Sorry You Don't Have Permission To Access This Page"  );
    exit;
  }
  
/********* Plugin Setting Template ********/

if( isset($_GET['settings-updated']) ) { ?>
<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated"> 
  <p><strong>Settings saved.</strong></p>
  <button class="notice-dismiss" type="button"><span class="screen-reader-text">Dismiss this notice.</span></button>
</div><?php } ?>
<div class='wpaios-plugin'>
  <form method="post" action="options.php" id="wpaios-settings">
    <?php settings_fields( WPAIOS_TEXT_DOMAIN ); ?>
    <table class="form-table">
      <tr>
        <th scope="row"><label for="share_text"><?php _e( 'Icon Header Text',WPAIOS_TEXT_DOMAIN );?></label></th>
        <td>
          <select name="<?php echo WPAIOS_TEXT_DOMAIN;?>[text_enable]" id="text_enable">
            <option value="1" <?php if($wpaios_option['text_enable'] == '1') echo "selected='selected'";?>><?php _e( 'Enabled',WPAIOS_TEXT_DOMAIN ); ?></option>
            <option value="0" <?php if($wpaios_option['text_enable'] == '0') echo "selected='selected'";?>><?php _e( 'Disabled',WPAIOS_TEXT_DOMAIN );?></option>
          </select>
          <input type="text" name="<?php echo WPAIOS_TEXT_DOMAIN;?>[share_text]" id="share_text" placeholder="i.e. Share On" value="<?php echo $wpaios_option['share_text'];?>" <?php if($wpaios_option['text_enable'] == '0') echo 'readonly="readonly"';?>>
        </td>
      </tr>
      <tr>
        <th scope="row"><label><?php _e( 'Select Icons',WPAIOS_TEXT_DOMAIN );?></label></th>
        <td id="social_icons">
          <label><input type="checkbox" name="<?php echo WPAIOS_TEXT_DOMAIN;?>[social_icons][]" value="email" <?php checked( in_array('email', $wpaios_option['social_icons'] ), true); ?> ><?php _e( 'Email',WPAIOS_TEXT_DOMAIN )?></label>
          <label><input type="checkbox" name="<?php echo WPAIOS_TEXT_DOMAIN;?>[social_icons][]" value="facebook" <?php checked( in_array('facebook', $wpaios_option['social_icons'] ), true); ?> ><?php _e( 'Facebook',WPAIOS_TEXT_DOMAIN )?></label>
          <label><input type="checkbox" name="<?php echo WPAIOS_TEXT_DOMAIN;?>[social_icons][]" value="twitter" <?php checked( in_array('twitter', $wpaios_option['social_icons'] ), true); ?> ><?php _e( 'Twitter',WPAIOS_TEXT_DOMAIN )?></label>
          <label><input type="checkbox" name="<?php echo WPAIOS_TEXT_DOMAIN;?>[social_icons][]" value="googleplus" <?php checked( in_array('googleplus', $wpaios_option['social_icons'] ), true); ?> ><?php _e( 'Google Plus',WPAIOS_TEXT_DOMAIN )?></label>
          <label><input type="checkbox" name="<?php echo WPAIOS_TEXT_DOMAIN;?>[social_icons][]" value="reddit" <?php checked( in_array('reddit', $wpaios_option['social_icons'] ), true); ?> ><?php _e( 'Reddit',WPAIOS_TEXT_DOMAIN )?></label>
          <label><input type="checkbox" name="<?php echo WPAIOS_TEXT_DOMAIN;?>[social_icons][]" value="pinterest" <?php checked( in_array('pinterest', $wpaios_option['social_icons'] ), true); ?> ><?php _e( 'Pinterest',WPAIOS_TEXT_DOMAIN )?></label>
          <label><input type="checkbox" name="<?php echo WPAIOS_TEXT_DOMAIN;?>[social_icons][]" value="linkedin" <?php checked( in_array('linkedin', $wpaios_option['social_icons'] ), true); ?> ><?php _e( 'LinkedIn',WPAIOS_TEXT_DOMAIN )?></label>
          <label><input type="checkbox" name="<?php echo WPAIOS_TEXT_DOMAIN;?>[social_icons][]" value="whatsapp" <?php checked( in_array('whatsapp', $wpaios_option['social_icons'] ), true); ?> ><?php _e( 'Whatsapp (Only show on mobile)',WPAIOS_TEXT_DOMAIN )?></label>
        </td>
      </tr>
      <tr>
        <th scope="row"><?php _e( 'Icon Hover Animation', WPAIOS_TEXT_DOMAIN );?></th>
        <td id="icon-switch">
        <div style="display: inline-block;">
          <div class="wpaios-switch">
            <input type="checkbox" name="<?php echo WPAIOS_TEXT_DOMAIN;?>[icon_hover_animation]" <?php if( $wpaios_option['icon_hover_animation'] == '1' ) echo 'checked="checked"';?> value="1" class="wpaios-toggle wpaios-toggle-round" id="icon_hover_animation">
            <label for="icon_hover_animation" id="switch-button"></label>
          </div>
          <div style="float: right; margin-left:20px;">
            <select name="<?php echo WPAIOS_TEXT_DOMAIN;?>[icon_animation]" <?php if( $wpaios_option['icon_hover_animation'] != '1' ) echo 'disabled';?> id="icon_animation">
              <option value="icon-zoomin" <?php if( $wpaios_option['icon_animation'] == 'icon-zoomin' ) echo 'selected="selected"';?>><?php _e( 'ZoomIn Effect', WPAIOS_TEXT_DOMAIN );?></option>
              <option value="icon-rotate" <?php if( $wpaios_option['icon_animation'] == 'icon-rotate' ) echo 'selected="selected"';?>><?php _e( 'Rotate Effect', WPAIOS_TEXT_DOMAIN );?></option>
              <option value="icon-flip" <?php if( $wpaios_option['icon_animation'] == 'icon-flip' ) echo 'selected="selected"';?>><?php _e( 'Flip Effect', WPAIOS_TEXT_DOMAIN );?></option>
          </select>
          </div>
          </div>
        </td>
      </tr>
      <tr>
        <th scope="row"><label><?php _e( 'Select Social Icon',WPAIOS_TEXT_DOMAIN );?></label></th>
        <td>
        <select name="<?php echo WPAIOS_TEXT_DOMAIN;?>[icon_type]" id="wpaios-icon-type">
          <option value="circle" <?php if($wpaios_option['icon_type'] == 'circle') echo "selected='selected'";?>><?php _e( 'Circle', WPAIOS_TEXT_DOMAIN ); ?></option>
          <option value="square" <?php if($wpaios_option['icon_type'] == 'square') echo "selected='selected'";?>><?php _e( 'Square', WPAIOS_TEXT_DOMAIN ); ?></option>
          </select>
        </td>
      </tr>
      <tr>
        <th scope="row"><label><?php _e( 'Social Icon Size',WPAIOS_TEXT_DOMAIN );?></label></th>
        <td>
          <select name="<?php echo WPAIOS_TEXT_DOMAIN;?>[icon_size]" id="wpaios-icon-size">
            <option value="small" <?php if($wpaios_option['icon_size'] == 'small') echo "selected='selected'";?>><?php _e( 'Small', WPAIOS_TEXT_DOMAIN ); ?></option>
            <option value="medium" <?php if($wpaios_option['icon_size'] == 'medium') echo "selected='selected'";?>><?php _e( 'Medium', WPAIOS_TEXT_DOMAIN ); ?></option>
          </select>
        </td>
      </tr>
      <tr>
        <th><?php echo _e( 'Icon order',WPAIOS_TEXT_DOMAIN )?></th>
        <td>
          <div class="wpaios-change-icon-order"><?php
            if( $wpaios_option['icon_size'] == 'small' ) {
              $wpaios_icon_size = 'wpaios-small';
            }
            else {
              $wpaios_icon_size = 'wpaios-medium';
            }

            if( $wpaios_option['icon_type'] == 'circle' ) {
              $wpaios_icon_type = 'wpaios-circle';
            }
            else {
              $wpaios_icon_type = 'wpaios-square';
            }

            $wpaios_icon_order = get_option( WPAIOS_TEXT_DOMAIN.'-icon-order' ); 
            if( empty( $wpaios_icon_order ) ) $wpaios_icon_order = array('wpaios-email','wpaios-facebook','wpaios-twitter','wpaios-google','wpaios-reddit','wpaios-pinterest','wpaios-linkedin','wpaios-whatsapp');
            foreach ($wpaios_icon_order as $wpaios_value) {
              switch ($wpaios_value) {
                case 'wpaios-email':
                  echo '<div class="wpaios_io wpaios-email" ><div id="wpaios-email"><a href="javascript:;" class="' . $wpaios_icon_size . ' ' . $wpaios_icon_type . ' icon-animation" style="background-color:' . $wpaios_option['email_color'] . ';"><i class="fa fa-envelope"></i></a></div><div><input type="text" name="' . WPAIOS_TEXT_DOMAIN . '[email_color]" class=" wpaios-color-picker " value="' . $wpaios_option['email_color'] . '"></div></div>';
                  break;

                case 'wpaios-facebook':
                  echo '<div class="wpaios_io wpaios-facebook" ><div id="wpaios-facebook"><a href="javascript:;" class="' . $wpaios_icon_size . ' ' . $wpaios_icon_type . ' icon-animation" style="background-color:' . $wpaios_option['facebook_color'] . ';"><i class="fa fa-facebook"></i></a></div><div><input type="text" name="' . WPAIOS_TEXT_DOMAIN . '[facebook_color]" class=" wpaios-color-picker " value="' . $wpaios_option['facebook_color'] . '"></div></div>';
                  break;
                
                case 'wpaios-twitter':
                  echo '<div class="wpaios_io wpaios-twitter"><div id="wpaios-twitter"><a href="javascript:;" class="' . $wpaios_icon_size . ' ' . $wpaios_icon_type . ' icon-animation" style="background-color:' . $wpaios_option['twitter_color'] . ';"><i class="fa fa-twitter"></i></a></div><div><input type="text" name="' . WPAIOS_TEXT_DOMAIN . '[twitter_color]" class=" wpaios-color-picker " value="' . $wpaios_option['twitter_color'] . '"></div></div>';
                  break;

                case 'wpaios-google':
                  echo '<div class="wpaios_io wpaios-google"><div id="wpaios-google"><a href="javascript:;" class="' . $wpaios_icon_size . ' ' . $wpaios_icon_type . ' icon-animation" style="background-color:' . $wpaios_option['google_color'] . ';"><i class="fa fa-google-plus"></i></a></div><div><input type="text" name="' . WPAIOS_TEXT_DOMAIN . '[google_color]" class=" wpaios-color-picker " value="' . $wpaios_option['google_color'] . '"></div></div>';
                  break;

                case 'wpaios-reddit':
                  echo '<div class="wpaios_io wpaios-reddit"><div id="wpaios-reddit"><a href="javascript:;" class="' . $wpaios_icon_size . ' ' . $wpaios_icon_type . ' icon-animation" style="background-color:' . $wpaios_option['reddit_color'] . ';"><i class="fa fa-reddit-alien"></i></a></div><div><input type="text" name="' . WPAIOS_TEXT_DOMAIN . '[reddit_color]" class=" wpaios-color-picker " value="' . $wpaios_option['reddit_color'] . '"></div></div>';
                  break;

                case 'wpaios-pinterest':
                  echo '<div class="wpaios_io wpaios-pinterest"><div id="wpaios-pinterest"><a href="javascript:;" class="' . $wpaios_icon_size . ' ' . $wpaios_icon_type . ' icon-animation" style="background-color:' . $wpaios_option['pinterest_color'] . ';"><i class="fa fa-pinterest"></i></a></div><div><input type="text" name="' . WPAIOS_TEXT_DOMAIN . '[pinterest_color]" class=" wpaios-color-picker " value="' . $wpaios_option['pinterest_color'] . '"></div></div>';
                  break;

                case 'wpaios-linkedin':
                  echo '<div class="wpaios_io wpaios-linkedin"><div id="wpaios-linkedin"><a href="javascript:;" class="' . $wpaios_icon_size . ' ' . $wpaios_icon_type . ' icon-animation" style="background-color:' . $wpaios_option['linkedin_color'] . ';"><i class="fa fa-linkedin"></i></a></div><div><input type="text" name="' . WPAIOS_TEXT_DOMAIN . '[linkedin_color]" class=" wpaios-color-picker " value="' . $wpaios_option['linkedin_color'] . '"></div></div>';
                  break;

                  case 'wpaios-whatsapp':
                  echo '<div class="wpaios_io wpaios-whatsapp"><div id="wpaios-whatsapp"><a href="javascript:;" class="' . $wpaios_icon_size . ' ' . $wpaios_icon_type . ' icon-animation" style="background-color:' . $wpaios_option['whatsapp_color'] . ';"><i class="fa fa-whatsapp"></i></a></div><div><input type="text" name="' . WPAIOS_TEXT_DOMAIN . '[whatsapp_color]" class=" wpaios-color-picker " value="' . $wpaios_option['whatsapp_color'] . '"></div></div>';
                  break;
              }
            }
          ?></div>
        </td>
      </tr>
      <tr><th scope="row"></th><td><small><b><?php _e( 'Change icon order by simply drag & drop.', WPAIOS_TEXT_DOMAIN ); ?></small></b></td></tr>
      <tr>
        <th scope="row"><label><?php _e( 'Where You Want To Show',WPAIOS_TEXT_DOMAIN );?></label></th>
        <td>
          <select name="<?php echo WPAIOS_TEXT_DOMAIN;?>[icons_position]">
            <option value='before-content' <?php if($wpaios_option['icons_position'] == 'before-content') echo "selected='selected'";?>><?php _e( 'Before Content', WPAIOS_TEXT_DOMAIN ); ?></option>
            <option value='after-content' <?php if($wpaios_option['icons_position'] == 'after-content') echo "selected='selected'";?>><?php _e( 'After Content', WPAIOS_TEXT_DOMAIN ); ?></option>
            <option value='floating-left' <?php if($wpaios_option['icons_position'] == 'floating-left') echo "selected='selected'";?>><?php _e( 'Floating On Left Side', WPAIOS_TEXT_DOMAIN ); ?></option>
            <option value='floating-right' <?php if($wpaios_option['icons_position'] == 'floating-right') echo "selected='selected'";?>><?php _e( 'Floating On Right Side', WPAIOS_TEXT_DOMAIN ); ?></option>
          </select>
          <br/><br/>
          <small><?php _e( 'You Can Also Use', WPAIOS_TEXT_DOMAIN ); ?> <code>[wpaios]</code> ShortCode.</small>
        </td>
      </tr>
      <tr>
        <th scope="row"><label><?php _e( 'Which You Want To Show',WPAIOS_TEXT_DOMAIN );?></label></th>
        <td>
          <ul id="icon-in-show"><?php 
            foreach ($post_types as $post_key_id => $post_value) {?>
              <li><label><input type="checkbox" name="<?php echo WPAIOS_TEXT_DOMAIN;?>[icons_posts][]" value="<?php echo $post_key_id; ?>" <?php checked( in_array($post_key_id, $wpaios_option['icons_posts']), true ); ?>><?php printf('%s', $post_value->labels->name) ?></label></br>
              <li><?php 
            } ?>
          </ul>
        </td>
      </tr>
    </table>
    <?php submit_button(); ?>
  </form>
</div>
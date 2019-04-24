<?php 
/**
* Restricting user to access this file directly (Security Purpose).
**/
if( !defined( 'ABSPATH' ) ) {
  die( "You Don't Have Permission To Access This Page" );
  exit;
}
?>
<div>
  <div style="width: 550px;margin: 0 auto;">
  <a href="http://www.addwebsolution.com" style="outline: hidden;" target="_blank"><img src="<?php echo WPAIOS_PLUGIN_URL.'assets/images/addweb-logo.png';?>" alt="AddwebSolution" height=60px ></a>
  </div>
  <div class="wpaios-advertise">
    <div class="wpaios-ad-heading">Visit Our Other Plugins:</div>
    <div class="wpaios-ad-content"><?php
      foreach( $arrAddwebPlugins as $slug => $name ) {?>
        <div class="wpaios-ad-detail">
          <a href="https://wordpress.org/plugins/<?php echo $slug;?>" target="_blank"><img src="<?php echo WPAIOS_PLUGIN_URL.'assets/images/'.$slug;?>.svg"></a>
          <a href="https://wordpress.org/plugins/<?php echo $slug;?>" class="wpaios-ad-link" target="_blank"><?php echo $name;?></a>
      </div><?php
    } ?></div>
  </div>
</div>
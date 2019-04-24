jQuery( document ).ready( function( $ ){
 $( '#text_enable' ).change( function() {
  var text_enable = $( 'select[id=text_enable]' ).find( ':selected' ).val();
  if( text_enable == '0' ) {
    $('#share_text').attr('readonly', 'readonly');
  }
  else {
    $('#share_text').removeAttr('readonly');
  }
 });

$('.wpaios-email div .wpaios-color-picker').wpColorPicker( {
  change:function(event,ui) {
    var icon_Color = ui.color.toString();
    var email_color = 'background-color:'+icon_Color+' !important;';
    $('#wpaios-email a').attr( 'style', email_color );
  }
 } );
 $('.wpaios-facebook div .wpaios-color-picker').wpColorPicker( {
  change:function(event,ui) {
    var icon_Color = ui.color.toString();
    var facebook_color = 'background-color:'+icon_Color+' !important;';
    $('#wpaios-facebook a').attr( 'style', facebook_color );
  }
 } );
 $('.wpaios-twitter div .wpaios-color-picker').wpColorPicker( {
  change:function(event,ui) {
    var icon_Color = ui.color.toString();
    var twitter_color = 'background-color:'+icon_Color+' !important;';
    $('#wpaios-twitter a').attr( 'style', twitter_color );
  }
 } );
 $('.wpaios-google div .wpaios-color-picker').wpColorPicker( {
  change:function(event,ui) {
    var icon_Color = ui.color.toString();
    var google_color = 'background-color:'+icon_Color+' !important;';
    $('#wpaios-google a').attr( 'style', google_color );
  }
 } );
 $('.wpaios-reddit div .wpaios-color-picker').wpColorPicker( {
  change:function(event,ui) {
    var icon_Color = ui.color.toString();
    var reddit_color = 'background-color:'+icon_Color+' !important;';
    $('#wpaios-reddit a').attr( 'style', reddit_color );
  }
 } );
 $('.wpaios-pinterest div .wpaios-color-picker').wpColorPicker( {
  change:function(event,ui) {
    var icon_Color = ui.color.toString();
    var pinterest_color = 'background-color:'+icon_Color+' !important;';
    $('#wpaios-pinterest a').attr( 'style', pinterest_color );
  }
 } );
 $('.wpaios-linkedin div .wpaios-color-picker').wpColorPicker( {
  change:function(event,ui) {
    var icon_Color = ui.color.toString();
    var linkedin_color = 'background-color:'+icon_Color+' !important;';
    $('#wpaios-linkedin a').attr( 'style', linkedin_color );
  }
 } );
 $('.wpaios-whatsapp div .wpaios-color-picker').wpColorPicker( {
  change:function(event,ui) {
    var icon_Color = ui.color.toString();
    var whatsapp_color = 'background-color:'+icon_Color+' !important;';
    $('#wpaios-whatsapp a').attr( 'style', whatsapp_color );
  }
 } );

 $('#wpaios-icon-type').change(function() {
   var icon_Type = $('#wpaios-icon-type').val();
   if( icon_Type == 'circle' ) {
    $('div.wpaios_io > div > a').removeClass('wpaios-square');
    $('div.wpaios_io > div > a').addClass('wpaios-circle');
   }
   else {
    $('div.wpaios_io > div > a').removeClass('wpaios-circle');
    $('div.wpaios_io > div > a').addClass('wpaios-square');
   }
 });

 $('#wpaios-icon-size').change(function() {
   var icon_Type = $('#wpaios-icon-size').val();
   if( icon_Type == 'small' ) {
    $('div.wpaios_io > div > a').removeClass('wpaios-medium');
    $('div.wpaios_io > div > a').addClass('wpaios-small');
   }
   else {
    $('div.wpaios_io > div > a').removeClass('wpaios-small');
    $('div.wpaios_io > div > a').addClass('wpaios-medium');
   }
 });
 $( 'label#switch-button' ).click( function() {
    if( $( '#icon_hover_animation' ).is(':checked') ) {
      $( '#icon_animation' ).attr('disabled', 'disabled');
    }
    else {
      
      $( '#icon_animation' ).removeAttr( 'disabled' );
    }
 });
 $( '#icon_animation' ).change( function() {
  var icon_animation = $( 'select[id=icon_animation]' ).find( ':selected' ).val();
  if( icon_animation == 'icon-zoomin' ) {
    $( 'div.wpaios_io div a.icon-animation' ).removeClass( 'icon-rotate' );
    $( 'div.wpaios_io div a.icon-animation' ).removeClass( 'icon-flip' );
    $( 'div.wpaios_io div a.icon-animation' ).addClass( 'icon-zoomin' );
  }
  if( icon_animation == 'icon-rotate' ) {
    $( 'div.wpaios_io div a.icon-animation' ).removeClass( 'icon-zoomin' );
    $( 'div.wpaios_io div a.icon-animation' ).removeClass( 'icon-flip' );
    $( 'div.wpaios_io div a.icon-animation' ).addClass( 'icon-rotate' );
  }
  if( icon_animation == 'icon-flip' ) {
    $( 'div.wpaios_io div a.icon-animation' ).removeClass( 'icon-zoomin' );
    $( 'div.wpaios_io div a.icon-animation' ).removeClass( 'icon-rotate' );
    $( 'div.wpaios_io div a.icon-animation' ).addClass( 'icon-flip' );
  }
 });

 //Validation for at least one will be selected
  $('#wpaios-settings').submit( function(e){
    var icon_selected = [];
    $('td#social_icons input[type=checkbox]').each(function() {
      if ($(this).is(":checked")) {
        icon_selected.push($(this).attr('id'));
      }
    });
    if (icon_selected.length === 0) {
      e.preventDefault();
      alert('Please Select At Least One Icon');
    }
    
    var show_selected = [];
    $('ul#icon-in-show input[type=checkbox]').each(function() {
      if ($(this).is(":checked")) {
        show_selected.push($(this).attr('id'));
      }
    });
    if(show_selected.length === 0) {
      e.preventDefault();
      alert('Please Select At Least One For In Which You Want To Show'); 
    }
  });
});
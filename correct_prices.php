<?php

/*
Plugin Name: Correct prices
Plugin URI: https://lweb.pl.ua/wordpress-plugin-correct_prices
Description: Number(on page) * coefficients(plugin setting) = result on page
Version: 1.0
Author: Yuriy Lukashov
Author URI: https://lweb.pl.ua
License: GPLv2
*/

/*  Copyright 2016 Yuriy Lukashov  (email: lykich2004@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/



/*
*  @param type current_rate = 10 
*   value for default for activate plugin
*/

function correct_prices_install() {
		
	$correct_prices_plugin_options = array(
		      'current_rate' => '10'
    		);
		
    update_option( 'correct_prices_plugin_options', $correct_prices_plugin_options ); 
                     
}

/*
 * Add js file for plugin
 * 
*/ 

function correct_prices_scripts_method() {
	     $correct_prices_plugin_options = get_option('correct_prices_plugin_options')['current_rate'];
	 ?>
	
	    <script type="text/javascript">
			var corrrect_prices_current_rate = '<?php echo $correct_prices_plugin_options; ?>';

		</script>
		
	<?php
	/*
	 * Include own version of jquery
	 */ 
	wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'my_script', plugins_url('js/correct_prices_script.js', __FILE__) );            
}    
 

/*
 * Add link Setting after install plugin
 *
*/

function add_action_links ( $links ) {
     $mylinks = array(
                '<a href="' . admin_url( 'options-general.php?page=correct_prices' ) . '">Settings</a>',
              );
     return array_merge( $links, $mylinks );
}

/*
 * Add setting page for plugin
 * 
*/

function correct_prices_menu() {
	
    add_options_page('Correct prices page','Correct Prisec',8,'correct_prices','correct_prices_page');	
	
}

/*
 *  Add setting page and form for plugin
 *  Update dafault setting value
 * 
*/ 
function correct_prices_page() {
	
      
    echo"<h1>Setting for correct prices plugin:</h1>" ; ?>
    <?php
        /*
        *   If user have manage options make update data setting
        */ 
   
       if( current_user_can('manage_options') ){
			
			/*
			 * If we have POST and check nonce field save data  
			 * 
			 */
			 
			if ( !empty($_POST)  && check_admin_referer( 'correct_prices_update_action', 'correct_prices_update_field' ) ) {
			
			   if( is_numeric($_POST['current_rate']) ) {
			        
			        $correct_prices_plugin_options_update = array(
		                                                       'current_rate' => $_POST['current_rate'] 
    		                                                  );
			        update_option( 'correct_prices_plugin_options', $correct_prices_plugin_options_update );
			    }
		    }
		    
        }	
   
    
     ?>
    <hr>
    <div>
      This coefficient will be the number what you want
    </div>
    
    <form name="correct_prices_form_sitings"  method="post" action="<?php echo $_SERVER['PHP_SELF']."?page=correct_prices"; ?>">
    
          <?php wp_nonce_field( 'correct_prices_update_action','correct_prices_update_field' ); ?>  
		  <p><h2>Current rate</h2></p>
          <p></p><input name="current_rate" type="text" value="<?php echo get_option('correct_prices_plugin_options')['current_rate']; ?>"></p>
          <p> <input type="submit" value="Submit"></p>

    </form>
    
	
<?php
}	

/*
 *  To send css class "correcr_price_shortcode" to page
 *  class "correcr_price_shortcode" will be marker for
 *  js logic
 */ 


function wp_correct_prices_shortcode(){
        
        ob_start(); ?>
        
       <div class="correcr_price_shortcode" ></div>
        
       <?php
       
        $output_string = ob_get_contents();
        ob_end_clean();
        return $output_string;
        
}

/*
 * This functions add TinyMCE Buttons for this plugin
 *  
*/ 

function correct_prices_tinymce_button() {
     if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
          add_filter( 'mce_buttons', 'correct_prices_register_tinymce_button' );
          add_filter( 'mce_external_plugins', 'correct_prices_add_tinymce_button' );
     }
}

function correct_prices_register_tinymce_button( $buttons ) {
     array_push( $buttons, "button_correct_prices" );
     return $buttons;
}

function correct_prices_add_tinymce_button( $plugin_array ) {
     $plugin_array['correct_prices_button_script'] = plugins_url( '/js/correct_prices_buttons.js', __FILE__ ) ;
     return $plugin_array;
}



register_activation_hook( __FILE__, 'correct_prices_install' );

add_action( 'wp_enqueue_scripts', 'correct_prices_scripts_method' );

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'add_action_links' );

add_action( 'admin_menu','correct_prices_menu' );

/* TinyMCE Buttons */
add_action( 'admin_init', 'correct_prices_tinymce_button' );


add_shortcode('correct_prices_short_code', 'wp_correct_prices_shortcode');


?>

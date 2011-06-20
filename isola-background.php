<?php  
    /* 
    Plugin Name: Isola Hero Carousel
    Plugin URI: http://www.isola-group.com/ 
    Description: Controls Hero Images, Title and Description on the Isola Home Page
    Author: Connor McSheffrey 
    Version: 1.0 
    Author URI: http://www.terralever.com
    */  
		
		global $isola_background_version;
			$isola_background_version = "1.0";

		function isola_background_install() {
				   global $isola_background_version;
					 global $wpdb;
					
				   $table_name = $wpdb->prefix . "custom_carousel";
		
				   $sql = "CREATE TABLE " . $table_name . " (
					  id int(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
						title varchar(255) NULL,
						description text NULL,
						image_url varchar(400) NULL,
						more_link varchar(400) NULL
				    );";
		
				   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
				   dbDelta($sql);
		
				   add_option("isola_background_version", $isola_background_version);
				}
				
				register_activation_hook(__FILE__,'isola_background_install');
		
		function isola_admin() {  
		    include('isola-background-admin.php');  
		}
		
		function isola_background_actions() {  
      add_options_page("Isola Background Carousel", "Isola Background Carousel", 1, "Isola_Background_Carousel", "isola_admin");
    }  
      
    add_action('admin_menu', 'isola_background_actions');
				
		function my_admin_scripts() {
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_register_script('my-upload', WP_PLUGIN_URL.'/isola-background/admin.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_script('my-upload');
		}
    
		function my_admin_styles() {
		wp_enqueue_style('thickbox');
		}
    
		add_action('admin_print_scripts', 'my_admin_scripts');
		add_action('admin_print_styles', 'my_admin_styles');
				

?>
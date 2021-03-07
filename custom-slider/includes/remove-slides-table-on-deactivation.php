<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 register_deactivation_hook( __FILE__, 'remove_slides_table' );
if(!function_exists('remove_slides_table')){
	function remove_slides_table() {
 	global $wpdb;
     $drop_table_name ='Slider_images';
     $delete_table = "DROP TABLE IF EXISTS $drop_table_name";
    // echo  $delete_table; die;
     $wpdb->query($delete_table);
     delete_option("my_plugin_db_version");
}

}
 
 ?>
<?php 
if(!defined('ABSPATH')) exit;

		  global $wpdb;
    	$table_name ='slider_images';
   		$charset_collate = $wpdb->get_charset_collate();
   		$sql ="CREATE TABLE IF NOT EXISTS $table_name(
     		id int(11) NOT NULL AUTO_INCREMENT,
     		slider_image varchar(200) NOT NULL,
     		slider_order int(10) NOT NULL,
        created_date datetime NOT NULL,
    		PRIMARY KEY  (id) ) $charset_collate;";
   			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
   			dbDelta( $sql );

?>
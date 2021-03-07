<?php 
if(!defined('ABSPATH')) exit;

		  global $wpdb;
    	$table_name ='slider_settings';
   		$charset_collate = $wpdb->get_charset_collate();
   		$sql ="CREATE TABLE IF NOT EXISTS $table_name(
     		id int(11) NOT NULL AUTO_INCREMENT,
     		slider_title varchar(200) NOT NULL,
     		slider_description varchar(255) NOT NULL,
            slider_time int(10) NOT NULL,
            created_date datetime NOT NULL,
    		PRIMARY KEY  (id) ) $charset_collate;";
   			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
   			dbDelta( $sql );

      global $wpdb;
       $table_name = 'slider_settings';
       $id = '1';
       $slider_title = 'ADMIN SLIDER';
       $slider_description = 'Description';
       $slider_time = '2000';
       $created_date ='0';
       
       
     $insert_setting =  $wpdb->insert($table_name, array(

          'id' => $id,
          'slider_title' => $slider_title,
          'slider_description'=> $slider_description,
          'slider_time' => $slider_time,
          'created_date'=> $created_date
          

 ));


?>
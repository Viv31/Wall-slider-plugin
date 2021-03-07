<?php
/**
* Plugin Name:Custom Slider
* Description: A plugin for making slider
* version:1.0
* Author: Vaibhav Gangrade 
* Author URI:
*/

if (!defined('ABSPATH')) exit;
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); //calling main plugin file
include_once('includes/slider-shortcode.php');//calling shortcode file
include_once('includes/slider-admin-options.php'); //calling admin options file and adding in menu
include_once('includes/create-db-table-on-activation.php');//create setting table on plugin activation
include_once('includes/create-slides-table-on-activation.php'); //creating slider image table on plugin activation
//Removing settings table on deactivation
register_deactivation_hook( __FILE__, 'remove_database_table' );
include_once('includes/remove-db-table-on-deactivation.php');
//Removing slides table on deactivation
register_deactivation_hook( __FILE__, 'remove_slides_table' );
include_once('includes/remove-slides-table-on-deactivation.php');




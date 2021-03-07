<?php 
function Slider_Admin_Options() {
    add_menu_page(
        __( 'Custom Menu Title', 'textdomain' ),
        'Slider Settings',
        'manage_options',
        'custom-slider/includes/slider-settings.php',
        '',
        plugins_url( 'login-audit/images/icon.png' ),
        6
    );
    

}
add_action( 'admin_menu', 'Slider_Admin_Options' );

?>
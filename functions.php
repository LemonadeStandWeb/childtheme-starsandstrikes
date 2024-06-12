<?php

// Custom Post Types
include('inc/ls-custom-post-types/ls-cpt-attractions.php');
include('inc/ls-custom-post-types/ls-cpt-locations.php');
include('inc/ls-custom-post-types/ls-cpt-promotions.php');
include('inc/ls-custom-post-types/ls-cpt-specials.php');

// Custom Shortcodes
include('inc/ls-shortcodes/ls-shortcode-attractions-sticky.php');
include('inc/ls-shortcodes/ls-shortcode-attractions.php');
include('inc/ls-shortcodes/ls-shortcode-locations.php');
include('inc/ls-shortcodes/ls-shortcode-promotions.php');
include('inc/ls-shortcodes/ls-shortcode-specials.php');
include('inc/ls-shortcodes/ls-shortcode-activity-form.php');

// Disable WordPress Administration email verification prompt 
add_filter( 'admin_email_check_interval', '__return_false' );

//Remove Gravity Forms Label "* Indicates Required"
add_filter( 'gform_required_legend', '__return_empty_string' );

//Add Bootstraps
add_action( 'wp_enqueue_scripts', function(){

    wp_register_style( 'bootstrap_utils', 'https://cdn.jsdelivr.net/npm/bootstrap-utilities@4.1.3/bootstrap-utilities.min.css' );
    wp_enqueue_style( 'bootstrap_utils' );

    // wp_register_script( 'popperjs', 'https://unpkg.com/@popperjs/core@2' );
    wp_enqueue_script( 'popperjs', 'https://unpkg.com/@popperjs/core@2', '', '', FALSE );

    // wp_register_script( 'tippyjs', 'https://unpkg.com/tippy.js@6' );
    wp_enqueue_script( 'tippyjs', 'https://unpkg.com/tippy.js@6', '', '', FALSE );

}, 100 );

// ACF Google Maps API Key
function my_acf_init() {
    $api_key = get_field("ls_google_api_key", "option");
    acf_update_setting('google_api_key', $api_key);
}
add_action('acf/init', 'my_acf_init');

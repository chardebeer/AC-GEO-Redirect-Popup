<?php 

namespace Ac_Geo_Redirect;

includes ( plugin_dir_path( __FILE__ ) . '../advanced-custom-fields-pro' );

// Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', get_stylesheet_directory() . '/includes/acf/' );
define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/includes/acf/' );

// Include the ACF plugin.
include_once( MY_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

// (Optional) Hide the ACF admin menu item.
add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
function my_acf_settings_show_admin( $show_admin ) {
    return false;
}
    add_filter( 'acf/settings/path', array( $this, 'update_acf_settings_path' ) );
    add_filter( 'acf/settings/dir', array( $this, 'update_acf_settings_dir' ) );

    public function update_acf_settings_path( $path ) {
        $path = plugin_dir_path( __FILE__ ) . 'vendor/advanced-custom-fields/';
        return $path;
    }
    
    public function update_acf_settings_dir( $dir ) {
        $dir = plugin_dir_url( __FILE__ ) . 'vendor/advanced-custom-fields/';
        return $dir;
    }
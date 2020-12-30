<?php

namespace Ac_Geo_Redirect;
class SettingsPage {

    public function init() {
    	// Hook into the admin menu
    	add_action( 'network_admin_menu', array( $this, 'create_plugin_settings_page' ) );

		// Add Settings and Fields
    	add_action( 'admin_init', array( $this, 'setup_sections' ) );
		add_action( 'admin_init', array( $this, 'setup_fields' ) );
	}


    public function create_plugin_settings_page() {
    	// Add the menu item and page
    	$page_title = 'GEO Redirect Popup Settings Page';
    	$menu_title = 'GEO Redirect Popup Settings';
    	$capability = 'manage_options';
    	$slug = 'geo_redirect_popup_settings';
    	$callback = array( $this, 'plugin_settings_page_content' );
    	$icon = 'dashicons-location-alt';
    	$position = 100;

    	add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position );
    }

    public function plugin_settings_page_content() {?>
    	<div class="wrap">
    		<h2>GEO Redirect Popup Settings</h2><?php
            if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] ){
                  $this->admin_notice();
            } ?>
    		<form method="POST" action="options.php">
                <?php
                    settings_fields( 'ac_geo_redirect_fields' );
                    do_settings_sections( 'ac_geo_redirect_fields' );
                    submit_button();
                ?>
    		</form>
    	</div> <?php
	}


    public function admin_notice() { ?>
        <div class="notice notice-success is-dismissible">
            <p>Your settings have been updated!</p>
        </div><?php
	}


}

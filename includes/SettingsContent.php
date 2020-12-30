<?php

namespace Ac_Geo_Redirect;


class SettingsContent{

public function init(){
    add_action( 'network_admin_menu', array( $this, 'create_plugin_settings_page' ) );
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

    add_submenu_page( 'geo_redirect_popup_settings', 'GEO Redirect Debug Information', 'Debug Information', 'manage_options', 'debug_page' );
}
	public function get_site_titles(){


}

public function setup_sections() {


	$sites = get_sites('ids');
	$site_titles = array();

	foreach( $sites as $site => $site_title){

		switch_to_blog($sites[$site]);
		$site_title[$site] = get_bloginfo('name');
		$site_titles = array_push($site_title[$site]);


		}

		return (array($site_titles => $site));

	foreach( $sites as $site => $fields[] ){

		add_settings_section( 'geo_popup_text_fields_section_' . $site , 'Popup Text Configuration for ' . "$site_title", array( $this, 'section_callback' ), 'ac_geo_redirect_fields' );


	}

}

public function section_callback( $arguments ) {
	foreach($sites as  $site[]){
		echo 'Here you can configure the text displayed on the popup as well as the translations for the' . $site_title . ' site.';
	}
	}

public function setup_fields() {
$sites = get_sites(array());

	foreach($sites as $site => $fields )

	{
		$fields = array(
		array(
			'uid' => 'header_field_' . $site ,
			'label' => 'Popup Header Field',
			'section' => 'geo_popup_text_fields' . $site,
			'type' => 'text',
			'placeholder' => "Hi! It seems like you're in",
			'helper' => 'Add text for the header text in the popup',
			'supplimental' => 'GEO IP LOCALE HEADER',
			'default' => "Hi! It seems like you're in ",
		),
		array(
			'uid' => 'takeMeTo_field',
			'label' => 'Popup Redirect (Take Me To) Field',
			'section' => 'geo_popup_text_fields' . $site,
			'type' => 'text',
			'placeholder' => 'Go to',
			'helper' => 'Redirect text on the button',
			'supplimental' => 'Ensure it redirects to the correct site in MLP',
			'default' => 'Go to',
		),
		array(
			'uid' => 'takeMeTo_field',
			'label' => 'Popup Redirect (Take Me To) Field',
			'section' => 'geo_popup_text_fields' . $site,
			'type' => 'text',
			'placeholder' => 'Stay at',
			'helper' => 'Remain on current site on the button',
			'supplimental' => 'Ensure it redirects to the correct site in MLP',
			'default' => 'Stay at',
		),);
		foreach( $fields as $field ){

			add_settings_field( $field['uid'], $field['label'], array( $this, 'field_callback' ), 'ac_geo_redirect_fields', $field['section'], $field );
			register_setting( 'ac_geo_redirect_fields', $field['uid'] );
			}
		}
	}



public function field_callback( $arguments ) {

	$value = get_option( $arguments['uid'] );

	if( ! $value ) {
		$value = $arguments['default'];
	}

	switch( $arguments['type'] ){
		case 'textarea':
			printf( '<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>', $arguments['uid'], $arguments['placeholder'], $value );
			break;
	}

	if( $helper = $arguments['helper'] ){
		printf( '<span class="helper"> %s</span>', $helper );
	}

	if( $supplimental = $arguments['supplimental'] ){
		printf( '<p class="description">%s</p>', $supplimental );
	}

}


public function admin_notice() { ?>
	<div class="notice notice-success is-dismissible">
		<p>Your settings have been updated!</p>
	</div><?php

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
}

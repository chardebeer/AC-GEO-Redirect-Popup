<?php 

namespace Ac_Geo_Redirect;

includes ( plugin_dir_path( __FILE__ ) . '../advanced-custom-fields-pro' );
class SettingsPage {

	function geo_redirect_settings_page()
	{
		add_menu_page( 
			'AC GEO Redirect Popup', 
			//Page TItle
	
			'GEO Redirect Popup Settings', 
			//Menu Title
	
			'manage_options', 
			//Capability
	
			'geo_redirect_settings', 
			//Menu Slug
	
			'geo_redirect_settings_page_markup',
			 //function
	
			'dash-icon-map', 
			//Icon URL
			100
		);
	
	}

	add_action('admin_menu', 'geo-redirect-settings_settings_page');


function geo_redirect_settings_settings_page_markup()
{
    //Double check user capabilities
    if(!current_user_can('manage_options')){
        return;

	}
}

	?>
	<div class="wrap">
	<h1><?php esc_html_e( get_admin_page_title()); ?></h1>
	<h3><?php esc_html_e('Here you can change the settings of the GEO IP Redirect Plugin '); ?></h3>
	<p> Please view the README here if you need help configuring this plugin</p>
	</div>

	<?php 
    add_submenu_page( 
		'settings.php', 
		$page_title, 
		$menu_title, 
		$capability, 
		$slug, 
		$callback );
}


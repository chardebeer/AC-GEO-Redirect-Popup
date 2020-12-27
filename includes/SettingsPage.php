<?php 

namespace Ac_Geo_Redirect;

includes ( plugin_dir_path( __FILE__ ) . '../advanced-custom-fields-pro' );
class SettingsPage {

	function geo_redirect_settings_page()
{
        // Hook into the admin menu
        add_action( 'admin_menu', array( $this, 'create_plugin_settings_page' ) );
        add_action( 'admin_init', array( $this, 'add_acf_variables' ) );

        add_filter( 'acf/settings/path', array( $this, 'update_acf_settings_path' ) );
        add_filter( 'acf/settings/dir', array( $this, 'update_acf_settings_dir' ) );

        include_once( plugin_dir_path( __FILE__ ) . 'vendor/advanced-custom-fields/acf.php' );

        $this->setup_options();
	}
	
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

    public function update_acf_settings_path( $path ) {
        $path = plugin_dir_path( __FILE__ ) . '/includes';
        return $path;
    }

    public function update_acf_settings_dir( $dir ) {
        $dir = plugin_dir_url( __FILE__ ) . '/includes';
        return $dir;
    }

    public function add_acf_variables() {
        acf_form_head();
    }

    public function setup_options() {

		public function setup_options(){

			if( function_exists('acf_add_local_field_group') ):
	
				acf_add_local_field_group(array(
					'key' => 'group_5fe901bbb901a',
					'title' => 'AC GEO Redirect Popup',
					'fields' => array(
						array(
							'key' => 'field_5fe9022aa7a84',
							'label' => 'Edit Popup Header',
							'name' => 'header',
							'type' => 'textarea',
							'instructions' => 'Enter the text you would like to display on the popup header',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '50',
								'class' => 'ac_geo_redirect_settings_header',
								'id' => 'header',
							),
							'default_value' => 'Hi! It seems like you\'re in',
							'placeholder' => '',
							'maxlength' => '',
							'rows' => '',
							'new_lines' => 'br',
						),
						array(
							'key' => 'field_5fe90390a7a85',
							'label' => 'Redirect Take Me To',
							'name' => 'TakeMeTo',
							'type' => 'textarea',
							'instructions' => 'Enter the text that prompts the use to redirect.',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => 'ac_geo_redirect_settings_takemeto',
								'id' => 'TakeMeTo',
							),
							'default_value' => '',
							'placeholder' => '',
							'maxlength' => '',
							'rows' => '',
							'new_lines' => '',
						),
						array(
							'key' => 'field_5fe9043ca7a86',
							'label' => 'Remain at Text',
							'name' => 'remainOn',
							'type' => 'text',
							'instructions' => 'Enter the text to display to prompt the user to remain on the current site',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => 'ac_geo_redirect_settings_remainon',
								'id' => 'remainon',
							),
							'default_value' => 'Stay at',
							'placeholder' => 'Stay at',
							'prepend' => '',
							'append' => '\'...\' - $current_blog_url',
							'maxlength' => '',
						),
						array(
							'key' => 'field_5fe9050ba7a87',
							'label' => 'Popup Accent Color',
							'name' => 'popupcolor',
							'type' => 'color_picker',
							'instructions' => 'Pick the popup accent colour - the default is set to black',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => 'ac-geo-popup-redirect-link',
								'id' => 'ac-geo-popup-redirect-link',
							),
							'default_value' => '#000000',
						),
					),
					'location' => array(
						array(
							array(
								'param' => 'current_user_role',
								'operator' => '==',
								'value' => 'administrator',
							),
							array(
								'param' => 'current_user_role',
								'operator' => '==',
								'value' => 'super_admin',
							),
						),
					),
					'menu_order' => 0,
					'position' => 'normal',
					'style' => 'default',
					'label_placement' => 'top',
					'instruction_placement' => 'label',
					'hide_on_screen' => '',
					'active' => true,
					'description' => '',
				));
				
				endif;
		}
	
		public function plugin_settings_page_content() {
			do_action('acf/input/admin_head'); // Add ACF admin head hooks
			do_action('acf/input/admin_enqueue_scripts'); // Add ACF scripts
		
			$options = array(
				'id' => 'acf-form',
				'post_id' => 'options',
				'new_post' => false,
				'field_groups' => array( 'acf_awesome-options' ),
				'return' => admin_url('admin.php?page=smashing_fields'),
				'submit_value' => 'Update',
			);
			acf_form( $options );
		}

}
	


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
	</div><br>

	<h3>Style Settings</h3>
	<p>get_field( 'ac-geo-popup-redirect-link', 'option' )




	
	



<?php

namespace Ac_Geo_Redirect;

class SettingsPage {

	/**
	 * Settings_Page constructor.
	 */
	public function init() {

		add_action( 'admin_menu', [ $this, 'add_menu_page' ] );
		add_action( 'admin_menu', array( $this, 'create_plugin_settings_page' ) );
	}

	/**
	 * Add Menu Item for Settings 
	 */

	public function create_plugin_settings_page() {
		$page_title = 'AC GEO Redirect Popup Settings';
		$menu_title = 'GEO Redirect Popup';
		$capability = 'manage_options';
		$slug = 'ac_geo_redirect_popup';
		$callback = array( $this, 'plugin_settings_page_content' );
		$icon = 'dashicons-location-alt';
		$position = 5;
	
		add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position );
	}

	/**
	 * Register the submenu page.
	 */
	public function add_menu_page() {
		add_options_page(
			__( 'Geo IP debug', 'ac-geo-redirect' ),
			__( 'Geo IP debug', 'ac-geo-redirect' ),
			'manage-options',
			'geo-ip-debug.php',
			[
				$this,
				'render_options_page',
			]
		);
	}
public function plugin_settings_page_content(){
	?>
	<div class="wrap">
	<h2>GEO Redirect Popup Customization</h2><?php
	if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] ){
	 $this->admin_notice();
	} ?>
	<form method="POST" action="options.php">
		<?php
			settings_fields( 'geo_redirect_popup_fields' );
			do_settings_sections( 'geo_redirect_popup_fields' );
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

public function setup_sections() {
add_settings_section( 'our_first_section', 'Popup Configuration', array( $this, 'section_callback' ), 'geo_redirect_popup_fields' );
add_settings_section( 'our_second_section', 'Popup Text', array( $this, 'section_callback' ), 'geo_redirect_popup_fields' );
add_settings_section( 'our_third_section', 'Popup Styles', array( $this, 'section_callback' ), 'geo_redirect_popup_fields' );
}

public function section_callback( $arguments ) {
switch( $arguments['id'] ){
	case 'our_first_section':
		echo 'This is the first description here!';
		break;
	case 'our_second_section':
		echo 'This one is number two';
		break;
	case 'our_third_section':
		echo 'Third time is the charm!';
		break;
}
}

public function setup_fields() {
$fields = array(
	array(
		'uid' => 'geo_text_field',
		'label' => 'Sample Text Field',
		'section' => 'our_first_section',
		'type' => 'text',
		'placeholder' => 'Some text',
		'helper' => 'Does this help?',
		'supplimental' => 'I am underneath!',
	),
	array(
		'uid' => 'geo_password_field',
		'label' => 'Sample Password Field',
		'section' => 'our_first_section',
		'type' => 'password',
	),
	array(
		'uid' => 'geo_number_field',
		'label' => 'Sample Number Field',
		'section' => 'our_first_section',
		'type' => 'number',
	),
	array(
		'uid' => 'geo_textarea',
		'label' => 'Sample Text Area',
		'section' => 'our_first_section',
		'type' => 'textarea',
	),
	array(
		'uid' => 'geo_select',
		'label' => 'Sample Select Dropdown',
		'section' => 'our_first_section',
		'type' => 'select',
		'options' => array(
			'option1' => 'Option 1',
			'option2' => 'Option 2',
			'option3' => 'Option 3',
			'option4' => 'Option 4',
			'option5' => 'Option 5',
		),
		'default' => array()
	),
	array(
		'uid' => 'geo_multiselect',
		'label' => 'Sample Multi Select',
		'section' => 'our_first_section',
		'type' => 'multiselect',
		'options' => array(
			'option1' => 'Option 1',
			'option2' => 'Option 2',
			'option3' => 'Option 3',
			'option4' => 'Option 4',
			'option5' => 'Option 5',
		),
		'default' => array()
	),
	array(
		'uid' => 'geo_radio',
		'label' => 'Sample Radio Buttons',
		'section' => 'our_first_section',
		'type' => 'radio',
		'options' => array(
			'option1' => 'Option 1',
			'option2' => 'Option 2',
			'option3' => 'Option 3',
			'option4' => 'Option 4',
			'option5' => 'Option 5',
		),
		'default' => array()
	),
	array(
		'uid' => 'geo_checkboxes',
		'label' => 'Sample Checkboxes',
		'section' => 'our_first_section',
		'type' => 'checkbox',
		'options' => array(
			'option1' => 'Option 1',
			'option2' => 'Option 2',
			'option3' => 'Option 3',
			'option4' => 'Option 4',
			'option5' => 'Option 5',
		),
		'default' => array()
	)
);
foreach( $fields as $field ){

	add_settings_field( $field['uid'], $field['label'], array( $this, 'field_callback' ), 'geo_redirect_popup_fields', $field['section'], $field );
	register_setting( 'geo_redirect_popup_fields', $field['uid'] );
}
}

public function field_callback( $arguments ) {

$value = get_option( $arguments['uid'] );

if( ! $value ) {
	$value = $arguments['default'];
}

switch( $arguments['type'] ){
	case 'text':
	case 'password':
	case 'number':
		printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', $arguments['uid'], $arguments['type'], $arguments['placeholder'], $value );
		break;
	case 'textarea':
		printf( '<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>', $arguments['uid'], $arguments['placeholder'], $value );
		break;
	case 'select':
	case 'multiselect':
		if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
			$attributes = '';
			$options_markup = '';
			foreach( $arguments['options'] as $key => $label ){
				$options_markup .= sprintf( '<option value="%s" %s>%s</option>', $key, selected( $value[ array_search( $key, $value, true ) ], $key, false ), $label );
			}
			if( $arguments['type'] === 'multiselect' ){
				$attributes = ' multiple="multiple" ';
			}
			printf( '<select name="%1$s[]" id="%1$s" %2$s>%3$s</select>', $arguments['uid'], $attributes, $options_markup );
		}
		break;
	case 'radio':
	case 'checkbox':
		if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
			$options_markup = '';
			$iterator = 0;
			foreach( $arguments['options'] as $key => $label ){
				$iterator++;
				$options_markup .= sprintf( '<label for="%1$s_%6$s"><input id="%1$s_%6$s" name="%1$s[]" type="%2$s" value="%3$s" %4$s /> %5$s</label><br/>', $arguments['uid'], $arguments['type'], $key, checked( $value[ array_search( $key, $value, true ) ], $key, false ), $label, $iterator );
			}
			printf( '<fieldset>%s</fieldset>', $options_markup );
		}
		break;
}

if( $helper = $arguments['helper'] ){
	printf( '<span class="helper"> %s</span>', $helper );
}

if( $supplimental = $arguments['supplimental'] ){
	printf( '<p class="description">%s</p>', $supplimental );
}

}

	/**
	 * Render the options page.
	 */
	public function render_options_page() {
		$country_code = ac_geo_redirect_plugin()->get_country_code();
		?>

		<div class="wrap">
			<h1><?php esc_html_e( 'Geo IP debug info', 'ac-geo-redirect' ); ?></h1>

			<h3><?php esc_html_e( 'Country code:', 'ac-geo-redirect' ); ?></h3>
			<p>
				<?php if ( ! $country_code->get_locale() ) : ?>
					<?php esc_html_e( "We couldn't find a country code header set for this site. Please check that the correct headers are being sent via either NGINX or Cloudflare where appropriate.", 'ac-geo-redirect' ); ?>
				<?php else : ?>
					<strong><?php echo esc_html( $country_code->get_locale() ); ?></strong>
				<?php endif; ?>
			</p>

			<p>
				<?php
				if ( defined( 'AC_GEO_REDIRECT_HEADER' ) ) :
					/* translators: %s the value of the constant: AC_GEO_REDIRECT_HEADER */
					printf( esc_html__( 'The header was defined via the AC_GEO_REDIRECT_HEADER constant as: %s', 'ac-geo-redirect' ), esc_html( AC_GEO_REDIRECT_HEADER ) );
				endif;
				?>
			</p>

			<hr>

			<h3><?php esc_html_e( 'All request headers:', 'ac-geo-redirect' ); ?></h3>

			<ul>
				<?php foreach ( $country_code->get_headers() as $key => $value ) : ?>
					<li><strong><?php echo esc_html( $key ); ?>:</strong> <?php echo esc_html( $value ) . "\n"; ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php
	}


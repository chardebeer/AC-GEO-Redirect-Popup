<?php

namespace Ac_Geo_Redirect;

class T10ns {

	/**
	 * Get localised text strings.
	 *
	 * You can add new or edit existing t10ns by using the
	 * `ac_geo_redirect_t10ns` filter.
	 *
	 * @param string $locale
	 *
	 * @return array
	 */
	public function get_t10ns( $locale = 'en_US' ) : array {

		foreach ($locale as $t10ns[] => $locale[]){
			$t10ns = [
				$locale =>[
					'header' => get_option( 'header_field'),
					'takeMeTo' => get_option( 'takeMeTo_field'),
					'remainOn' => get_option( 'remainOn_field'),
				]
				];
			}

		$default_t10ns = [
			'en_US' => [
				'header'   => "Hi! It seems like you're in",
				'takeMeTo' => 'Go to',
				'remainOn' => 'Stay at',
			],
			'sv_SE' => [
				'header'   => 'Hej! Vi tror att du befinner dig i',
				'takeMeTo' => 'Gå till',
				'remainOn' => 'Stanna på',
			],
			'no_NO' => [
				'header'   => 'Hei! Det virker som om du er i',
				'takeMeTo' => 'Gå till',
				'remainOn' => 'Hold på',
			],
		];
		$value = get_option( $arguments['uid'] );

		if( ! $value ) {
			$value = $arguments['default'];
			$t10ns == $default_t10ns;
		}

		$t10ns = apply_filters( 'ac_geo_redirect_t10ns', $t10ns );

		if ( ! $locale ) {
			return $t10ns;
		}

		return array_key_exists( $locale, $t10ns ) ? $t10ns[ $locale ] : $t10ns['en_US'];
	}
}

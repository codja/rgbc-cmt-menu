<?php

namespace Rgbcode_menu\classes\plugins;

use Rgbcode_menu\traits\Singleton;

class ACF {

	use Singleton;

	public function __construct() {
		//      options page
		//      https://www.advancedcustomfields.com/resources/options-page/
		add_action( 'init', [ $this, 'register_options_page' ] );

		//      in this hook you need register your fields
		//      https://www.advancedcustomfields.com/resources/register-fields-via-php/
		add_action( 'init', [ $this, 'register_fields' ] );

		// add new location
		add_filter( 'acf/location/rule_types', [ $this, 'acf_location_rules_types' ] );
		add_filter( 'acf/location/rule_values/menu_level', [ $this, 'acf_location_rule_values_level' ] );
		add_filter( 'acf/location/rule_match/menu_level', [ $this, 'acf_location_rule_match_level' ], 10, 4 );

	}

	public function register_options_page() {

		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page(
				[
					'page_title' => __( 'Rgbcode Menu', 'rgbcode-menu' ),
					'menu_title' => __( 'Rgbcode Menu', 'rgbcode-menu' ),
					'menu_slug'  => 'rgbcode-menu-options',
					'capability' => 'edit_posts',
					'icon_url'   => 'dashicons-menu', // Add this line and replace the second inverted commas with class of the icon you like
					'position'   => 30,
					'redirect'   => false,
				]
			);
		}
	}

	public function register_fields() {

		if ( function_exists( 'acf_add_local_field_group' ) ) {

			//          acf_add_local_field_group(
			//
			//          );

		}
	}

	public function acf_location_rules_types( $choices ): array {
		$choices['Menu']['menu_level'] = 'Menu Depth';
		return $choices;
	}


	public function acf_location_rule_values_level( $choices ) {
		$choices[0] = '1';
		$choices[1] = '2';
		$choices[2] = '3';

		return $choices;
	}

	public function acf_location_rule_match_level( $match, $rule, $options, $field_group ) {
		$current_screen = get_current_screen();

		if ( $current_screen->base === 'nav-menus' ) {
			if ( $rule['operator'] === '==' ) {
				$match = ( $options['nav_menu_item_depth'] === (int) $rule['value'] );
			}
		}

		return $match;
	}
}

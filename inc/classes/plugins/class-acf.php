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
	}

	public function register_options_page() {

		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page(
				[
					'page_title' => __( 'Rgbcode Menu', 'rgbcode-map' ),
					'menu_title' => __( 'Rgbcode Menu', 'rgbcode-map' ),
					'menu_slug'  => 'rgbcode-map-options',
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
			// Resources (for post-type Resources)

//			acf_add_local_field_group(
//
//			);

		}
	}
}

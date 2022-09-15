<?php

namespace Rgbcode_menu\classes\core;

use Rgbcode_menu\classes\menu\Menu;

class Setup {

	public function __construct() {
		// Load our frontend css and js
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_front' ], 9000 );
	}

	public function enqueue_admin() {
		wp_enqueue_style(
			'rgbcode_menu_style_admin',
			RGBCODE_MENU_PLUGIN_URL . 'assets/css/admin/rgbcode-menu.min.css',
			[],
			filemtime( RGBCODE_MENU_PLUGIN_DIR . 'assets/css/admin/rgbcode-menu.min.css' )
		);
		wp_enqueue_script(
			'rgbcode_menu_script_admin',
			RGBCODE_MENU_PLUGIN_URL . 'assets/js/admin/rgbcode-menu.min.js',
			[],
			filemtime( RGBCODE_MENU_PLUGIN_DIR . 'assets/js/admin/rgbcode-menu.min.js' ),
			true
		);
	}

	public function enqueue_front() {
		$menu_id        = Menu::get_menu_id();
		$is_enable_menu = get_field( 'rgbc_menu_enable', "menu_$menu_id" );

		if ( ! $is_enable_menu ) {
			return false;
		}

		wp_enqueue_style(
			'rgbcode_menu_style',
			RGBCODE_MENU_PLUGIN_URL . 'assets/css/front/rgbcode-menu.min.css',
			[],
			filemtime( RGBCODE_MENU_PLUGIN_DIR . 'assets/css/front/rgbcode-menu.min.css' )
		);
		wp_enqueue_script(
			'rgbcode_menu_script',
			RGBCODE_MENU_PLUGIN_URL . 'assets/js/front/rgbcode-menu.min.js',
			[],
			filemtime( RGBCODE_MENU_PLUGIN_DIR . 'assets/js/front/rgbcode-menu.min.js' ),
			true
		);

		$panda_forex_header_menu_button = get_field( 'panda_forex_header_menu_button', "menu_$menu_id" );
		// Localize our ajax
		wp_localize_script(
			'rgbcode_menu_script',
			'rgbcode_menu_ajax',
			[
				'url'                            => admin_url( 'admin-ajax.php' ),
				'nonce'                          => wp_create_nonce( 'rgbcode-menu-nonce' ),
				'panda_forex_header_menu_button' => wp_json_encode( $panda_forex_header_menu_button ),
			]
		);
	}
}

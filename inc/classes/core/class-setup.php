<?php

namespace Rgbcode_menu\classes\core;

class Setup {

	public function __construct() {
		// Load our frontend css and js
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_front' ] );
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
	}
}

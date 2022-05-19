<?php

namespace Rgbcode_menu\classes\core;

use Rgbcode_menu\traits\Singleton;

class Setup {

	use Singleton;

	public function __construct() {
		// Load our frontend css and js
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_front' ] );
		//      add_filter( 'show_admin_bar', '__return_false' );
	}

	public function enqueue_admin() {
		wp_enqueue_style(
			'rgbcode_map_style_admin',
			RGBCODE_MENU_PLUGIN_URL . 'assets/css/admin/rgbcode-menu.min.css',
			array(),
			filemtime( RGBCODE_MENU_PLUGIN_DIR . 'assets/css/admin/rgbcode-menu.min.css' )
		);
		wp_enqueue_script(
			'rgbcode_map_script_admin',
			RGBCODE_MENU_PLUGIN_URL . 'assets/js/admin/rgbcode-menu.min.js',
			array(),
			filemtime( RGBCODE_MENU_PLUGIN_DIR . 'assets/js/admin/rgbcode-menu.min.js' ),
			true
		);
	}

	public function enqueue_front() {
		wp_enqueue_style(
			'rgbcode_map_style',
			RGBCODE_MENU_PLUGIN_URL . 'assets/css/front/rgbcode-menu.min.css',
			array(),
			filemtime( RGBCODE_MENU_PLUGIN_DIR . 'assets/css/front/rgbcode-menu.min.css' )
		);
		wp_enqueue_script(
			'rgbcode_map_script',
			RGBCODE_MENU_PLUGIN_URL . 'assets/js/front/rgbcode-menu.min.js',
			array(),
			filemtime( RGBCODE_MENU_PLUGIN_DIR . 'assets/js/front/rgbcode-menu.min.js' ),
			true
		);
	}
}

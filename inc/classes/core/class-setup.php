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
			RGBCODE_MENU_PLUGIN_DIR . 'assets/js/admin/rgbcode_menu.css',
			array(),
			filemtime( RGBCODE_MENU_PLUGIN_DIR . 'assets/js/rgbcode_menu.css' )
		);
		wp_enqueue_script(
			'rgbcode_map_script_admin',
			RGBCODE_MENU_PLUGIN_DIR . 'assets/js/admin/rgbcode_menu.js',
			array(),
			filemtime( RGBCODE_MENU_PLUGIN_DIR . 'assets/js/rgbcode_menu.js' ),
			true
		);
	}

	public function enqueue_front() {
		wp_enqueue_style(
			'rgbcode_map_style',
			RGBCODE_MENU_PLUGIN_DIR . 'assets/js/front/rgbcode_menu.css',
			array(),
			filemtime( RGBCODE_MENU_PLUGIN_DIR . 'assets/js/rgbcode_menu.css' )
		);
		wp_enqueue_script(
			'rgbcode_map_script',
			RGBCODE_MENU_PLUGIN_DIR . 'assets/js/front/rgbcode_menu.js',
			array(),
			filemtime( RGBCODE_MENU_PLUGIN_DIR . 'assets/js/rgbcode_menu.js' ),
			true
		);
	}
}

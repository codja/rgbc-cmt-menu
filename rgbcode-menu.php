<?php
/**
* Plugin Name: Rgbcode Menu
* Plugin URI: https://rgbcode.com/
* Description: Rgbcode Menu.
* Author: rgbcode
* Author URI: https://rgbcode.com/
* Version: 1.0.6
* Text Domain: rgbcode-menu
* Domain Path: /languages
*/

namespace Rgbcode_menu;

use Rgbcode_menu\traits\Singleton;

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

if ( ! function_exists( 'is_plugin_active' ) ) {
	include_once ABSPATH . 'wp-admin/includes/plugin.php';
	if ( ! is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
		exit();
	}
}

define( 'RGBCODE_MENU_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'RGBCODE_MENU_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'RGBCODE_MENU_VERSION', '1.0.6' );
define( 'RGBCODE_MENU_IMAGES', RGBCODE_MENU_PLUGIN_URL . 'assets/images' );
define( 'RGBCODE_MENU_IMAGES_DIR', RGBCODE_MENU_PLUGIN_DIR . 'assets/images' );

if ( ! class_exists( 'Mobile_Detect' ) ) {
	require_once RGBCODE_MENU_PLUGIN_DIR . 'inc/libs/Mobile-Detect-2.8.39/Mobile_Detect.php';
}
require_once RGBCODE_MENU_PLUGIN_DIR . 'inc/autoload.php';
require_once RGBCODE_MENU_PLUGIN_DIR . 'inc/functions.php';

register_activation_hook( __FILE__, [ __NAMESPACE__ . '\\Rgbcode_menu', 'activation' ] );
register_deactivation_hook( __FILE__, [ __NAMESPACE__ . '\\Rgbcode_menu', 'deactivation' ] );
register_uninstall_hook( __FILE__, [ __NAMESPACE__ . '\\Rgbcode_menu', 'uninstall' ] );

add_action( 'plugins_loaded', [ __NAMESPACE__ . '\\Rgbcode_menu', 'instance' ] );

class Rgbcode_Menu {

	use Singleton;

	public function __construct() {
		load_plugin_textdomain(
			'rgbcode-menu',
			false,
			dirname( plugin_basename( __FILE__ ) ) . '/languages/'
		);
	}

	/*
	 * Plugin activation actions
	*/
	public static function activation(): void {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		$plugin = $_REQUEST['plugin'] ?? ''; // phpcs:ignore
		check_admin_referer( "activate-plugin_{$plugin}" );

		flush_rewrite_rules();
	}

	/*
	 * Plugin deactivation actions
	*/
	public static function deactivation(): void {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		$plugin = $_REQUEST['plugin'] ?? ''; // phpcs:ignore
		check_admin_referer( "deactivate-plugin_{$plugin}" );

		flush_rewrite_rules();
	}

	/*
	 * Plugin uninstall actions
	*/
	public static function uninstall(): void {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		self::remove_options();
	}

	/*
	 * Delete all options that the plugin has created
	*/
	private static function remove_options(): void {
		$options = [];

		foreach ( $options as $option ) {
			delete_option( $option );
		}
	}
}

<?php

namespace Rgbcode_menu;

use Rgbcode_menu\classes\menu\Menu;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @param $menu_id
 *
 * @return array
 */
function get_urls_by_platform_data( $menu_id ) {
	$res = [];

	$res['title']   = get_field( 'rgbc_menu_open_urls_title', "menu_$menu_id" );
	$res['ios']     = get_field( 'rgbc_menu_open_urls_ios', "menu_$menu_id" );
	$res['android'] = get_field( 'rgbc_menu_open_urls_android', "menu_$menu_id" );
	$res['mac']     = get_field( 'rgbc_menu_open_urls_mac', "menu_$menu_id" );
	$res['win']     = get_field( 'rgbc_menu_open_urls_win', "menu_$menu_id" );

	return $res;
}

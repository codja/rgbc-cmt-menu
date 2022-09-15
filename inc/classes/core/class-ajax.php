<?php

namespace Rgbcode_menu\classes\core;

use Mobile_Detect;

class Ajax {

	public function __construct() {
		add_action( 'wp_ajax_nopriv_rgbcode_menu_get_dynamic_content', [ $this, 'dynamic_content' ] );
		add_action( 'wp_ajax_rgbcode_menu_get_dynamic_content', [ $this, 'dynamic_content' ] );
	}

	public function dynamic_content() {
		if ( ! wp_verify_nonce( $_POST['nonce'], 'rgbcode-menu-nonce' ) ) {
			wp_send_json_error( 'Invalid nonce', 400 );
		}

		$res = false;

		$entity = trim( $_POST['entity'] ?? '' );

		switch ( $entity ) {
			case 'is-mobile':
				$detect = new Mobile_Detect();
				$res    = $detect->isMobile();
				break;
			default:
				wp_send_json_error( __( 'Unknown Entity', 'rgbcode-menu' ), 400 );
		}

		wp_send_json_success(
			$res
		);
	}

}

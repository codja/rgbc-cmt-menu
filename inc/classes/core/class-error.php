<?php

namespace Rgbcode_menu\classes\core;

use Rgbcode_menu\traits\Singleton;

class Error {

	use Singleton;

	public function log_error( string $title, string $error ) {
		error_log(
			'[' . gmdate( 'Y-m-d H:i:s' ) . '] Error: {' . $title . ':' . $error . "} \n===========\n",
			3,
			RGBCODE_MENU_PLUGIN_DIR . 'errors.log'
		);
	}
}

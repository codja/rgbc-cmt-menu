<?php

namespace Rgbcode_menu\traits;

trait Singleton {
	private static $instance = null;

	public static function instance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}

<?php

namespace Rgbcode_menu\classes\menu;

class Menu {

	public function __construct() {
		register_nav_menus(
			array(
				'rgbc_primary' => esc_html__( 'Rgbcode menu Primary', 'rgbcode-menu' ),
			)
		);
		add_action( 'wp_body_open', [ $this, 'init_menu' ] );
	}

	public function init_menu() {
		?>
		<header class="rgbcode-menu-header">
			<div class="rgbcode-menu-header__logo">
				<img src="" alt="">
			</div>
			<nav class="rgbcode-menu-header__menu rgbcode-menu" role="navigation">
				<?php
				wp_nav_menu(
					[
						'theme_location' => 'rgbc_primary',
						'fallback_cb'    => '__return_empty_string',
						'walker'         => new Rgbcode_Walker_Nav_Menu(),
					]
				);
				?>
			</nav>
		</header>
		<?php
	}


}

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
		$logo = get_custom_logo();
		?>
		<header id="rgbcode-menu-header" class="rgbcode-menu-header">
			<div class="rgbcode-menu-header__container">
				<?php if ( $logo ) : ?>
				<div class="rgbcode-menu-header__logo">
					<?php echo wp_kses_post( $logo ); ?>
				</div>
				<?php endif; ?>
				<?php
				wp_nav_menu(
					[
						'container'       => 'nav',
						'container_class' => 'rgbcode-menu-header__menu',
						'menu_class'      => 'rgbcode-menu',
						'menu_id'         => 'rgbcode-menu',
						'theme_location'  => 'rgbc_primary',
						'fallback_cb'     => '__return_empty_string',
						'depth'           => 3,
						'walker'          => new Rgbcode_Walker_Nav_Menu(),
					]
				);
				?>
			</div>
		</header>
		<div class="rgbcode-menu-modal">
			<div class="rgbcode-menu-modal__window">
				<button class="rgbcode-menu-modal__close" type="button">
					<svg width="30px" height="30px" viewBox="0 0 512 512">
						<path class="rgbcode-menu-modal__close-shape" d="M443.6,387.1L312.4,255.4l131.5-130c5.4-5.4,5.4-14.2,0-19.6l-37.4-37.6c-2.6-2.6-6.1-4-9.8-4c-3.7,0-7.2,1.5-9.8,4  L256,197.8L124.9,68.3c-2.6-2.6-6.1-4-9.8-4c-3.7,0-7.2,1.5-9.8,4L68,105.9c-5.4,5.4-5.4,14.2,0,19.6l131.5,130L68.4,387.1  c-2.6,2.6-4.1,6.1-4.1,9.8c0,3.7,1.4,7.2,4.1,9.8l37.4,37.6c2.7,2.7,6.2,4.1,9.8,4.1c3.5,0,7.1-1.3,9.8-4.1L256,313.1l130.7,131.1  c2.7,2.7,6.2,4.1,9.8,4.1c3.5,0,7.1-1.3,9.8-4.1l37.4-37.6c2.6-2.6,4.1-6.1,4.1-9.8C447.7,393.2,446.2,389.7,443.6,387.1z"></path>
					</svg>
				</button>
			</div>
		</div>
		<?php
	}


}

<?php

namespace Rgbcode_menu\classes\menu;

use Rgbcode_menu\traits\Singleton;

class Menu {

	use Singleton;

	const LOCATION_NAME = 'rgbc_primary';

	public function __construct() {
		register_nav_menus(
			array(
				self::LOCATION_NAME => esc_html__( 'Rgbcode menu Primary', 'rgbcode-menu' ),
			)
		);
		add_action( 'wp_body_open', [ $this, 'init_menu' ] );
	}

	public function init_menu() {
		$menu_id = $this->get_menu_id();

		if ( ! $menu_id ) {
			return false;
		}

		$is_enable_menu = get_field( 'rgbc_menu_enable', "menu_$menu_id" );

		if ( ! $is_enable_menu ) {
			return false;
		}

		?>
		<header id="rgbcode-menu-header" class="rgbcode-menu-header">
			<div class="rgbcode-menu-header__container">
				<button class="rgbcode-menu-hamburger" type="button">
					<span></span>
				</button>

				<div class="rgbcode-menu-header__wrapper">
					<?php
					$image        = $this->get_logo();
					$mobile_image = get_field( 'rgbc_menu_mobile_logo', "menu_$menu_id" );
					if ( $image ) :
						?>
					<a class="rgbcode-menu-header__logo" href="<?php echo esc_url( home_url() ); ?>">
						<picture>
							<source
								srcset="<?php echo esc_url( $mobile_image['url'] ); ?>" media="(max-width: 1280px)">
							<img src="<?php echo esc_url( reset( $image ) ); ?>"
								width="<?php echo esc_attr( $image[1] ); ?>"
								height="<?php echo esc_attr( $image[2] ); ?>" alt="cmtrading">
						</picture>
					</a>
					<?php endif; ?>

					<?php
						echo wp_kses_post( apply_filters( 'rgbc_menu_header_after_logo', '' ) );
					?>
				</div> <!-- ./rgbcode-menu-header__wrapper -->

				<nav class="rgbcode-menu-header__menu">

					<?php
					$mobile_opened_logo = get_field( 'rgbc_menu_mobile_opened_logo', "menu_$menu_id" );
					if ( $mobile_opened_logo ) :
						?>
					<a href="<?php echo get_site_url() ?>"><img class="rgbcode-menu-header__open-logo" src="<?php echo esc_url( $mobile_opened_logo['url'] ); ?>" width="230" alt="cmtrading"></a>
					<?php endif; ?>

					<button class="rgbcode-menu-header__close"></button>

					<button class="rgbcode-menu-header__back rgbcode-menu-only-mobile" type="button">
						<svg width="40px" height="30px" viewBox="0 0 512 512">
							<path d="M384.834,180.699c-0.698,0-348.733,0-348.733,0l73.326-82.187c4.755-5.33,4.289-13.505-1.041-18.26
								c-5.328-4.754-13.505-4.29-18.26,1.041l-82.582,92.56c-10.059,11.278-10.058,28.282,0.001,39.557l82.582,92.561
								c2.556,2.865,6.097,4.323,9.654,4.323c3.064,0,6.139-1.083,8.606-3.282c5.33-4.755,5.795-12.93,1.041-18.26l-73.326-82.188
								c0,0,348.034,0,348.733,0c55.858,0,101.3,45.444,101.3,101.3s-45.443,101.3-101.3,101.3h-61.58
								c-7.143,0-12.933,5.791-12.933,12.933c0,7.142,5.79,12.933,12.933,12.933h61.58c70.12,0,127.166-57.046,127.166-127.166
								C512,237.745,454.954,180.699,384.834,180.699z"/>
						</svg>
<!--						<span>--><?php //echo esc_html__( 'Back', 'rgbcode-menu' ); ?><!--</span>-->
					</button>

					<div class="rgbcode-menu-header__menu-wrap">
						<?php
						wp_nav_menu(
							[
								'container'      => false,
								'menu_class'     => 'rgbcode-menu',
								'menu_id'        => 'rgbcode-menu',
								'theme_location' => self::LOCATION_NAME,
								'fallback_cb'    => '__return_empty_string',
								'depth'          => 3,
								'walker'         => new Rgbcode_Walker_Nav_Menu(),
							]
						);
						?>

						<?php
						$social_btns = get_field( 'rgbc_menu_social_buttons', "menu_$menu_id" );
						if ( $social_btns ) :
							?>
							<div class="rgbcode-menu-social rgbcode-menu-only-mobile">
							<?php
							foreach ( $social_btns as $social_btn ) :
								?>
								<a
									class="rgbcode-menu-social__item"
									href="<?php echo esc_url( $social_btn['link'] ); ?>"
								>
									<img
										class="rgbcode-menu-social__img"
										src="<?php echo esc_url( $social_btn['icon']['url'] ); ?>"
										alt="<?php echo esc_attr( $social_btn['icon']['alt'] ); ?>"
										title="<?php echo esc_attr( $social_btn['icon']['title'] ); ?>"
									>
								</a>
								<?php
							endforeach;
							?>
							</div>
							<?php
						endif;
						?>

						<?php
						$button = get_field( 'rgbc_menu_open_button', "menu_$menu_id" );
						if ( $button ) :
							?>
							<a
								class="rgbcode-menu-header__open-btn rgbcode-menu-button rgbcode-menu-button_blue rgbcode-menu-only-mobile"
								href="<?php echo esc_url( $button['url'] ); ?>"
								target="<?php echo esc_attr( $button['target'] ); ?>"
							><?php echo esc_html( $button['title'] ); ?></a>
						<?php endif; ?>

						<?php
						$link = get_field( 'rgbc_menu_open_link', "menu_$menu_id" );
						if ( $link ) :
							?>
							<a
								class="rgbcode-menu-header__link rgbcode-menu-only-mobile"
								href="<?php echo esc_url( $link['url'] ); ?>"
								target="<?php echo esc_attr( $link['target'] ); ?>"
							><?php echo esc_html( $link['title'] ); ?></a>
						<?php endif; ?>
					</div>
				</nav>

			</div>
		</header>
		<div class="rgbcode-menu-back"></div>
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

	private function get_logo() {
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		return wp_get_attachment_image_src( $custom_logo_id, 'full' );
	}

	public function get_menu_id(): ?int {
		$locations = get_nav_menu_locations();
		return $locations[ self::LOCATION_NAME ];
	}

}

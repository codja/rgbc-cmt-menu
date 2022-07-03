<?php

namespace Rgbcode_menu\classes\menu;

use Mobile_Detect;
use Rgbcode_menu\traits\Singleton;
use function Rgbcode_menu\get_urls_by_platform_data;

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
		$menu_id = self::get_menu_id();

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
								srcset="<?php echo esc_url( $mobile_image['url'] ); ?>" media="(max-width: 1279px)">
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

						$detect    = new Mobile_Detect();
						$is_mobile = $detect->isMobile();

						if ( $button && $is_mobile ) :
							?>
							<a
								class="rgbcode-menu-header__open-btn rgbcode-menu-button rgbcode-menu-button_blue rgbcode-menu-only-mobile"
								href="<?php echo esc_url( $button['url'] ); ?>"
								target="<?php echo esc_attr( $button['target'] ); ?>"
							><?php echo esc_html( $button['title'] ); ?></a>
						<?php endif; ?>

						<?php
						$urls_by_platform_data            = get_urls_by_platform_data( self::get_menu_id() );
						$urls_by_platform_data['classes'] = [ 'rgbcode-menu-only-mobile' ];

						load_template(
							RGBCODE_MENU_PLUGIN_DIR . 'templates/platform-urls.php',
							false,
							$urls_by_platform_data
						);
						?>
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

	public static function get_menu_id(): ?int {
		$locations = get_nav_menu_locations();
		return $locations[ self::LOCATION_NAME ];
	}

}

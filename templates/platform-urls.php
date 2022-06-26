<?php
namespace Rgbcode_menu\templates;

use function Rgbcode_menu\get_browser;

$title_        = $args['title'] ?? '';
$desktop_items = $args['desktop_items'] ?? [];
$mobile_items  = $args['mobile_items'] ?? [];
$classes       = $args['classes'] ?? [];

$is_mobile = get_browser()['is_mobile'];

$items = $is_mobile ? $mobile_items : $desktop_items;

if ( ! $items ) {
	return '';
}
?>

<div
	class="rgbcode-menu-platform-urls <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<?php if ( $title_ ) { ?>
		<div class="rgbcode-menu-platform-urls__title"><?php echo esc_html( $title_ ); ?></div>
	<?php } ?>
	<div class="rgbcode-menu-platform-urls__items <?php echo $is_mobile ? 'rgbcode-menu-platform-urls__items-mobile' : 'rgbcode-menu-platform-urls__items-desktop'; ?>">
		<?php foreach ( $items as $item ) { ?>
			<div
				class="rgbcode-menu-platform-urls__item <?php echo esc_attr( $item['icon'] ? 'rgbcode-menu-platform-urls__item-with-icon' : '' ); ?>">
				<a
					title="<?php echo esc_attr( $item['link']['title'] ); ?>"
					target="<?php echo esc_attr( $item['link']['target'] ); ?>"
					href="<?php echo esc_url( $item['link']['url'] ); ?>"
					class="rgbcode-menu-platform-urls__link">
					<?php if ( $item['icon'] ) { ?>
						<img
							class="rgbcode-menu-platform-urls__img"
							src="<?php echo esc_url( $item['icon']['sizes']['thumbnail'] ?? '' ); ?>
							"/>
						<?php
					}
					echo esc_html( $item['link']['title'] );
					?>
				</a>
			</div>
		<?php } ?>
	</div>
</div>

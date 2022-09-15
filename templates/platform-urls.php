<?php
namespace Rgbcode_menu\templates;

/**
 * @var array $args
 */

if ( ! isset( $args ) || ! is_array( $args ) ) {
	return '';
}

$title_  = $args['title'] ?? '';
$classes = $args['classes'] ?? [];

ob_start();

foreach ( $args as $platform => $items ) {
	if (
		( $platform !== 'ios' && $platform !== 'android' && $platform !== 'mac' && $platform !== 'win' ) ||
		! is_array( $items ) || empty( $items )
	) {
		continue;
	}
	foreach ( $items as $item ) {
		?>
		<div
			data-platform="<?php echo esc_attr( $platform ); ?>"
			class="rgbcode-menu-platform-urls__item <?php echo esc_attr( $item['icon'] ? 'rgbcode-menu-platform-urls__item-with-icon' : '' ); ?> rgbcode-menu-platform-urls__hidden">
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
	<?php
}

$content = ob_get_clean();

if ( ! $content ) {
	return '';
}

?>

<div
	class="rgbcode-menu-platform-urls <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<?php if ( $title_ ) { ?>
		<div class="rgbcode-menu-platform-urls__title"><?php echo esc_html( $title_ ); ?></div>
	<?php } ?>
	<div class="rgbcode-menu-platform-urls__items">
		<?php
		//phpcs:ignore
		echo $content;
		?>
	</div>
</div>

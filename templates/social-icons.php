<?php

/**
 * @var array $args
 */

$title_  = $args['title'] ?? '';
$items   = $args['items'] ?? [];
$classes = $args['classes'] ?? [];

if ( ! $items ) {
	return;
}
?>

<div
	class="rgbcode-menu-bottom-content <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<?php if ( $title_ ) { ?>
		<div class="rgbcode-menu-bottom-content__title"><?php echo esc_html( $title_ ); ?></div>
	<?php } ?>
	<div class="rgbcode-menu-bottom-content__items">
		<?php
		foreach ( $items as $item ) :
			if ( $item['hide_on_desktop'] ) {
				continue;
			}
			?>
		<div class="rgbcode-menu-bottom-content__item">
			<a class="rgbcode-menu-bottom-content__link"
				href="<?php echo esc_url( $item['link']['url'] ); ?>"
				target="<?php echo esc_attr( $item['link']['target'] ); ?>"
			>
				<img
					class="rgbcode-menu-bottom-content__img"
					src="<?php echo esc_url( $item['icon']['sizes']['thumbnail'] ?? '' ); ?>"
					alt="<?php echo esc_attr( $item['icon']['alt'] ); ?>"
				/>
			</a>
		</div>
		<?php endforeach; ?>
	</div>
</div>

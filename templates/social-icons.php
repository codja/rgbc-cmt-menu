<?php
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
		<?php foreach ( $items as $item ) { ?>
			<div class="rgbcode-menu-bottom-content__item">
				<a href="<?php echo esc_url( $item['link'] ); ?>" class="rgbcode-menu-bottom-content__link">
					<img
						class="rgbcode-menu-bottom-content__img"
						src="<?php echo esc_url( $item['icon']['sizes']['thumbnail'] ?? '' ); ?>
							"/>
				</a>
			</div>
		<?php } ?>
	</div>
</div>

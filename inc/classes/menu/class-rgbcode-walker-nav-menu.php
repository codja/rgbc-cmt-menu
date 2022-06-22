<?php

namespace Rgbcode_menu\classes\menu;

class Rgbcode_Walker_Nav_Menu extends \Walker_Nav_Menu {

	public $custom_area;

	// add classes to ul sub-menus
	public function start_lvl( &$output, $depth = 0, $args = null ) {
		// depth dependent classes
		$indent        = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1 ); // because it counts the first submenu as 0
		$class_names   = $this->get_depth_classes( $display_depth );

		// build html
		$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
	}

	public function end_lvl( &$output, $depth = 0, $args = null ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent        = str_repeat( $t, $depth );
		$display_depth = ( $depth + 1 );
		$additional    = '';
		if ( $display_depth === 1 ) {
			$additional = $this->render_scroll_icon();
		}
		$output .= "$indent</ul>{$additional}{$n}";
	}

	// add main/sub classes to li's and links
	public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
		// Restores the more descriptive, specific name for use within this method.
		$item   = $data_object;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

		$depth_class_names = $this->get_depth_classes( $depth, 'menu-item' );
		$is_second_lvl     = $depth === 1;
		// passed classes
		$classes     = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

		// build html
		$output    .= $indent . '<li id="rgbcode-menu-item-' . $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';
		$class_name = $this->get_depth_classes( $depth, 'link', $item->ID );
		$format     = '%1$s<div%2$s>%3$s%4$s%5$s</div>%6$s';
		$title      = $item->title;
		// link attributes
		$attributes     = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes    .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes    .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes    .= " class='$class_name'";
		$is_enable_link = get_field( 'rgbc_menu_enable_link', $item->ID );

		if ( $is_enable_link ) {
			$attributes .= ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) . '"' : '';
			$format      = '%1$s<a%2$s>%3$s<span>%4$s</span>%5$s</a>%6$s';
		}

		if ( ! $is_second_lvl ) {
			$attributes .= ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) . '"' : '';
			$format      = '%1$s<a%2$s>%3$s<span>%4$s</span>%5$s</a>%6$s';
		} else {
			$is_empty_subtitle = get_field( 'rgbc_menu_empty', $item->ID );
			$title             = $is_empty_subtitle ? '' : $item->title;
		}

		$item_output = sprintf(
			$format,
			$args->before,
			$attributes,
			$args->link_before,
			apply_filters( 'the_title', $title, $item->ID ),
			$args->link_after,
			$args->after
		);

		// build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	public function end_el( &$output, $data_object, $depth = 0, $args = null ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$output .= "</li>{$n}";
		$item    = $data_object;
		if ( $depth === 1 && in_array( 'rgbcode-menu__custom-col', $item->classes ) ) {
			$output .= $this->render_custom_area( $item, $n );
		}
		if ( $depth === 2 && in_array( 'rgbcode-menu__last', $item->classes ) ) {
			$output .= $this->render_custom_button( $item, $n );
		}
		if ( in_array( 'rgbcode-menu__show_social_icons', $item->classes, true ) ) {
			ob_start();
			$social_icons_title = get_field( 'rgbc_social_icons_title', $item->menu_item_parent );
			$items              = $this->get_social_items_data();
			load_template(
				RGBCODE_MENU_PLUGIN_DIR . 'templates/social-icons.php',
				false,
				[
					'title'   => $social_icons_title,
					'items'   => $items,
					'classes' => [ 'rgbcode-menu-only-desktop' ],
				]
			);
			$load_template_res = ob_get_clean();
			$load_template_res = $load_template_res ? $load_template_res : '';

			$output .= $load_template_res . $n;
		}
	}

	public function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
		// We don't want to do anything at the 'top level'.
		if ( 0 === $depth ) {
			$reverse_block = get_field( 'rgbc_menu_reverse_block', $element->ID );
			$hide_mobile   = get_field( 'rgbc_menu_hide_on_mobile', $element->ID );
			$classes       = empty( $element->classes ) ? array() : (array) $element->classes;
			if ( $reverse_block ) {
				$classes[] = 'rgbcode-menu__reverse-block';
			}
			if ( $hide_mobile ) {
				$classes[] = 'rgbcode-menu-only-desktop';
			}
			$element->classes = $classes;
			return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}

		//Get the siblings of the current element
		$parent_id_field  = $this->db_fields['parent'];
		$parent_parent_id = $element->$parent_id_field;
		$siblings         = $children_elements[ $parent_parent_id ];

		//No Siblings??
		if ( ! is_array( $siblings ) ) {
			return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}

		$is_enable_custom_link = false;
		if ( $depth === 2 ) {
			$parent_post           = get_post( $element->menu_item_parent );
			$parent_parent_id      = get_post_meta( $parent_post->ID, '_menu_item_menu_item_parent', true );
			$is_enable_custom_link = get_field( 'rgbc_menu_custom_closing_link', $parent_parent_id );
		}

		//If current element is the last of the siblings, add class
		//Get the 'last' of the siblings.
		$last_child           = array_pop( $siblings );
		$id_field             = $this->db_fields['id'];
		$is_enable_custom_col = get_field( 'rgbc_menu_custom_area_column', $element->menu_item_parent );
		$show_social_icons    = get_field( 'rgbc_show_social_icons', $element->menu_item_parent );
		if ( $element->$id_field === $last_child->$id_field ) {
			$classes = empty( $element->classes ) ? array() : (array) $element->classes;
			if ( $is_enable_custom_col && $depth === 1 ) {
				$classes[] = 'rgbcode-menu__custom-col';
				update_post_meta( $element->ID, 'is_last_column', true );
				$this->custom_area = get_field( 'rgbc_menu_custom_area_settings', $element->menu_item_parent );
			}

			if ( $is_enable_custom_link && get_post_meta( $element->menu_item_parent, 'is_last_column', true ) ) {
				$classes[] = 'rgbcode-menu__last';
			}

			if ( $show_social_icons && $depth === 2 ) {
				$classes[] = 'rgbcode-menu__show_social_icons';
			}

			$element->classes = $classes;
		} else {
			delete_post_meta( $element->ID, 'is_last_column' );
		}

		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	private function render_custom_area( $item, $n ) {
		$custom_area_data = get_field( 'rgbc_menu_custom_area_settings', $item->menu_item_parent );

		$show_social_icons  = $custom_area_data['rgbc_show_social_icons'];
		$social_icons_title = $custom_area_data['rgbc_social_icons_title'];
		ob_start();
		?>
		<li class='rgbcode-menu__second-lvl-menu-item rgbcode-menu__editor'>
			<?php
			echo wp_kses_post( $custom_area_data['text_area'] );
			if ( $custom_area_data['rgbc_menu_content_type'] === 'img' ) :
				?>
			<a href="<?php echo esc_url( $custom_area_data['rgbc_menu_image_data']['rgbc_menu_image_link'] ); ?>">
				<img
					src="<?php echo esc_url( $custom_area_data['rgbc_menu_image_data']['rgbc_menu_upload_image']['url'] ); ?>"
					alt="<?php echo esc_attr( $custom_area_data['rgbc_menu_image_data']['rgbc_menu_upload_image']['alt'] ); ?>"
				>
			</a>
				<?php
			elseif ( $custom_area_data['rgbc_menu_content_type'] === 'video' ) :
				$id_video = $this->get_param_from_url( $custom_area_data['rgbc_menu_video'], 'v' );
				?>
				<div class="rgbcode-menu-video">
					<div class="rgbcode-menu-video__link">
						<img class="rgbcode-menu-video__media" src="https://i.ytimg.com/vi/<?php echo esc_attr( $id_video ? $id_video : '_usDhha1l8o' ); ?>/maxresdefault.jpg" alt="">
					</div>
					<button class="rgbcode-menu-video__button" aria-label="Launch video">
						<svg width="68" height="48" viewBox="0 0 68 48">
							<path class="rgbcode-menu-video__button-shape" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z">
							</path>
							<path class="rgbcode-menu-video__button-icon" d="M 45,24 27,14 27,34"></path>
						</svg>
					</button>
				</div>
			<?php endif; ?>
			<?php
			if ( $show_social_icons ) {
				$items = $this->get_social_items_data();

				load_template(
					RGBCODE_MENU_PLUGIN_DIR . 'templates/social-icons.php',
					false,
					[
						'title'   => $social_icons_title,
						'items'   => $items,
						'classes' => [ 'rgbcode-menu-only-desktop' ],
					]
				);
			}
			?>
		</li>
		<?php
		echo $n;
		return ob_get_clean();
	}

	private function render_custom_button( $item, $n ) {
		$parent_post      = get_post( $item->menu_item_parent );
		$parent_parent_id = get_post_meta( $parent_post->ID, '_menu_item_menu_item_parent', true );
		$custom_link      = get_field( 'rgbc_menu_custom_closing_link', $parent_parent_id );

		return sprintf(
			"<a class='rgbcode-menu__third-lvl-btn' href='%s'>%s</a>{$n}",
			esc_url( $custom_link['url'] ),
			esc_html( $custom_link['title'] )
		);
	}

	private function get_depth_classes( $depth, $type = 'menu', $id = null ): string {
		// depth dependent classes
		switch ( $depth ) {
			case 0:
				$class_name = "rgbcode-menu__first-lvl-$type";
				break;
			case 1:
				$class_name = "rgbcode-menu__second-lvl-$type";
				break;
			case 2:
				$class_name = "rgbcode-menu__third-lvl-$type";
				$add_space  = get_field( 'rgbc_menu_add_space', $id );
				if ( $add_space ) {
					$class_name .= ' rgbcode-menu__third-lvl-' . $type . '_space';
				}
				break;
			default:
				$class_name = "rgbcode-menu__$type";
		}

		return $class_name;
	}

	private function get_param_from_url( string $url, string $param ): ?string {
		$parts = wp_parse_url( esc_url_raw( $url ) );
		parse_str( $parts['query'], $query );
		return $query[ $param ];
	}

	private function render_scroll_icon() {
		ob_start();
		?>
		<div class="rgbcode-menu-scrolldown rgbcode-menu-only-mobile">
			<div class="rgbcode-menu-scrolldown__btn">
				<svg width="50px" height="80px" viewbox="0 0 50 80">
					<path class="first-path"
						d="M24.752,79.182c-0.397,0-0.752-0.154-1.06-0.463L2.207,57.234c-0.306-0.305-0.458-0.656-0.458-1.057                  s0.152-0.752,0.458-1.059l2.305-2.305c0.309-0.309,0.663-0.461,1.06-0.461c0.398,0,0.752,0.152,1.061,0.461l18.119,18.119                  l18.122-18.119c0.306-0.309,0.657-0.461,1.057-0.461c0.402,0,0.753,0.152,1.059,0.461l2.306,2.305                  c0.308,0.307,0.461,0.658,0.461,1.059s-0.153,0.752-0.461,1.057L25.813,78.719C25.504,79.027,25.15,79.182,24.752,79.182z"/>
					<path class="second-path"
					  d="M24.752,58.25c-0.397,0-0.752-0.154-1.06-0.463L2.207,36.303c-0.306-0.304-0.458-0.655-0.458-1.057                  c0-0.4,0.152-0.752,0.458-1.058l2.305-2.305c0.309-0.308,0.663-0.461,1.06-0.461c0.398,0,0.752,0.153,1.061,0.461l18.119,18.12                  l18.122-18.12c0.306-0.308,0.657-0.461,1.057-0.461c0.402,0,0.753,0.153,1.059,0.461l2.306,2.305                  c0.308,0.306,0.461,0.657,0.461,1.058c0,0.401-0.153,0.753-0.461,1.057L25.813,57.787C25.504,58.096,25.15,58.25,24.752,58.25z"/>
				</svg>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * @return mixed
	 */
	private function get_social_items_data() {
		$menu_id = get_nav_menu_locations()[ Menu::LOCATION_NAME ] ?? null;
		$items   = get_field( 'rgbc_menu_social_buttons', "menu_$menu_id" );

		return $items;
	}
}

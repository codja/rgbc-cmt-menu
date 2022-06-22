<?php

namespace Rgbcode_menu\classes\plugins;

use Rgbcode_menu\traits\Singleton;

class ACF {

	use Singleton;

	public function __construct() {
		//      in this hook you need register your fields
		//      https://www.advancedcustomfields.com/resources/register-fields-via-php/
		add_action( 'init', [ $this, 'register_fields' ] );

		// add new location
		add_filter( 'acf/location/rule_types', [ $this, 'acf_location_rules_types' ] );
		add_filter( 'acf/location/rule_values/menu_level', [ $this, 'acf_location_rule_values_level' ] );
		add_filter( 'acf/location/rule_match/menu_level', [ $this, 'acf_location_rule_match_level' ], 10, 4 );

	}

	public function register_fields() {
		// phpcs:disable
		if( function_exists('acf_add_local_field_group') ):

			acf_add_local_field_group(array(
				'key' => 'group_628356bbc11ae',
				'title' => 'Rgbcode Map third level settings',
				'fields' => array(
					array(
						'key' => 'field_628356e71cc04',
						'label' => 'Add space',
						'name' => 'rgbc_menu_add_space',
						'type' => 'checkbox',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'yes' => 'Yes',
						),
						'allow_custom' => 0,
						'default_value' => array(
						),
						'layout' => 'vertical',
						'toggle' => 0,
						'return_format' => 'value',
						'save_custom' => 0,
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'nav_menu_item',
							'operator' => '==',
							'value' => 'location/rgbc_primary',
						),
						array(
							'param' => 'menu_level',
							'operator' => '==',
							'value' => '2',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => true,
				'description' => '',
				'show_in_rest' => 0,
				'modified' => 1655793255,
			));

			acf_add_local_field_group(array(
				'key' => 'group_6289e58e65e62',
				'title' => 'Rgbcode Menu first level settings',
				'fields' => array(
					array(
						'key' => 'field_6289e5b272829',
						'label' => 'Custom area column',
						'name' => 'rgbc_menu_custom_area_column',
						'type' => 'checkbox',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'yes' => 'Yes',
						),
						'allow_custom' => 0,
						'default_value' => array(
						),
						'layout' => 'vertical',
						'toggle' => 0,
						'return_format' => 'value',
						'save_custom' => 0,
					),
					array(
						'key' => 'field_6289e5f27282a',
						'label' => 'Custom area settings',
						'name' => 'rgbc_menu_custom_area_settings',
						'type' => 'group',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => array(
							array(
								array(
									'field' => 'field_6289e5b272829',
									'operator' => '==',
									'value' => 'yes',
								),
							),
						),
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'layout' => 'block',
						'sub_fields' => array(
							array(
								'key' => 'field_6289e63b7282b',
								'label' => 'Text area',
								'name' => 'text_area',
								'type' => 'wysiwyg',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'tabs' => 'all',
								'toolbar' => 'basic',
								'media_upload' => 0,
								'delay' => 0,
							),
							array(
								'key' => 'field_628f2016e36c2',
								'label' => 'Content type',
								'name' => 'rgbc_menu_content_type',
								'type' => 'radio',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'choices' => array(
									'img' => 'Image',
									'video' => 'Video',
								),
								'allow_null' => 0,
								'other_choice' => 0,
								'default_value' => '',
								'layout' => 'vertical',
								'return_format' => 'value',
								'save_other_choice' => 0,
							),
							array(
								'key' => 'field_628f2071e36c3',
								'label' => 'Image data',
								'name' => 'rgbc_menu_image_data',
								'type' => 'group',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_628f2016e36c2',
											'operator' => '==',
											'value' => 'img',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'layout' => 'block',
								'sub_fields' => array(
									array(
										'key' => 'field_628f20b7e36c4',
										'label' => 'Image Link',
										'name' => 'rgbc_menu_image_link',
										'type' => 'link',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'return_format' => 'url',
									),
									array(
										'key' => 'field_628f210be36c5',
										'label' => 'Upload image',
										'name' => 'rgbc_menu_upload_image',
										'type' => 'image',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'return_format' => 'array',
										'preview_size' => 'medium',
										'library' => 'all',
										'min_width' => '',
										'min_height' => '',
										'min_size' => '',
										'max_width' => '',
										'max_height' => '',
										'max_size' => '',
										'mime_types' => '',
									),
								),
							),
							array(
								'key' => 'field_628f2134e36c6',
								'label' => 'Video',
								'name' => 'rgbc_menu_video',
								'type' => 'url',
								'instructions' => 'Specify the link to the video from Youtube',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_628f2016e36c2',
											'operator' => '==',
											'value' => 'video',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'placeholder' => '',
							),
							array(
								'key' => 'field_62b2dc043b73a',
								'label' => 'Show social icons',
								'name' => 'rgbc_show_social_icons',
								'type' => 'true_false',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'message' => '',
								'default_value' => 0,
								'ui' => 1,
								'ui_on_text' => '',
								'ui_off_text' => '',
							),
							array(
								'key' => 'field_62b2dc2a3b73b',
								'label' => 'Social icons title',
								'name' => 'rgbc_social_icons_title',
								'type' => 'text',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_62b2dc043b73a',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => 'Follow us on Social Media',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'maxlength' => '',
							),
						),
					),
					array(
						'key' => 'field_6289e77e0b778',
						'label' => 'Custom closing link',
						'name' => 'rgbc_menu_custom_closing_link',
						'type' => 'link',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
					),
					array(
						'key' => 'field_628ded0ffa579',
						'label' => 'Reverse block',
						'name' => 'rgbc_menu_reverse_block',
						'type' => 'checkbox',
						'instructions' => 'Turn the content block in the opposite direction',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'yes' => 'Yes',
						),
						'allow_custom' => 0,
						'default_value' => array(
						),
						'layout' => 'vertical',
						'toggle' => 0,
						'return_format' => 'value',
						'save_custom' => 0,
					),
					array(
						'key' => 'field_6295b8491d258',
						'label' => 'Hide on mobile',
						'name' => 'rgbc_menu_hide_on_mobile',
						'type' => 'true_false',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 1,
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'nav_menu_item',
							'operator' => '==',
							'value' => 'location/rgbc_primary',
						),
						array(
							'param' => 'menu_level',
							'operator' => '==',
							'value' => '0',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => true,
				'description' => '',
				'show_in_rest' => 0,
			));

			acf_add_local_field_group(array(
				'key' => 'group_628ce7ca241f7',
				'title' => 'Rgbcode Menu second level settings',
				'fields' => array(
					array(
						'key' => 'field_628ce7ca331b2',
						'label' => 'Empty',
						'name' => 'rgbc_menu_empty',
						'type' => 'checkbox',
						'instructions' => 'Check the box if you don\'t need a subtitle',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'yes' => 'Yes',
						),
						'allow_custom' => 0,
						'default_value' => array(
						),
						'layout' => 'vertical',
						'toggle' => 0,
						'return_format' => 'value',
						'save_custom' => 0,
					),
					array(
						'key' => 'field_628dd821d9281',
						'label' => 'Enable Link',
						'name' => 'rgbc_menu_enable_link',
						'type' => 'checkbox',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'yes' => 'Yes',
						),
						'allow_custom' => 0,
						'default_value' => array(
						),
						'layout' => 'vertical',
						'toggle' => 0,
						'return_format' => 'value',
						'save_custom' => 0,
					),
					array(
						'key' => 'field_62b2d69df3735',
						'label' => 'Show social icons',
						'name' => 'rgbc_show_social_icons',
						'type' => 'true_false',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 0,
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),
					array(
						'key' => 'field_62b2d6b9f3736',
						'label' => 'Social icons title',
						'name' => 'rgbc_social_icons_title',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => array(
							array(
								array(
									'field' => 'field_62b2d69df3735',
									'operator' => '==',
									'value' => '1',
								),
							),
						),
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => 'Follow us on Social Media',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'nav_menu_item',
							'operator' => '==',
							'value' => 'location/rgbc_primary',
						),
						array(
							'param' => 'menu_level',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => true,
				'description' => '',
				'show_in_rest' => 0,
			));

			acf_add_local_field_group(array(
				'key' => 'group_629462611a47a',
				'title' => 'Rgbcode Menu Settings',
				'fields' => array(
					array(
						'key' => 'field_62a6d76b09d00',
						'label' => 'Enable menu',
						'name' => 'rgbc_menu_enable',
						'type' => 'true_false',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 0,
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),
					array(
						'key' => 'field_629463e8301df',
						'label' => 'Closed menu',
						'name' => '',
						'type' => 'tab',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'placement' => 'top',
						'endpoint' => 0,
					),
					array(
						'key' => 'field_6294627d301de',
						'label' => 'Mobile logo',
						'name' => 'rgbc_menu_mobile_logo',
						'type' => 'image',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
						'preview_size' => 'medium',
						'library' => 'all',
						'min_width' => '',
						'min_height' => '',
						'min_size' => '',
						'max_width' => '',
						'max_height' => '',
						'max_size' => '',
						'mime_types' => '',
					),
					array(
						'key' => 'field_629464c0438b4',
						'label' => 'Opened menu',
						'name' => '',
						'type' => 'tab',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'placement' => 'top',
						'endpoint' => 0,
					),
					array(
						'key' => 'field_6294b05c58c3a',
						'label' => 'Mobile logo',
						'name' => 'rgbc_menu_mobile_opened_logo',
						'type' => 'image',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
						'preview_size' => 'medium',
						'library' => 'all',
						'min_width' => '',
						'min_height' => '',
						'min_size' => '',
						'max_width' => '',
						'max_height' => '',
						'max_size' => '',
						'mime_types' => '',
					),
					array(
						'key' => 'field_629464d6438b5',
						'label' => 'Social buttons',
						'name' => 'rgbc_menu_social_buttons',
						'type' => 'repeater',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'collapsed' => '',
						'min' => 0,
						'max' => 0,
						'layout' => 'table',
						'button_label' => '',
						'sub_fields' => array(
							array(
								'key' => 'field_629465b0438b6',
								'label' => 'Icon',
								'name' => 'icon',
								'type' => 'image',
								'instructions' => '',
								'required' => 1,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'return_format' => 'array',
								'preview_size' => 'medium',
								'library' => 'all',
								'min_width' => '',
								'min_height' => '',
								'min_size' => '',
								'max_width' => '',
								'max_height' => '',
								'max_size' => '',
								'mime_types' => '',
							),
							array(
								'key' => 'field_629465f1438b7',
								'label' => 'Link',
								'name' => 'link',
								'type' => 'url',
								'instructions' => '',
								'required' => 1,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'placeholder' => '',
							),
						),
					),
					array(
						'key' => 'field_6294c0f2a324f',
						'label' => 'Button',
						'name' => 'rgbc_menu_open_button',
						'type' => 'link',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
					),
					array(
						'key' => 'field_6294c147a3250',
						'label' => 'Link',
						'name' => 'rgbc_menu_open_link',
						'type' => 'link',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'nav_menu',
							'operator' => '==',
							'value' => 'location/rgbc_primary',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => true,
				'description' => '',
				'show_in_rest' => 0,
			));

		endif;
		// phpcs:enable
	}

	public function acf_location_rules_types( $choices ): array {
		$choices['Menu']['menu_level'] = 'Menu Depth';
		return $choices;
	}


	public function acf_location_rule_values_level( $choices ) {
		$choices[0] = '1';
		$choices[1] = '2';
		$choices[2] = '3';

		return $choices;
	}

	public function acf_location_rule_match_level( $match, $rule, $options, $field_group ) {
		$current_screen = get_current_screen();

		if ( $current_screen->base === 'nav-menus' ) {
			if ( $rule['operator'] === '==' ) {
				$match = ( $options['nav_menu_item_depth'] === (int) $rule['value'] );
			}
		}

		return $match;
	}
}

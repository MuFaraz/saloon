<?php
/**
 * Native meta boxes (no ACF): a tiny field renderer driven by config arrays.
 *
 * @package MaisonBelleCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Meta box definitions: post type(s), title and fields.
 *
 * @return array[]
 */
function mb_meta_box_config() {
	$icons = mb_icon_choices();
	$tones = mb_tone_choices();

	$placeholder_fields = array(
		'mb_tone' => array( 'type' => 'select', 'label' => __( 'Placeholder colour', 'maison-belle-core' ), 'options' => $tones, 'default' => 'blush', 'help' => __( 'Only used while no photo is set.', 'maison-belle-core' ) ),
		'mb_icon' => array( 'type' => 'select', 'label' => __( 'Placeholder icon', 'maison-belle-core' ), 'options' => $icons, 'default' => 'sparkle' ),
	);

	return array(
		'mb_service_details' => array(
			'title'  => __( 'Service details', 'maison-belle-core' ),
			'types'  => array( 'mb_service' ),
			'fields' => array(
				'mb_price'       => array( 'type' => 'number', 'label' => __( 'Price', 'maison-belle-core' ), 'help' => __( 'Number only, e.g. 40. The currency symbol is set in Salon Settings.', 'maison-belle-core' ) ),
				'mb_duration'    => array( 'type' => 'text', 'label' => __( 'Duration (optional)', 'maison-belle-core' ), 'help' => __( 'e.g. 45 min', 'maison-belle-core' ) ),
				'mb_description' => array( 'type' => 'textarea', 'label' => __( 'Short description (optional)', 'maison-belle-core' ) ),
			),
		),
		'mb_gallery_details' => array(
			'title'  => __( 'Gallery item options', 'maison-belle-core' ),
			'types'  => array( 'mb_gallery' ),
			'fields' => array_merge(
				array(
					'mb_aspect' => array(
						'type'    => 'select',
						'label'   => __( 'Shape in the gallery grid', 'maison-belle-core' ),
						'options' => array(
							'portrait' => __( 'Portrait (4:5)', 'maison-belle-core' ),
							'tall'     => __( 'Tall (3:4)', 'maison-belle-core' ),
							'square'   => __( 'Square', 'maison-belle-core' ),
							'wide'     => __( 'Wide (4:3)', 'maison-belle-core' ),
						),
						'default' => 'portrait',
						'help'    => __( 'The title is used as the image description (alt text). Set the photo with "Photo" on the right; choose a category on the right too.', 'maison-belle-core' ),
					),
				),
				$placeholder_fields
			),
		),
		'mb_review_details' => array(
			'title'  => __( 'Review details', 'maison-belle-core' ),
			'types'  => array( 'mb_review' ),
			'fields' => array(
				'mb_text'    => array( 'type' => 'textarea', 'label' => __( 'Review text', 'maison-belle-core' ) ),
				'mb_service' => array( 'type' => 'text', 'label' => __( 'Service received', 'maison-belle-core' ), 'help' => __( 'e.g. Gel Manicure. The post title is the client name.', 'maison-belle-core' ) ),
				'mb_rating'  => array( 'type' => 'select', 'label' => __( 'Rating', 'maison-belle-core' ), 'options' => array( 5 => '5 ★', 4 => '4 ★', 3 => '3 ★', 2 => '2 ★', 1 => '1 ★' ), 'default' => 5 ),
			),
		),
		'mb_promo_details' => array(
			'title'  => __( 'Promotion details', 'maison-belle-core' ),
			'types'  => array( 'mb_promo' ),
			'fields' => array(
				'mb_tag'       => array( 'type' => 'text', 'label' => __( 'Badge', 'maison-belle-core' ), 'help' => __( 'Small label above the title, e.g. New guests.', 'maison-belle-core' ) ),
				'mb_highlight' => array( 'type' => 'text', 'label' => __( 'Big highlight', 'maison-belle-core' ), 'help' => __( 'e.g. 15% off or Save $15', 'maison-belle-core' ) ),
				'mb_text'      => array( 'type' => 'textarea', 'label' => __( 'Offer text', 'maison-belle-core' ) ),
				'mb_fine'      => array( 'type' => 'text', 'label' => __( 'Fine print', 'maison-belle-core' ) ),
				'mb_icon'      => array( 'type' => 'select', 'label' => __( 'Icon', 'maison-belle-core' ), 'options' => $icons, 'default' => 'sparkle' ),
				'mb_cta_label' => array( 'type' => 'text', 'label' => __( 'Button label', 'maison-belle-core' ), 'default' => 'Book now' ),
				'mb_cta_url'   => array( 'type' => 'url', 'label' => __( 'Button link', 'maison-belle-core' ), 'help' => __( 'Leave empty to use the booking URL from Salon Settings.', 'maison-belle-core' ) ),
			),
		),
		'mb_page_hero' => array(
			'title'  => __( 'Page banner (top of page)', 'maison-belle-core' ),
			'types'  => array( 'page' ),
			'fields' => array(
				'mb_hero_eyebrow' => array( 'type' => 'text', 'label' => __( 'Small line above the title', 'maison-belle-core' ) ),
				'mb_hero_title'   => array( 'type' => 'text', 'label' => __( 'Big title', 'maison-belle-core' ), 'help' => __( 'Wrap a word in *asterisks* for the italic accent. Empty = page title.', 'maison-belle-core' ) ),
				'mb_hero_intro'   => array( 'type' => 'textarea', 'label' => __( 'Intro text', 'maison-belle-core' ) ),
			),
		),
		'mb_post_options' => array(
			'title'   => __( 'Placeholder image (when no featured image)', 'maison-belle-core' ),
			'types'   => array( 'post' ),
			'context' => 'side',
			'fields'  => $placeholder_fields,
		),
	);
}

/**
 * Register the meta boxes.
 */
function mb_add_meta_boxes() {
	foreach ( mb_meta_box_config() as $id => $box ) {
		foreach ( $box['types'] as $type ) {
			add_meta_box(
				$id,
				$box['title'],
				'mb_render_meta_box',
				$type,
				isset( $box['context'] ) ? $box['context'] : 'normal',
				'high',
				array( 'box_id' => $id )
			);
		}
	}
}
add_action( 'add_meta_boxes', 'mb_add_meta_boxes' );

/**
 * Render one meta box.
 *
 * @param WP_Post $post Current post.
 * @param array   $args add_meta_box args.
 */
function mb_render_meta_box( $post, $args ) {
	$config = mb_meta_box_config();
	$id     = $args['args']['box_id'];
	wp_nonce_field( 'mb_save_' . $id, 'mb_nonce_' . $id );
	echo '<table class="form-table" role="presentation"><tbody>';
	foreach ( $config[ $id ]['fields'] as $key => $field ) {
		$value = get_post_meta( $post->ID, $key, true );
		if ( '' === $value && isset( $field['default'] ) ) {
			$value = $field['default'];
		}
		echo '<tr><th scope="row"><label for="' . esc_attr( $key ) . '">' . esc_html( $field['label'] ) . '</label></th><td>';
		mb_render_field( $key, $field, $value, $key );
		if ( ! empty( $field['help'] ) ) {
			echo '<p class="description">' . esc_html( $field['help'] ) . '</p>';
		}
		echo '</td></tr>';
	}
	echo '</tbody></table>';
}

/**
 * Print one input.
 *
 * @param string $name  Input name attribute.
 * @param array  $field Field definition.
 * @param mixed  $value Current value.
 * @param string $id    Input id attribute.
 */
function mb_render_field( $name, $field, $value, $id ) {
	switch ( $field['type'] ) {
		case 'textarea':
		case 'lines':
			printf( '<textarea class="large-text" rows="3" id="%1$s" name="%2$s">%3$s</textarea>', esc_attr( $id ), esc_attr( $name ), esc_textarea( (string) $value ) );
			break;
		case 'select':
			printf( '<select id="%1$s" name="%2$s">', esc_attr( $id ), esc_attr( $name ) );
			foreach ( $field['options'] as $opt_value => $opt_label ) {
				printf( '<option value="%1$s"%2$s>%3$s</option>', esc_attr( $opt_value ), selected( (string) $value, (string) $opt_value, false ), esc_html( $opt_label ) );
			}
			echo '</select>';
			break;
		case 'number':
			printf( '<input type="number" step="0.01" min="0" class="small-text" id="%1$s" name="%2$s" value="%3$s">', esc_attr( $id ), esc_attr( $name ), esc_attr( (string) $value ) );
			break;
		case 'media':
			$url = $value ? wp_get_attachment_image_url( (int) $value, 'thumbnail' ) : '';
			printf(
				'<div class="mb-media"><input type="hidden" id="%1$s" name="%2$s" value="%3$s"><div class="mb-media__preview">%4$s</div><button type="button" class="button mb-media__pick">%5$s</button> <button type="button" class="button-link mb-media__clear"%6$s>%7$s</button></div>',
				esc_attr( $id ),
				esc_attr( $name ),
				esc_attr( (string) (int) $value ),
				$url ? '<img src="' . esc_url( $url ) . '" alt="" width="96" height="96">' : '',
				esc_html__( 'Choose image', 'maison-belle-core' ),
				$value ? '' : ' hidden',
				esc_html__( 'Remove', 'maison-belle-core' )
			);
			break;
		default:
			$type = in_array( $field['type'], array( 'url', 'email' ), true ) ? $field['type'] : 'text';
			printf( '<input type="%1$s" class="regular-text" id="%2$s" name="%3$s" value="%4$s">', esc_attr( $type ), esc_attr( $id ), esc_attr( $name ), esc_attr( (string) $value ) );
	}
}

/**
 * Sanitise a single scalar value according to its field type.
 *
 * @param array $field Field definition.
 * @param mixed $value Raw value.
 * @param bool  $unslash Whether the value still has magic-quote slashes ($_POST does, options.php input does not).
 * @return mixed
 */
function mb_sanitize_field_value( $field, $value, $unslash = true ) {
	$value = ( $unslash && is_string( $value ) ) ? wp_unslash( $value ) : $value;
	switch ( $field['type'] ) {
		case 'textarea':
		case 'lines':
			return sanitize_textarea_field( (string) $value );
		case 'url':
			return esc_url_raw( (string) $value );
		case 'email':
			return sanitize_email( (string) $value );
		case 'number':
			return '' === $value ? '' : (string) (float) $value;
		case 'media':
			return absint( $value );
		case 'select':
			return array_key_exists( (string) $value, $field['options'] ) ? sanitize_text_field( (string) $value ) : ( isset( $field['default'] ) ? $field['default'] : '' );
		default:
			return sanitize_text_field( (string) $value );
	}
}

/**
 * Save meta box values.
 *
 * @param int $post_id Post ID.
 */
function mb_save_meta_boxes( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( wp_is_post_revision( $post_id ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$type = get_post_type( $post_id );
	foreach ( mb_meta_box_config() as $id => $box ) {
		if ( ! in_array( $type, $box['types'], true ) ) {
			continue;
		}
		if ( ! isset( $_POST[ 'mb_nonce_' . $id ] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ 'mb_nonce_' . $id ] ) ), 'mb_save_' . $id ) ) {
			continue;
		}
		foreach ( $box['fields'] as $key => $field ) {
			if ( ! isset( $_POST[ $key ] ) ) {
				continue;
			}
			// Value is unslashed and sanitised inside mb_sanitize_field_value().
			update_post_meta( $post_id, $key, mb_sanitize_field_value( $field, $_POST[ $key ] ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		}
	}
}
add_action( 'save_post', 'mb_save_meta_boxes' );

/**
 * Load the small admin script (media picker) on screens that need it.
 *
 * @param string $hook Current admin page hook.
 */
function mb_admin_assets( $hook ) {
	$screen = get_current_screen();
	$needs  = in_array( $hook, array( 'toplevel_page_mb-salon-settings', 'term.php', 'edit-tags.php' ), true )
		|| ( $screen && in_array( $screen->post_type, array( 'mb_gallery', 'mb_service', 'post', 'page' ), true ) );
	if ( ! $needs ) {
		return;
	}
	wp_enqueue_media();
	wp_enqueue_style( 'mb-admin', MB_CORE_URL . 'assets/admin.css', array(), MB_CORE_VERSION );
	wp_enqueue_script( 'mb-admin', MB_CORE_URL . 'assets/admin.js', array( 'jquery' ), MB_CORE_VERSION, true );
}
add_action( 'admin_enqueue_scripts', 'mb_admin_assets' );

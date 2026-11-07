<?php
/**
 * Extra fields on the Service category screens (Manicure, Pedicure, ...).
 *
 * @package MaisonBelleCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Field definitions for service categories.
 *
 * @return array<string,array>
 */
function mb_service_cat_fields() {
	return array(
		'mb_order' => array( 'type' => 'number', 'label' => __( 'Order', 'maison-belle-core' ), 'help' => __( 'Smaller numbers come first (1, 2, 3 ...).', 'maison-belle-core' ) ),
		'mb_short' => array( 'type' => 'text', 'label' => __( 'Short tagline', 'maison-belle-core' ), 'help' => __( 'Shown on the home page card.', 'maison-belle-core' ) ),
		'mb_blurb' => array( 'type' => 'textarea', 'label' => __( 'Description', 'maison-belle-core' ), 'help' => __( 'Shown at the top of the category on the Services page.', 'maison-belle-core' ) ),
		'mb_icon'  => array( 'type' => 'select', 'label' => __( 'Icon', 'maison-belle-core' ), 'options' => mb_icon_choices(), 'default' => 'sparkle' ),
		'mb_image' => array( 'type' => 'media', 'label' => __( 'Photo', 'maison-belle-core' ), 'help' => __( 'Portrait photo (3:4). Leave empty to show the elegant placeholder.', 'maison-belle-core' ) ),
		'mb_alt'   => array( 'type' => 'text', 'label' => __( 'Photo description (alt text)', 'maison-belle-core' ) ),
		'mb_tone'  => array( 'type' => 'select', 'label' => __( 'Placeholder colour', 'maison-belle-core' ), 'options' => mb_tone_choices(), 'default' => 'blush' ),
	);
}

/**
 * Fields on the "Add category" form.
 */
function mb_service_cat_add_form() {
	wp_nonce_field( 'mb_save_term', 'mb_term_nonce' );
	foreach ( mb_service_cat_fields() as $key => $field ) {
		echo '<div class="form-field"><label for="' . esc_attr( $key ) . '">' . esc_html( $field['label'] ) . '</label>';
		mb_render_field( $key, $field, isset( $field['default'] ) ? $field['default'] : '', $key );
		if ( ! empty( $field['help'] ) ) {
			echo '<p>' . esc_html( $field['help'] ) . '</p>';
		}
		echo '</div>';
	}
}
add_action( 'mb_service_cat_add_form_fields', 'mb_service_cat_add_form' );

/**
 * Fields on the "Edit category" form.
 *
 * @param WP_Term $term Term being edited.
 */
function mb_service_cat_edit_form( $term ) {
	wp_nonce_field( 'mb_save_term', 'mb_term_nonce' );
	foreach ( mb_service_cat_fields() as $key => $field ) {
		$value = get_term_meta( $term->term_id, $key, true );
		if ( '' === $value && isset( $field['default'] ) ) {
			$value = $field['default'];
		}
		echo '<tr class="form-field"><th scope="row"><label for="' . esc_attr( $key ) . '">' . esc_html( $field['label'] ) . '</label></th><td>';
		mb_render_field( $key, $field, $value, $key );
		if ( ! empty( $field['help'] ) ) {
			echo '<p class="description">' . esc_html( $field['help'] ) . '</p>';
		}
		echo '</td></tr>';
	}
}
add_action( 'mb_service_cat_edit_form_fields', 'mb_service_cat_edit_form' );

/**
 * Save the extra category fields.
 *
 * @param int $term_id Term ID.
 */
function mb_service_cat_save( $term_id ) {
	if ( ! isset( $_POST['mb_term_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['mb_term_nonce'] ) ), 'mb_save_term' ) ) {
		return;
	}
	if ( ! current_user_can( 'manage_categories' ) ) {
		return;
	}
	foreach ( mb_service_cat_fields() as $key => $field ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_term_meta( $term_id, $key, mb_sanitize_field_value( $field, $_POST[ $key ] ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		}
	}
}
add_action( 'created_mb_service_cat', 'mb_service_cat_save' );
add_action( 'edited_mb_service_cat', 'mb_service_cat_save' );

<?php
/**
 * Contact Form 7 front-end handling: load its script only where the form appears.
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

/**
 * Only load CF7's JavaScript on pages that print the contact form.
 * The core plugin already switches off CF7's stylesheet.
 *
 * @param bool $load Whether to load.
 * @return bool
 */
function mb_child_cf7_load_js( $load ) {
	return is_page_template( 'templates/contact.php' ) ? $load : false;
}
add_filter( 'wpcf7_load_js', 'mb_child_cf7_load_js' );

/**
 * Print the salon contact form, or a friendly notice for admins if it is missing.
 */
function mb_contact_form() {
	$id = (int) mb_s( 'contact_form_id', 0 );
	if ( $id && shortcode_exists( 'contact-form-7' ) ) {
		echo do_shortcode( '[contact-form-7 id="' . $id . '" html_class="mb-form"]' );
		return;
	}
	if ( current_user_can( 'manage_options' ) ) {
		echo '<p class="mb-form-notice">' . esc_html__( 'Admin notice: install and activate Contact Form 7, then set the form ID under Salon Settings → Contact, hours & booking.', 'maison-belle-child' ) . '</p>';
	} else {
		echo '<p class="mb-form-notice">' . esc_html__( 'Please call us or email to get in touch.', 'maison-belle-child' ) . '</p>';
	}
}

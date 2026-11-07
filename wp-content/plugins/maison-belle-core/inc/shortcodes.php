<?php
/**
 * Shortcodes so editors can reuse salon details inside any page or post.
 *
 * [mb_phone]  [mb_email]  [mb_address]  [mb_hours]  [mb_booking_url]  [mb_book_button label="Book now"]
 *
 * @package MaisonBelleCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the shortcodes.
 */
function mb_register_shortcodes() {
	add_shortcode(
		'mb_phone',
		function () {
			return '<a href="' . esc_url( 'tel:' . mb_phone_tel() ) . '">' . esc_html( mb_get_setting( 'phone' ) ) . '</a>';
		}
	);
	add_shortcode(
		'mb_email',
		function () {
			$email = (string) mb_get_setting( 'email' );
			return '<a href="' . esc_url( 'mailto:' . $email ) . '">' . esc_html( $email ) . '</a>';
		}
	);
	add_shortcode(
		'mb_address',
		function () {
			return esc_html( mb_full_address() );
		}
	);
	add_shortcode(
		'mb_hours',
		function () {
			$out = '<ul class="mb-shortcode-hours">';
			foreach ( mb_get_hours() as $row ) {
				$out .= '<li>' . esc_html( $row['label'] ) . ': ' . esc_html( $row['time'] ) . '</li>';
			}
			return $out . '</ul>';
		}
	);
	add_shortcode(
		'mb_booking_url',
		function () {
			return esc_url( mb_booking_url() );
		}
	);
	add_shortcode(
		'mb_book_button',
		function ( $atts ) {
			$atts = shortcode_atts( array( 'label' => mb_get_setting( 'book_label' ) ), $atts, 'mb_book_button' );
			return '<a class="btn btn-primary" href="' . esc_url( mb_booking_url() ) . '" target="_blank" rel="noopener noreferrer">' . esc_html( $atts['label'] ) . '</a>';
		}
	);
}
add_action( 'init', 'mb_register_shortcodes' );

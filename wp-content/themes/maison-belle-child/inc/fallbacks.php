<?php
/**
 * Safety net: if the Maison Belle Core plugin is deactivated, the theme still renders
 * (with empty content) instead of crashing, and an admin notice explains what to do.
 *
 * The stand-in functions are only defined right before a front-end page renders
 * (template_redirect). They are never defined in the dashboard, REST or CLI requests,
 * so re-activating the plugin can never hit a "cannot redeclare function" error.
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

/**
 * Tell administrators the content plugin is missing.
 */
function mb_child_missing_core_notice() {
	if ( ! function_exists( 'mb_get_settings' ) && current_user_can( 'activate_plugins' ) ) {
		echo '<div class="notice notice-error"><p>' . esc_html__( 'Maison Belle Child needs the "Maison Belle Core" plugin for the salon content. Please activate it under Plugins.', 'maison-belle-child' ) . '</p></div>';
	}
}
add_action( 'admin_notices', 'mb_child_missing_core_notice' );

/**
 * Define minimal stand-ins for the core plugin's template functions.
 */
function mb_child_define_fallbacks() {
	if ( function_exists( 'mb_get_setting' ) ) {
		return; // The plugin is active: nothing to do.
	}
	function mb_get_setting( $key, $default = '' ) { return $default; } // phpcs:ignore
	function mb_phone_tel() { return ''; } // phpcs:ignore
	function mb_full_address() { return ''; } // phpcs:ignore
	function mb_maps_url() { return '#'; } // phpcs:ignore
	function mb_map_embed_url() { return ''; } // phpcs:ignore
	function mb_booking_url() { return '#'; } // phpcs:ignore
	function mb_get_hours() { return array(); } // phpcs:ignore
	function mb_get_socials() { return array(); } // phpcs:ignore
	function mb_get_service_categories() { return array(); } // phpcs:ignore
	function mb_get_services_menu() { return array(); } // phpcs:ignore
	function mb_get_gallery_items( $limit = -1 ) { return array(); } // phpcs:ignore
	function mb_get_gallery_categories() { return array(); } // phpcs:ignore
	function mb_get_reviews() { return array(); } // phpcs:ignore
	function mb_get_promotions() { return array(); } // phpcs:ignore
	function mb_format_price( $price ) { return (string) $price; } // phpcs:ignore
	function mb_lines( $value ) { return array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) $value ) ), 'strlen' ) ); } // phpcs:ignore
}
add_action( 'template_redirect', 'mb_child_define_fallbacks', 1 );

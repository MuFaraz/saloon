<?php
/**
 * Inline SVG icon set (decorative glyphs, UI icons, social marks).
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

/**
 * Raw SVG inner markup for each icon.
 *
 * @return array<string,string>
 */
function mb_icon_paths() {
	static $paths = null;
	if ( null !== $paths ) {
		return $paths;
	}
	$paths = array(
		// Decorative service / brand glyphs.
		'bottle'    => '<path d="M9.5 2.5h5v4h-5z"/><path d="M8 6.5h8l1.5 3v9a2.5 2.5 0 0 1-2.5 2.5H9A2.5 2.5 0 0 1 6.5 18.5v-9z"/><path d="M9.5 13.5c1.5-1 3.5 1 5 0"/>',
		'hand'      => '<path d="M8 13V6.5a1.5 1.5 0 0 1 3 0V12"/><path d="M11 11V4.5a1.5 1.5 0 0 1 3 0V12"/><path d="M14 12V6.5a1.5 1.5 0 0 1 3 0v8c0 4-2.5 6.5-6 6.5s-5-2-6.5-5L3 12.5a1.5 1.5 0 0 1 2.5-1.5L8 13"/>',
		'foot'      => '<path d="M9 21c-2 0-3-1.5-3-3.5 0-2 .8-3.5 1.5-5.5C8.5 9 9 6 11.5 5c2.5-1 3.5 1 3.5 3 0 2-.5 3.5-.5 5.5 0 2 1 3 1 4.5 0 2-2.5 3-6.5 3z"/><circle cx="17.5" cy="6" r="1"/><circle cx="19.5" cy="9" r="0.9"/><circle cx="20" cy="12.5" r="0.8"/>',
		'lash'      => '<path d="M2.5 13s3.5-6 9.5-6 9.5 6 9.5 6-3.5 5.5-9.5 5.5S2.5 13 2.5 13z"/><circle cx="12" cy="13" r="2.8"/><path d="M12 2.5v2.5M5.5 5l1.3 2M18.5 5l-1.3 2M2.5 8.5l1.8 1.2M21.5 8.5l-1.8 1.2"/>',
		'wax'       => '<path d="M4.5 19.5C4.5 10.5 10 4.5 20 4c0 10-5.5 15.5-15.5 15.5z"/><path d="M4 20c3-5.5 6-8.5 10.5-11"/>',
		'sparkle'   => '<path d="M12 3c.6 4.2 2.8 6.4 7 7-4.2.6-6.4 2.8-7 7-.6-4.2-2.8-6.4-7-7 4.2-.6 6.4-2.8 7-7z"/><path d="M19 15.5c.2 1.4 1 2.2 2.3 2.5-1.3.3-2.1 1.1-2.3 2.5-.2-1.4-1-2.2-2.3-2.5 1.3-.3 2.1-1.1 2.3-2.5z"/>',
		'flower'    => '<path d="M12 20.5c-4.5 0-7.5-3.2-7.5-8 3.2 0 5.8 1.5 7.5 4.2 1.7-2.7 4.3-4.2 7.5-4.2 0 4.8-3 8-7.5 8z"/><path d="M12 16.5c-2.2-2.2-2.7-6-0-11.5 2.7 5.5 2.2 9.3 0 11.5z"/>',
		'gem'       => '<path d="M6.5 4h11l4 5.2L12 20.5 2.5 9.2z"/><path d="M2.5 9.2h19M9.5 4 7.5 9.2 12 20.5l4.5-11.3L14.5 4"/>',
		// UI icons.
		'phone'     => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2z"/>',
		'pin'       => '<path d="M12 21s-7-6.2-7-11.5A7 7 0 0 1 19 9.5C19 14.8 12 21 12 21z"/><circle cx="12" cy="9.5" r="2.5"/>',
		'clock'     => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
		'mail'      => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m4 7 8 6 8-6"/>',
		'arrow'     => '<path d="M4 12h16M14 6l6 6-6 6"/>',
		'chevron'   => '<path d="m9 5 7 7-7 7"/>',
		'close'     => '<path d="M5 5l14 14M19 5 5 19"/>',
		'menu'      => '<path d="M4 8h16M4 16h10"/>',
		'check'     => '<path d="m5 12.5 4.5 4.5L19 7.5"/>',
		// Brand marks.
		'instagram' => '<rect x="3.5" y="3.5" width="17" height="17" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17" cy="7" r=".6" fill="currentColor"/>',
		'facebook'  => '<path d="M14 8.5h2.5V5H14a3.5 3.5 0 0 0-3.5 3.5V11H8v3.5h2.5V21H14v-6.5h2.5L17 11h-3V8.5z"/>',
		'google'    => '<path d="M20 12.2c0-.6 0-1.1-.2-1.7H12v3.2h4.6A4 4 0 0 1 14.9 16l2.6 2c1.5-1.4 2.5-3.5 2.5-5.8z"/><path d="M12 20.5c2.2 0 4-.7 5.5-2l-2.6-2c-.7.5-1.7.8-2.9.8a5.3 5.3 0 0 1-5-3.6l-2.7 2A8.5 8.5 0 0 0 12 20.5z"/><path d="M7 13.7a5.3 5.3 0 0 1 0-3.4l-2.7-2a8.5 8.5 0 0 0 0 7.4z"/><path d="M12 6.8c1.2 0 2.3.4 3.1 1.2l2.3-2.3A8.2 8.2 0 0 0 12 3.5a8.5 8.5 0 0 0-7.7 4.8l2.7 2A5.3 5.3 0 0 1 12 6.8z"/>',
		'yelp'      => '<path d="M12 3.5v8M12 11.5l-6 2.5M12 11.5l5.5 3M12 11.5l4-6M12 11.5l-3.5 5.5"/><circle cx="12" cy="11.5" r="1.2" fill="currentColor"/>',
	);
	return $paths;
}

/**
 * Return an outline icon as an SVG string.
 *
 * @param string $name  Icon key.
 * @param string $class CSS classes (sizing is done in CSS, e.g. "ico ico--md").
 * @param float  $stroke Stroke width (design default 1.2).
 * @return string Safe SVG markup (built from the fixed list above).
 */
function mb_icon( $name, $class = 'ico', $stroke = 1.2 ) {
	$paths = mb_icon_paths();
	if ( ! isset( $paths[ $name ] ) ) {
		return '';
	}
	return sprintf(
		'<svg class="%s" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="%s" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">%s</svg>',
		esc_attr( $class ),
		esc_attr( (string) $stroke ),
		$paths[ $name ] // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static markup defined above.
	);
}

/**
 * Filled star.
 *
 * @param string $class CSS classes.
 * @return string
 */
function mb_star_icon( $class = 'ico' ) {
	return '<svg class="' . esc_attr( $class ) . '" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="m12 2.5 2.9 6.1 6.6.8-4.9 4.6 1.3 6.6L12 17.3l-5.9 3.3 1.3-6.6L2.5 9.4l6.6-.8z"/></svg>';
}

/**
 * Quote mark.
 *
 * @param string $class CSS classes.
 * @return string
 */
function mb_quote_icon( $class = 'ico' ) {
	return '<svg class="' . esc_attr( $class ) . '" viewBox="0 0 48 36" fill="currentColor" aria-hidden="true" focusable="false"><path d="M0 36V21.6C0 9.4 6.6 2 18.6 0l1.8 4.8C13.8 6.8 11 10.4 10.8 15.6H20V36zm26.4 0V21.6C26.4 9.4 33 2 45 0l1.8 4.8c-6.6 2-9.4 5.6-9.6 10.8H46.4V36z"/></svg>';
}

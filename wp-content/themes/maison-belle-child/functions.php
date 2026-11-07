<?php
/**
 * Maison Belle Child: bootstrap.
 *
 * Kept deliberately tiny. Each concern lives in its own file under /inc.
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

define( 'MB_CHILD_VERSION', '1.0.0' );

$mb_child_includes = array(
	'fallbacks',      // Stand-ins if the core plugin is switched off.
	'setup',          // Theme supports, menus, image sizes.
	'enqueue',        // Styles, scripts, font preloads, head clean-up.
	'customizer',     // Colour and font pickers -> CSS variables.
	'icons',          // Inline SVG icon set.
	'images',         // Media-library image with elegant placeholder fallback.
	'template-tags',  // Buttons, headings, hours, page hero, CTA banner...
	'nav-walker',     // Menu markup matching the design.
	'forms',          // Contact Form 7 front-end tweaks.
);

foreach ( $mb_child_includes as $mb_child_file ) {
	require_once get_stylesheet_directory() . '/inc/' . $mb_child_file . '.php';
}
unset( $mb_child_includes, $mb_child_file );

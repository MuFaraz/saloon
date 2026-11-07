<?php
/**
 * Theme setup: supports, menu locations, image sizes.
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register theme features.
 */
function mb_child_setup() {
	load_child_theme_textdomain( 'maison-belle-child', get_stylesheet_directory() . '/languages' );

	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'responsive-embeds' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary menu (header)', 'maison-belle-child' ),
			'footer'  => __( 'Footer menu', 'maison-belle-child' ),
		)
	);
}
add_action( 'after_setup_theme', 'mb_child_setup', 20 );

/**
 * Social card size for Open Graph previews.
 */
function mb_child_image_sizes() {
	add_image_size( 'mb-og', 1200, 630, true );
}
add_action( 'after_setup_theme', 'mb_child_image_sizes' );

/**
 * Clean <body> classes: add a hook for page-specific styling, drop nothing the parent needs.
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function mb_child_body_class( $classes ) {
	$classes[] = 'mb-site';
	return $classes;
}
add_filter( 'body_class', 'mb_child_body_class' );

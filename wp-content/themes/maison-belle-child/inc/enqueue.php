<?php
/**
 * Front-end assets: CSS, JS, font preloads and head clean-up.
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

/**
 * Version string = file modification time, so a change is never cached.
 *
 * @param string $relative Path inside the child theme.
 * @return string
 */
function mb_child_asset_version( $relative ) {
	$path = get_stylesheet_directory() . '/' . ltrim( $relative, '/' );
	return file_exists( $path ) ? (string) filemtime( $path ) : MB_CHILD_VERSION;
}

/**
 * Use the minified build (main.min.css / main.min.js) when it exists and is not older than
 * the readable source. Edit main.css or main.js freely: a stale .min file is ignored
 * automatically, and defining SCRIPT_DEBUG in wp-config.php always serves the source.
 *
 * @param string $relative Source path inside the child theme, e.g. assets/css/main.css.
 * @return string Path to load.
 */
function mb_child_asset_path( $relative ) {
	$dir = get_stylesheet_directory();
	$min = preg_replace( '/\.(css|js)$/', '.min.$1', $relative );
	if ( ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) || ! file_exists( $dir . '/' . $min ) || filemtime( $dir . '/' . $min ) < filemtime( $dir . '/' . $relative ) ) {
		return $relative;
	}
	return $min;
}

/**
 * Enqueue styles and scripts.
 */
function mb_child_enqueue() {
	$uri = get_stylesheet_directory_uri();

	/**
	 * Filter: load the GeneratePress stylesheet as well. Off by default, because the
	 * approved design is fully styled by main.css and the parent CSS would only add
	 * weight and conflicting defaults. The parent theme still provides updates,
	 * hooks, the Customizer framework and the fallback templates.
	 */
	$load_parent_css = (bool) apply_filters( 'mb_child_load_parent_css', false );
	if ( ! $load_parent_css ) {
		wp_dequeue_style( 'generate-style' );
		wp_dequeue_style( 'generate-child' );
		wp_dequeue_style( 'generate-widget-areas' );
		wp_dequeue_style( 'generate-font-icons' );
		wp_dequeue_style( 'generate-google-fonts' );
	}

	$css = mb_child_asset_path( 'assets/css/main.css' );
	wp_enqueue_style( 'mb-main', $uri . '/' . $css, array(), mb_child_asset_version( $css ) );

	// Extra bundled fonts only load when chosen in the Customizer.
	foreach ( mb_child_selected_font_files() as $handle => $file ) {
		wp_enqueue_style( $handle, $uri . '/assets/css/' . $file, array( 'mb-main' ), mb_child_asset_version( 'assets/css/' . $file ) );
	}

	$js = mb_child_asset_path( 'assets/js/main.js' );
	wp_enqueue_script(
		'mb-main',
		$uri . '/' . $js,
		array(),
		mb_child_asset_version( $js ),
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);

	// Block styles are only needed where blog / page content is rendered by the editor.
	// Only single articles and plain (template-less) pages print editor blocks.
	$needs_blocks = is_singular( 'post' ) || ( is_page() && ! is_front_page() && ! is_page_template() );
	if ( ! $needs_blocks ) {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
	}
	wp_dequeue_style( 'classic-theme-styles' );
	wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'mb_child_enqueue', 100 );

/**
 * Remove the inline global-styles block (not used by this theme).
 */
remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

/**
 * Drop GeneratePress front-end scripts (its own menu, search modal...): this theme has its own.
 */
function mb_child_dequeue_parent_scripts() {
	foreach ( array( 'generate-menu', 'generate-dropdown-click', 'generate-modal', 'generate-navigation-search', 'generate-back-to-top' ) as $handle ) {
		wp_dequeue_script( $handle );
	}
}
add_action( 'wp_enqueue_scripts', 'mb_child_dequeue_parent_scripts', 100 );

/**
 * Remove layout classes added by GeneratePress (they only matter when its CSS is loaded).
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function mb_child_clean_body_class( $classes ) {
	if ( apply_filters( 'mb_child_load_parent_css', false ) ) {
		return $classes;
	}
	$drop = array( 'right-sidebar', 'left-sidebar', 'both-sidebars', 'no-sidebar', 'nav-float-right', 'nav-float-left', 'separate-containers', 'one-container', 'header-aligned-left', 'header-aligned-right', 'header-aligned-center', 'dropdown-hover', 'dropdown-click', 'nav-below-header', 'nav-above-header' );
	return array_values( array_diff( $classes, $drop ) );
}
add_filter( 'body_class', 'mb_child_clean_body_class', 100 );

/**
 * Preload the two primary fonts so text never waits on the stylesheet.
 */
function mb_child_preload_fonts() {
	if ( 'cormorant' !== mb_child_get_mod( 'mb_font_display' ) && 'jost' !== mb_child_get_mod( 'mb_font_body' ) ) {
		return;
	}
	$uri   = get_stylesheet_directory_uri() . '/assets/fonts/';
	$files = array();
	if ( 'cormorant' === mb_child_get_mod( 'mb_font_display' ) ) {
		$files[] = 'cormorant-garamond-normal.woff2';
		$files[] = 'cormorant-garamond-italic.woff2';
	}
	if ( 'jost' === mb_child_get_mod( 'mb_font_body' ) ) {
		$files[] = 'jost.woff2';
	}
	foreach ( $files as $file ) {
		printf( '<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n", esc_url( $uri . $file ) );
	}
}
add_action( 'wp_head', 'mb_child_preload_fonts', 1 );

/**
 * Tell the browser the page is JS-ready only for the reveal animation. Without JS
 * (or with reduced motion) content stays fully visible.
 */
function mb_child_noscript_style() {
	echo '<noscript><style>.reveal,.hero-in{opacity:1!important;transform:none!important;animation:none!important}</style></noscript>' . "\n";
}
add_action( 'wp_head', 'mb_child_noscript_style', 2 );

/**
 * Head clean-up: emoji script and other legacy extras nobody needs here.
 */
function mb_child_head_cleanup() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
}
add_action( 'init', 'mb_child_head_cleanup' );
add_filter( 'the_generator', '__return_empty_string' );

/**
 * Theme colour for mobile browser chrome.
 */
function mb_child_theme_color() {
	printf( '<meta name="theme-color" content="%s">' . "\n", esc_attr( mb_child_get_mod( 'mb_color_bg' ) ) );
}
add_action( 'wp_head', 'mb_child_theme_color', 3 );

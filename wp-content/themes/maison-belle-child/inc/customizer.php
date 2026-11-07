<?php
/**
 * Customizer: brand colours and font choices that output CSS variables.
 *
 * Defaults equal the approved design, in which case nothing extra is printed.
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

/**
 * Default values for every theme mod.
 *
 * @return array<string,string>
 */
function mb_child_defaults() {
	return array(
		'mb_color_primary' => '#7a3e4b',
		'mb_color_accent'  => '#b8935a',
		'mb_color_bg'      => '#fbf7f4',
		'mb_color_text'    => '#2a2224',
		'mb_color_blush'   => '#f3dcd9',
		'mb_font_display'  => 'cormorant',
		'mb_font_body'     => 'jost',
	);
}

/**
 * Read a theme mod with the design default.
 *
 * @param string $key Mod name.
 * @return string
 */
function mb_child_get_mod( $key ) {
	$defaults = mb_child_defaults();
	return (string) get_theme_mod( $key, isset( $defaults[ $key ] ) ? $defaults[ $key ] : '' );
}

/**
 * Font stacks.
 *
 * @return array{display:array<string,array>,body:array<string,array>}
 */
function mb_child_font_options() {
	return array(
		'display' => array(
			'cormorant' => array( 'label' => 'Cormorant Garamond (design default)', 'stack' => '"Cormorant Garamond", Georgia, serif', 'file' => '' ),
			'playfair'  => array( 'label' => 'Playfair Display', 'stack' => '"Playfair Display", Georgia, serif', 'file' => 'font-playfair.css' ),
			'georgia'   => array( 'label' => 'Georgia (system, fastest)', 'stack' => 'Georgia, "Times New Roman", serif', 'file' => '' ),
		),
		'body'    => array(
			'jost'    => array( 'label' => 'Jost (design default)', 'stack' => '"Jost", system-ui, sans-serif', 'file' => '' ),
			'dm-sans' => array( 'label' => 'DM Sans', 'stack' => '"DM Sans", system-ui, sans-serif', 'file' => 'font-dm-sans.css' ),
			'system'  => array( 'label' => 'System font (fastest)', 'stack' => 'system-ui, -apple-system, "Segoe UI", Roboto, sans-serif', 'file' => '' ),
		),
	);
}

/**
 * Extra font stylesheets needed for the current choice: handle => file.
 *
 * @return array<string,string>
 */
function mb_child_selected_font_files() {
	$opts  = mb_child_font_options();
	$files = array();
	$d     = mb_child_get_mod( 'mb_font_display' );
	$b     = mb_child_get_mod( 'mb_font_body' );
	if ( ! empty( $opts['display'][ $d ]['file'] ) ) {
		$files['mb-font-display'] = $opts['display'][ $d ]['file'];
	}
	if ( ! empty( $opts['body'][ $b ]['file'] ) ) {
		$files['mb-font-body'] = $opts['body'][ $b ]['file'];
	}
	return $files;
}

/**
 * Register Customizer controls.
 *
 * @param WP_Customize_Manager $wp_customize Manager.
 */
function mb_child_customize_register( $wp_customize ) {
	$defaults = mb_child_defaults();

	$wp_customize->add_section(
		'mb_brand',
		array(
			'title'       => __( 'Salon colours & fonts', 'maison-belle-child' ),
			'description' => __( 'Change the brand look. Other shades (hover, dark, soft backgrounds) follow automatically.', 'maison-belle-child' ),
			'priority'    => 30,
		)
	);

	$colors = array(
		'mb_color_primary' => __( 'Primary (buttons, links)', 'maison-belle-child' ),
		'mb_color_accent'  => __( 'Accent (gold lines)', 'maison-belle-child' ),
		'mb_color_bg'      => __( 'Page background', 'maison-belle-child' ),
		'mb_color_text'    => __( 'Text', 'maison-belle-child' ),
		'mb_color_blush'   => __( 'Soft blush panels', 'maison-belle-child' ),
	);
	foreach ( $colors as $id => $label ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $defaults[ $id ],
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'refresh',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, array( 'label' => $label, 'section' => 'mb_brand' ) ) );
	}

	$fonts = mb_child_font_options();
	foreach ( array( 'mb_font_display' => 'display', 'mb_font_body' => 'body' ) as $id => $group ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $defaults[ $id ],
				'sanitize_callback' => function ( $value ) use ( $fonts, $group, $id, $defaults ) {
					return isset( $fonts[ $group ][ $value ] ) ? $value : $defaults[ $id ];
				},
			)
		);
		$wp_customize->add_control(
			$id,
			array(
				'type'    => 'select',
				'section' => 'mb_brand',
				'label'   => 'display' === $group ? __( 'Heading font', 'maison-belle-child' ) : __( 'Body font', 'maison-belle-child' ),
				'choices' => wp_list_pluck( $fonts[ $group ], 'label' ),
			)
		);
	}
}
add_action( 'customize_register', 'mb_child_customize_register' );

/**
 * Darken or mix a hex colour.
 *
 * @param string $hex    Source colour (#rrggbb).
 * @param string $mix    Colour to mix toward.
 * @param float  $amount 0..1 share of $mix.
 * @return string
 */
function mb_child_mix( $hex, $mix, $amount ) {
	$a = sscanf( ltrim( $hex, '#' ), '%2x%2x%2x' );
	$b = sscanf( ltrim( $mix, '#' ), '%2x%2x%2x' );
	$o = '#';
	for ( $i = 0; $i < 3; $i++ ) {
		$o .= str_pad( dechex( (int) round( $a[ $i ] * ( 1 - $amount ) + $b[ $i ] * $amount ) ), 2, '0', STR_PAD_LEFT );
	}
	return $o;
}

/**
 * Print CSS variables for anything the owner changed.
 */
function mb_child_output_vars() {
	$defaults = mb_child_defaults();
	$vars     = array();

	$primary = mb_child_get_mod( 'mb_color_primary' );
	if ( strtolower( $primary ) !== $defaults['mb_color_primary'] ) {
		$vars['--rose']      = $primary;
		$vars['--rose-deep'] = mb_child_mix( $primary, '#000000', 0.23 );
	}
	$accent = mb_child_get_mod( 'mb_color_accent' );
	if ( strtolower( $accent ) !== $defaults['mb_color_accent'] ) {
		$vars['--gold']      = $accent;
		$vars['--gold-deep'] = mb_child_mix( $accent, '#000000', 0.42 );
	}
	$bg = mb_child_get_mod( 'mb_color_bg' );
	if ( strtolower( $bg ) !== $defaults['mb_color_bg'] ) {
		$vars['--ivory'] = $bg;
		$vars['--sand']  = mb_child_mix( $bg, '#c9a98f', 0.12 );
	}
	$text = mb_child_get_mod( 'mb_color_text' );
	if ( strtolower( $text ) !== $defaults['mb_color_text'] ) {
		$vars['--ink']   = $text;
		$vars['--muted'] = mb_child_mix( $text, $bg, 0.3 );
	}
	$blush = mb_child_get_mod( 'mb_color_blush' );
	if ( strtolower( $blush ) !== $defaults['mb_color_blush'] ) {
		$vars['--blush'] = $blush;
	}

	$fonts = mb_child_font_options();
	$d     = mb_child_get_mod( 'mb_font_display' );
	$b     = mb_child_get_mod( 'mb_font_body' );
	if ( 'cormorant' !== $d && isset( $fonts['display'][ $d ] ) ) {
		$vars['--font-display'] = $fonts['display'][ $d ]['stack'];
	}
	if ( 'jost' !== $b && isset( $fonts['body'][ $b ] ) ) {
		$vars['--font-sans'] = $fonts['body'][ $b ]['stack'];
	}

	if ( ! $vars ) {
		return;
	}
	$css = ':root{';
	foreach ( $vars as $name => $value ) {
		$css .= $name . ':' . $value . ';';
	}
	echo '<style id="mb-custom-vars">' . wp_strip_all_tags( $css . '}' ) . "</style>\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- values are validated hex colours or fixed font stacks.
}
add_action( 'wp_head', 'mb_child_output_vars', 20 );

<?php
/**
 * The one image primitive of the theme.
 *
 * Every picture slot calls mb_image(). With a media-library attachment it prints a
 * responsive, lazy-loaded <img> (srcset + width/height from WordPress). With no
 * attachment it prints the design's elegant gradient + pattern + icon placeholder
 * as inline HTML/SVG. Adding a photo later therefore never changes the layout.
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

/**
 * Placeholder tones: gradient and whether the tone is dark (light icon).
 *
 * @return array<string,array>
 */
function mb_tone_styles() {
	return array(
		'blush' => array( 'bg' => 'linear-gradient(160deg,#fbeeea 0%,#f3dcd9 55%,#e8c3c0 100%)', 'dark' => false ),
		'ivory' => array( 'bg' => 'linear-gradient(160deg,#ffffff 0%,#f6ece4 60%,#ead9cd 100%)', 'dark' => false ),
		'gold'  => array( 'bg' => 'linear-gradient(160deg,#f1e2c4 0%,#dcc08c 55%,#c19b61 100%)', 'dark' => false ),
		'mauve' => array( 'bg' => 'linear-gradient(160deg,#e6cbcd 0%,#c9a0a7 55%,#a97783 100%)', 'dark' => true ),
		'rose'  => array( 'bg' => 'linear-gradient(160deg,#a56270 0%,#7a3e4b 55%,#552632 100%)', 'dark' => true ),
	);
}

/**
 * Pattern class for each icon.
 *
 * @param string $icon Icon key.
 * @return string
 */
function mb_pattern_for_icon( $icon ) {
	$map = array(
		'bottle'  => 'pat-lines',
		'hand'    => 'pat-lines',
		'foot'    => 'pat-dots',
		'flower'  => 'pat-dots',
		'lash'    => 'pat-grid',
		'wax'     => 'pat-grid',
		'sparkle' => 'pat-dots',
		'gem'     => 'pat-lines',
	);
	return isset( $map[ $icon ] ) ? $map[ $icon ] : 'pat-lines';
}

/**
 * Output (or return) an image slot.
 *
 * @param array $args {
 *     @type int    $id        Attachment ID (0 = placeholder).
 *     @type string $alt       Alt text / aria-label.
 *     @type string $tone      Placeholder tone: blush|rose|gold|ivory|mauve.
 *     @type string $icon      Placeholder icon key.
 *     @type string $shape     arch|arch-soft|rounded|pill|circle|square.
 *     @type string $class     Extra classes for the frame (size / aspect ratio / shadow).
 *     @type string $sizes     "sizes" attribute for real images.
 *     @type bool   $priority  Above-the-fold image: eager + high fetch priority.
 *     @type bool   $zoom      Slow zoom when the frame / a parent card is hovered.
 *     @type string $icon_size "mobile,desktop" icon size, e.g. "3rem,4rem".
 *     @type bool   $echo      Echo (default) or return.
 * }
 * @return string|void
 */
function mb_image( $args = array() ) {
	$a = wp_parse_args(
		$args,
		array(
			'id'        => 0,
			'alt'       => '',
			'tone'      => 'blush',
			'icon'      => 'sparkle',
			'shape'     => 'rounded',
			'class'     => '',
			'sizes'     => '(min-width: 1024px) 40vw, 90vw',
			'priority'  => false,
			'zoom'      => true,
			'icon_size' => '3rem,4rem',
			'echo'      => true,
		)
	);

	$tones = mb_tone_styles();
	$tone  = isset( $tones[ $a['tone'] ] ) ? $tones[ $a['tone'] ] : $tones['blush'];
	$frame = trim( 'si group si--' . $a['shape'] . ' ' . $a['class'] );
	$zoom  = $a['zoom'] ? ' si--zoom' : '';
	$id    = absint( $a['id'] );

	if ( $id && wp_attachment_is_image( $id ) ) {
		$attr = array(
			'class'    => 'si__img' . $zoom,
			'sizes'    => $a['sizes'],
			'loading'  => $a['priority'] ? 'eager' : 'lazy',
			'decoding' => 'async',
		);
		if ( $a['priority'] ) {
			$attr['fetchpriority'] = 'high';
		}
		// Prefer the description written in the media library; fall back to the slot's default.
		$media_alt  = (string) get_post_meta( $id, '_wp_attachment_image_alt', true );
		$attr['alt'] = '' !== $media_alt ? $media_alt : $a['alt'];
		$html = '<div class="' . esc_attr( $frame ) . '">' . wp_get_attachment_image( $id, 'large', false, $attr ) . '<span class="si__edge" aria-hidden="true"></span></div>';
	} else {
		$ring = $tone['dark'] ? 'si--on-dark' : '';
		$size = array_pad( explode( ',', $a['icon_size'] ), 2, '' );
		$html = sprintf(
			'<div role="img" aria-label="%1$s" class="%2$s %3$s" style="--ico:%4$s;--ico-md:%5$s"><div class="si__bg%6$s" style="background:%7$s"><div class="si__pattern %8$s"></div><div class="si__glow si__glow--light"></div><div class="si__glow si__glow--dark"></div></div><div class="si__inset"></div><div class="si__center"><span class="si__badge">%9$s</span></div></div>',
			esc_attr( $a['alt'] ),
			esc_attr( $frame ),
			esc_attr( $ring ),
			esc_attr( trim( $size[0] ) ),
			esc_attr( trim( $size[1] ) ? trim( $size[1] ) : trim( $size[0] ) ),
			esc_attr( $zoom ),
			esc_attr( $tone['bg'] ),
			esc_attr( mb_pattern_for_icon( $a['icon'] ) ),
			mb_icon( $a['icon'], 'si__icon', 0.9 ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG.
		);
	}

	if ( $a['echo'] ) {
		echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built from escaped parts above.
		return;
	}
	return $html;
}

/**
 * Image slot for a post: featured image or placeholder from the post's own options.
 *
 * @param int|WP_Post $post Post.
 * @param array       $args mb_image() args.
 * @return string|void
 */
function mb_post_image( $post, $args = array() ) {
	$post = get_post( $post );
	$args = wp_parse_args(
		$args,
		array(
			'alt'  => $post ? get_the_title( $post ) : '',
			'tone' => $post && get_post_meta( $post->ID, 'mb_tone', true ) ? get_post_meta( $post->ID, 'mb_tone', true ) : 'blush',
			'icon' => $post && get_post_meta( $post->ID, 'mb_icon', true ) ? get_post_meta( $post->ID, 'mb_icon', true ) : 'sparkle',
		)
	);
	$args['id'] = $post ? (int) get_post_thumbnail_id( $post ) : 0;
	return mb_image( $args );
}

<?php
/**
 * Small reusable output helpers used by the templates.
 *
 * Data comes from the Maison Belle Core plugin (mb_get_setting() etc.). If the
 * plugin is missing the helper functions below fail gracefully (see header.php).
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

/**
 * Is the core plugin active?
 *
 * @return bool
 */
function mb_core_active() {
	return function_exists( 'mb_get_setting' );
}

/**
 * Safe setting getter that works even if the core plugin is deactivated.
 *
 * @param string $key     Setting key.
 * @param string $default Fallback.
 * @return mixed
 */
function mb_s( $key, $default = '' ) {
	return mb_core_active() ? mb_get_setting( $key, $default ) : $default;
}

/**
 * Turn "word *emphasis*" into escaped HTML with <em>.
 *
 * @param string $text Text.
 * @return string
 */
function mb_em( $text ) {
	if ( function_exists( 'mb_emphasis' ) ) {
		return mb_emphasis( $text );
	}
	return preg_replace( '/\*([^*]+)\*/', '<em>$1</em>', esc_html( $text ) );
}

/**
 * Permalink of a page by its slug (falls back to /slug/).
 *
 * @param string $slug Page slug.
 * @return string
 */
function mb_page_url( $slug ) {
	$page = get_page_by_path( $slug );
	return $page ? get_permalink( $page ) : home_url( '/' . $slug . '/' );
}

/**
 * Inline style attribute that staggers a reveal animation.
 *
 * @param int $delay Milliseconds.
 * @return string
 */
function mb_delay( $delay = 0 ) {
	return $delay ? ' style="--d:' . (int) $delay . 'ms"' : '';
}

/**
 * Print a button / link styled as a button.
 *
 * @param array $args label, href, variant (primary|outline|light|ghost-light), size (md|sm), class, icon, external, type, attrs.
 */
function mb_button( $args = array() ) {
	$a = wp_parse_args(
		$args,
		array(
			'label'    => '',
			'href'     => '',
			'variant'  => 'primary',
			'size'     => 'md',
			'class'    => '',
			'icon'     => '',
			'external' => null,
			'attrs'    => array(),
		)
	);

	$class = trim( 'btn btn-' . $a['variant'] . ( 'sm' === $a['size'] ? ' btn-sm' : '' ) . ' ' . $a['class'] );
	// External = placeholder "#", or a web address on another site. Pages of this site open in the same tab.
	if ( null === $a['external'] ) {
		$host_here = wp_parse_url( home_url(), PHP_URL_HOST );
		$host_link = wp_parse_url( $a['href'], PHP_URL_HOST );
		$ext       = $host_link && $host_link !== $host_here;
	} else {
		$ext = (bool) $a['external'];
	}
	$attrs = '';
	if ( $ext && preg_match( '#^(https?:|\#)#', $a['href'] ) ) {
		$attrs .= ' target="_blank" rel="noopener noreferrer"';
	}
	foreach ( (array) $a['attrs'] as $name => $value ) {
		$attrs .= ' ' . esc_attr( $name ) . '="' . esc_attr( $value ) . '"';
	}
	printf(
		'<a href="%1$s" class="%2$s"%3$s>%4$s%5$s</a>',
		esc_url( $a['href'] ),
		esc_attr( $class ),
		$attrs, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built from escaped parts.
		$a['icon'], // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- trusted SVG from mb_icon().
		esc_html( $a['label'] )
	);
}

/**
 * The "Book Now" button: always the external booking URL, always a new tab.
 *
 * @param array $args mb_button() args (label defaults to the Salon Settings label).
 */
function mb_book_button( $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'label'    => mb_s( 'book_label', 'Book Now' ),
			'external' => true,
		)
	);
	$args['href'] = function_exists( 'mb_booking_url' ) ? mb_booking_url() : '#';
	// A real booking link opens in a new tab; the "#" placeholder stays on the page.
	if ( ! preg_match( '#^https?:#', $args['href'] ) ) {
		$args['external'] = false;
	}
	mb_button( $args );
}

/**
 * Click-to-call button.
 *
 * @param array $args mb_button() args.
 */
function mb_call_button( $args = array() ) {
	$args['href']     = 'tel:' . ( function_exists( 'mb_phone_tel' ) ? mb_phone_tel() : '' );
	$args['external'] = true;
	mb_button( $args );
}

/**
 * Section heading block (eyebrow, display title, optional intro).
 *
 * @param array $args eyebrow, title (supports *em*), intro (plain), intro_html (trusted HTML), align, dark, tag, class, delay.
 */
function mb_section_heading( $args = array() ) {
	$a = wp_parse_args(
		$args,
		array(
			'eyebrow'    => '',
			'title'      => '',
			'intro'      => '',
			'intro_html' => '',
			'align'      => 'center',
			'dark'       => false,
			'tag'        => 'h2',
			'class'      => '',
			'delay'      => 0,
		)
	);
	$center = 'center' === $a['align'];
	$tag    = in_array( $a['tag'], array( 'h1', 'h2' ), true ) ? $a['tag'] : 'h2';
	$class  = trim( 'reveal sec-head' . ( $center ? ' sec-head--center' : '' ) . ( $a['dark'] ? ' on-dark' : '' ) . ' ' . $a['class'] );

	echo '<div class="' . esc_attr( $class ) . '"' . mb_delay( $a['delay'] ) . '>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo '<span class="eyebrow' . ( $center ? ' eyebrow-center' : '' ) . '">' . esc_html( $a['eyebrow'] ) . '</span>';
	echo '<' . $tag . ' class="display-lg sec-head__title">' . mb_em( $a['title'] ) . '</' . $tag . '>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	if ( $a['intro_html'] ) {
		// "intro_html" is trusted markup built inside the theme from escaped parts (it may contain an SVG star, which wp_kses would strip).
		echo '<p class="sec-head__intro">' . $a['intro_html'] . '</p>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} elseif ( $a['intro'] ) {
		echo '<p class="sec-head__intro">' . esc_html( $a['intro'] ) . '</p>';
	}
	echo '</div>';
}

/**
 * Logo image or text wordmark.
 *
 * @param bool $light Light variant (for dark backgrounds).
 */
function mb_wordmark( $light = false ) {
	$logo = (int) mb_s( 'logo', 0 );
	if ( $logo && wp_attachment_is_image( $logo ) ) {
		echo wp_get_attachment_image( $logo, 'medium', false, array( 'class' => 'wordmark-img', 'alt' => mb_s( 'salon_name' ), 'loading' => 'eager', 'decoding' => 'async' ) );
		return;
	}
	echo '<span class="wordmark' . ( $light ? ' wordmark--light' : '' ) . '">';
	echo '<span class="wordmark__main">' . esc_html( mb_s( 'wordmark_main', get_bloginfo( 'name' ) ) ) . '</span>';
	$sub = mb_s( 'wordmark_sub' );
	if ( $sub ) {
		echo '<span class="wordmark__sub">' . esc_html( $sub ) . '</span>';
	}
	echo '</span>';
}

/**
 * Star rating (accessible).
 *
 * @param int    $count Stars (1-5).
 * @param string $class Icon class.
 */
function mb_stars( $count = 5, $class = 'ico ico--star' ) {
	echo '<span class="stars" role="img" aria-label="' . esc_attr( sprintf( /* translators: %d: star count. */ __( '%d out of 5 stars', 'maison-belle-child' ), $count ) ) . '">';
	for ( $i = 0; $i < $count; $i++ ) {
		echo mb_star_icon( $class ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG.
	}
	echo '</span>';
}

/**
 * Opening hours list with dotted leaders.
 *
 * @param bool $dark On a dark background.
 */
function mb_hours_list( $dark = false ) {
	$hours = function_exists( 'mb_get_hours' ) ? mb_get_hours() : array();
	echo '<ul class="hours' . ( $dark ? ' hours--dark' : '' ) . '">';
	foreach ( $hours as $row ) {
		echo '<li><span class="hours__label">' . esc_html( $row['label'] ) . '</span><span class="leader" aria-hidden="true"></span><span class="hours__time">' . esc_html( $row['time'] ) . '</span></li>';
	}
	echo '</ul>';
}

/**
 * Social icon links.
 *
 * @param string $list_class Class for the <ul>.
 * @param string $link_class Class for each <a>.
 */
function mb_social_links( $list_class, $link_class ) {
	$socials = function_exists( 'mb_get_socials' ) ? mb_get_socials() : array();
	if ( ! $socials ) {
		return;
	}
	echo '<ul class="' . esc_attr( $list_class ) . '">';
	foreach ( $socials as $name => $url ) {
		printf(
			'<li><a href="%1$s" target="_blank" rel="noopener noreferrer" aria-label="%2$s" class="%3$s">%4$s</a></li>',
			esc_url( $url ),
			/* translators: 1: salon short name, 2: network name. */
			esc_attr( sprintf( __( '%1$s on %2$s', 'maison-belle-child' ), mb_s( 'wordmark_main', get_bloginfo( 'name' ) ), $name ) ),
			esc_attr( $link_class ),
			mb_icon( strtolower( $name ), 'ico ico--md' ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG.
		);
	}
	echo '</ul>';
}

/**
 * Banner at the top of inner pages.
 *
 * @param string $eyebrow Small line.
 * @param string $title   Title, supports *em*.
 * @param string $intro   Intro paragraph.
 */
function mb_page_hero( $eyebrow, $title, $intro = '' ) {
	$eyebrow = (string) $eyebrow;
	?>
	<section class="page-hero">
		<div class="page-hero__deco" aria-hidden="true">
			<div class="page-hero__arch page-hero__arch--1 shape-arch"></div>
			<div class="page-hero__arch page-hero__arch--2 shape-arch"></div>
			<div class="page-hero__blob"></div>
		</div>
		<div class="container-x page-hero__inner">
			<?php if ( '' !== $eyebrow ) : ?>
				<p class="hero-in eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
			<?php endif; ?>
			<h1 class="display-xl hero-in page-hero__title" style="--i:1"><?php echo mb_em( $title ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h1>
			<?php if ( $intro ) : ?>
				<p class="hero-in page-hero__intro" style="--i:2"><?php echo esc_html( $intro ); ?></p>
			<?php endif; ?>
		</div>
		<div class="hairline"></div>
	</section>
	<?php
}

/**
 * Page banner for a WordPress page, using its "Page banner" meta box with fallbacks.
 *
 * @param array $fallback eyebrow, title, intro defaults.
 */
function mb_page_hero_for_page( $fallback = array() ) {
	$fallback = wp_parse_args( $fallback, array( 'eyebrow' => '', 'title' => get_the_title(), 'intro' => '' ) );
	$id       = get_queried_object_id();
	$eyebrow  = (string) get_post_meta( $id, 'mb_hero_eyebrow', true );
	$title    = (string) get_post_meta( $id, 'mb_hero_title', true );
	$intro    = (string) get_post_meta( $id, 'mb_hero_intro', true );
	mb_page_hero(
		'' !== $eyebrow ? $eyebrow : $fallback['eyebrow'],
		'' !== $title ? $title : $fallback['title'],
		'' !== $intro ? $intro : $fallback['intro']
	);
}

/**
 * Final call-to-action banner (text from Salon Settings).
 */
function mb_cta_banner() {
	?>
	<section class="cta on-dark" aria-labelledby="cta-title">
		<div class="cta__deco" aria-hidden="true">
			<div class="cta__arch cta__arch--1 shape-arch"></div>
			<div class="cta__arch cta__arch--2 shape-arch"></div>
			<div class="cta__blob"></div>
		</div>
		<div class="container-x cta__inner">
			<div class="reveal">
				<span class="eyebrow eyebrow-center"><?php echo esc_html( mb_s( 'cta_eyebrow' ) ); ?></span>
				<h2 id="cta-title" class="display-lg cta__title"><?php echo mb_em( mb_s( 'cta_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h2>
				<p class="cta__text"><?php echo esc_html( mb_s( 'cta_text' ) ); ?></p>
				<div class="cta__actions">
					<?php
					mb_book_button( array( 'variant' => 'light' ) );
					mb_call_button(
						array(
							'variant' => 'ghost-light',
							'label'   => mb_s( 'phone' ),
							'icon'    => mb_icon( 'phone', 'ico ico--sm' ),
						)
					);
					?>
				</div>
			</div>
		</div>
	</section>
	<?php
}

/**
 * Google Map iframe (lazy) in a rounded frame.
 *
 * @param string $class Extra classes (height / min-height).
 */
function mb_map_embed( $class = '' ) {
	$src = function_exists( 'mb_map_embed_url' ) ? mb_map_embed_url() : '';
	if ( ! $src ) {
		return;
	}
	?>
	<?php $title = sprintf( /* translators: %s: salon name. */ __( 'Map showing the location of %s', 'maison-belle-child' ), mb_s( 'salon_name' ) ); ?>
	<div class="map <?php echo esc_attr( $class ); ?>">
		<?php /* The map is only fetched when it is about to scroll into view (main.js); without JS the <noscript> copy loads it. */ ?>
		<iframe
			title="<?php echo esc_attr( $title ); ?>"
			data-src="<?php echo esc_url( $src ); ?>"
			loading="lazy"
			referrerpolicy="no-referrer-when-downgrade"
			allowfullscreen></iframe>
		<noscript><iframe title="<?php echo esc_attr( $title ); ?>" src="<?php echo esc_url( $src ); ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe></noscript>
	</div>
	<?php
}

/**
 * Estimated reading time, e.g. "5 min read".
 *
 * @param int|WP_Post|null $post Post.
 * @return string
 */
function mb_reading_time( $post = null ) {
	$post  = get_post( $post );
	$words = $post ? str_word_count( wp_strip_all_tags( strip_shortcodes( $post->post_content ) ) ) : 0;
	$mins  = max( 1, (int) ceil( $words / 200 ) );
	/* translators: %d: minutes. */
	return sprintf( __( '%d min read', 'maison-belle-child' ), $mins );
}

/**
 * First category name of a post (for the small label above titles).
 *
 * @param int|WP_Post|null $post Post.
 * @return string
 */
function mb_post_category( $post = null ) {
	$cats = get_the_category( $post ? get_post( $post )->ID : get_the_ID() );
	return $cats ? $cats[0]->name : '';
}

/**
 * Date in the long format used by the design (September 12, 2026).
 *
 * @param int|WP_Post|null $post Post.
 * @return string
 */
function mb_post_date( $post = null ) {
	return get_the_date( 'F j, Y', $post );
}

<?php
/**
 * Template functions the theme (or any other theme) calls to read salon data.
 *
 * @package MaisonBelleCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get all settings merged with defaults (cached per request).
 *
 * @return array
 */
function mb_get_settings() {
	static $cache = null;
	if ( null === $cache ) {
		$saved = get_option( 'mb_settings', array() );
		$cache = wp_parse_args( is_array( $saved ) ? $saved : array(), mb_settings_defaults() );
	}
	return $cache;
}

/**
 * Get one setting.
 *
 * @param string $key     Setting key (see settings-schema.php).
 * @param mixed  $default Fallback when the key is unknown.
 * @return mixed
 */
function mb_get_setting( $key, $default = '' ) {
	$all = mb_get_settings();
	return array_key_exists( $key, $all ) ? $all[ $key ] : $default;
}

/**
 * Turn "Crafted *care*, from fingertip" into safe HTML with <em>.
 *
 * @param string $text Plain text with optional *emphasis*.
 * @return string Escaped HTML.
 */
function mb_emphasis( $text ) {
	$safe = esc_html( $text );
	return preg_replace( '/\*([^*]+)\*/', '<em>$1</em>', $safe );
}

/**
 * Split a multi-line value into a clean array of lines.
 *
 * @param string $value Raw value.
 * @return string[]
 */
function mb_lines( $value ) {
	$lines = preg_split( '/\r\n|\r|\n/', (string) $value );
	return array_values( array_filter( array_map( 'trim', $lines ), 'strlen' ) );
}

/**
 * Phone number in dial format (+15551234567).
 *
 * @return string
 */
function mb_phone_tel() {
	$tel = trim( (string) mb_get_setting( 'phone_tel' ) );
	if ( '' === $tel ) {
		$digits = preg_replace( '/\D+/', '', (string) mb_get_setting( 'phone' ) );
		if ( '' === $digits ) {
			return '';
		}
		$tel = ( 10 === strlen( $digits ) ? '+1' : '+' ) . $digits;
	}
	return preg_replace( '/[^\d+]/', '', $tel );
}

/**
 * One-line postal address.
 *
 * @return string
 */
function mb_full_address() {
	$line = sprintf(
		'%s, %s, %s %s',
		mb_get_setting( 'street' ),
		mb_get_setting( 'city' ),
		mb_get_setting( 'region' ),
		mb_get_setting( 'postal' )
	);
	return trim( preg_replace( '/\s+/', ' ', str_replace( ' ,', ',', $line ) ), ' ,' );
}

/**
 * Google Maps "directions / search" link.
 *
 * @return string
 */
function mb_maps_url() {
	$query = mb_get_setting( 'map_query' ) ? mb_get_setting( 'map_query' ) : mb_full_address();
	if ( 0 === strpos( $query, 'http' ) ) {
		return $query;
	}
	return 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( $query );
}

/**
 * Google Maps iframe source URL.
 *
 * @return string
 */
function mb_map_embed_url() {
	$query = mb_get_setting( 'map_query' ) ? mb_get_setting( 'map_query' ) : mb_full_address();
	if ( 0 === strpos( $query, 'https://www.google.com/maps/embed' ) ) {
		return $query;
	}
	return 'https://www.google.com/maps?q=' . rawurlencode( $query ) . '&output=embed';
}

/**
 * Booking URL (external).
 *
 * @return string
 */
function mb_booking_url() {
	$url = (string) mb_get_setting( 'booking_url' );
	return '' === $url ? '#' : $url;
}

/**
 * Opening hours rows that have a label and a time.
 *
 * @return array[] Each: label, time, days[], opens, closes.
 */
function mb_get_hours() {
	$rows = mb_get_setting( 'hours', array() );
	$out  = array();
	if ( is_array( $rows ) ) {
		foreach ( $rows as $row ) {
			if ( ! empty( $row['label'] ) && ! empty( $row['time'] ) ) {
				$out[] = wp_parse_args( $row, array( 'days' => array(), 'opens' => '', 'closes' => '' ) );
			}
		}
	}
	return $out;
}

/**
 * Social links that have a URL: name => url.
 *
 * @return array<string,string>
 */
function mb_get_socials() {
	$out = array();
	foreach ( array( 'Instagram', 'Facebook', 'Google', 'Yelp' ) as $name ) {
		$url = (string) mb_get_setting( 'social_' . strtolower( $name ) );
		if ( '' !== $url ) {
			$out[ $name ] = $url;
		}
	}
	return $out;
}

/**
 * Format a price: whole numbers without decimals.
 *
 * @param mixed $price Number.
 * @return string e.g. "$28" or "$28.50".
 */
function mb_format_price( $price ) {
	$price  = (float) $price;
	$symbol = (string) mb_get_setting( 'currency' );
	$number = floor( $price ) === $price ? (string) (int) $price : number_format( $price, 2 );
	return $symbol . $number;
}

/**
 * Service categories ordered by their "order" term meta.
 *
 * @return WP_Term[]
 */
function mb_get_service_categories() {
	$terms = get_terms(
		array(
			'taxonomy'   => 'mb_service_cat',
			'hide_empty' => false,
		)
	);
	if ( is_wp_error( $terms ) ) {
		return array();
	}
	usort(
		$terms,
		function ( $a, $b ) {
			$oa = (int) get_term_meta( $a->term_id, 'mb_order', true );
			$ob = (int) get_term_meta( $b->term_id, 'mb_order', true );
			return $oa === $ob ? $a->term_id <=> $b->term_id : $oa <=> $ob;
		}
	);
	return $terms;
}

/**
 * Services (menu items) in one category, ordered by "Order" then title.
 *
 * @param int $term_id Category term ID.
 * @return array[] Each: name, price (float), duration, description.
 */
function mb_get_services_in_category( $term_id ) {
	$posts = get_posts(
		array(
			'post_type'      => 'mb_service',
			'posts_per_page' => 100,
			'orderby'        => array( 'menu_order' => 'ASC', 'title' => 'ASC' ),
			'tax_query'      => array( array( 'taxonomy' => 'mb_service_cat', 'terms' => $term_id ) ), // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
		)
	);
	$out   = array();
	foreach ( $posts as $post ) {
		$out[] = array(
			'name'        => get_the_title( $post ),
			'price'       => (float) get_post_meta( $post->ID, 'mb_price', true ),
			'duration'    => (string) get_post_meta( $post->ID, 'mb_duration', true ),
			'description' => (string) get_post_meta( $post->ID, 'mb_description', true ),
		);
	}
	return $out;
}

/**
 * Whole services menu: categories with their items and display data.
 *
 * @return array[]
 */
function mb_get_services_menu() {
	$menu = array();
	foreach ( mb_get_service_categories() as $term ) {
		$items = mb_get_services_in_category( $term->term_id );
		$from  = $items ? min( wp_list_pluck( $items, 'price' ) ) : 0;
		$menu[] = array(
			'id'       => $term->slug,
			'name'     => $term->name,
			'short'    => (string) get_term_meta( $term->term_id, 'mb_short', true ),
			'blurb'    => (string) get_term_meta( $term->term_id, 'mb_blurb', true ),
			'icon'     => get_term_meta( $term->term_id, 'mb_icon', true ) ? get_term_meta( $term->term_id, 'mb_icon', true ) : 'sparkle',
			'tone'     => get_term_meta( $term->term_id, 'mb_tone', true ) ? get_term_meta( $term->term_id, 'mb_tone', true ) : 'blush',
			'image_id' => (int) get_term_meta( $term->term_id, 'mb_image', true ),
			'alt'      => (string) get_term_meta( $term->term_id, 'mb_alt', true ),
			'items'    => $items,
			'from'     => $from,
		);
	}
	return $menu;
}

/**
 * Gallery items (ordered), optionally limited.
 *
 * @param int $limit Max items, -1 for all.
 * @return array[] Each: id, category, aspect, image_id, alt, tone, icon.
 */
function mb_get_gallery_items( $limit = -1 ) {
	$posts = get_posts(
		array(
			'post_type'      => 'mb_gallery',
			'posts_per_page' => $limit,
			'orderby'        => array( 'menu_order' => 'ASC', 'ID' => 'ASC' ),
		)
	);
	$out   = array();
	foreach ( $posts as $post ) {
		$terms = get_the_terms( $post, 'mb_gallery_cat' );
		$out[] = array(
			'id'       => $post->ID,
			'category' => ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->name : '',
			'aspect'   => get_post_meta( $post->ID, 'mb_aspect', true ) ? get_post_meta( $post->ID, 'mb_aspect', true ) : 'portrait',
			'image_id' => (int) get_post_thumbnail_id( $post ),
			'alt'      => get_the_title( $post ),
			'tone'     => get_post_meta( $post->ID, 'mb_tone', true ) ? get_post_meta( $post->ID, 'mb_tone', true ) : 'blush',
			'icon'     => get_post_meta( $post->ID, 'mb_icon', true ) ? get_post_meta( $post->ID, 'mb_icon', true ) : 'sparkle',
		);
	}
	return $out;
}

/**
 * Gallery category names, ordered by term order then name.
 *
 * @return string[]
 */
function mb_get_gallery_categories() {
	$terms = get_terms( array( 'taxonomy' => 'mb_gallery_cat', 'hide_empty' => true ) );
	if ( is_wp_error( $terms ) ) {
		return array();
	}
	usort(
		$terms,
		function ( $a, $b ) {
			return $a->term_id <=> $b->term_id;
		}
	);
	return wp_list_pluck( $terms, 'name' );
}

/**
 * Reviews.
 *
 * @return array[] Each: name, service, rating, text.
 */
function mb_get_reviews() {
	$posts = get_posts(
		array(
			'post_type'      => 'mb_review',
			'posts_per_page' => 30,
			'orderby'        => array( 'menu_order' => 'ASC', 'ID' => 'ASC' ),
		)
	);
	$out   = array();
	foreach ( $posts as $post ) {
		$rating = (int) get_post_meta( $post->ID, 'mb_rating', true );
		$out[]  = array(
			'name'    => get_the_title( $post ),
			'service' => (string) get_post_meta( $post->ID, 'mb_service', true ),
			'rating'  => $rating >= 1 && $rating <= 5 ? $rating : 5,
			'text'    => (string) get_post_meta( $post->ID, 'mb_text', true ),
		);
	}
	return $out;
}

/**
 * Promotions.
 *
 * @return array[]
 */
function mb_get_promotions() {
	$posts = get_posts(
		array(
			'post_type'      => 'mb_promo',
			'posts_per_page' => 30,
			'orderby'        => array( 'menu_order' => 'ASC', 'ID' => 'ASC' ),
		)
	);
	$out   = array();
	foreach ( $posts as $post ) {
		$out[] = array(
			'id'        => $post->ID,
			'title'     => get_the_title( $post ),
			'tag'       => (string) get_post_meta( $post->ID, 'mb_tag', true ),
			'highlight' => (string) get_post_meta( $post->ID, 'mb_highlight', true ),
			'text'      => (string) get_post_meta( $post->ID, 'mb_text', true ),
			'fine'      => (string) get_post_meta( $post->ID, 'mb_fine', true ),
			'icon'      => get_post_meta( $post->ID, 'mb_icon', true ) ? get_post_meta( $post->ID, 'mb_icon', true ) : 'sparkle',
			'cta_label' => get_post_meta( $post->ID, 'mb_cta_label', true ) ? get_post_meta( $post->ID, 'mb_cta_label', true ) : __( 'Book now', 'maison-belle-core' ),
			'cta_url'   => get_post_meta( $post->ID, 'mb_cta_url', true ) ? get_post_meta( $post->ID, 'mb_cta_url', true ) : mb_booking_url(),
		);
	}
	return $out;
}

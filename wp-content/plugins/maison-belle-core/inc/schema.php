<?php
/**
 * schema.org structured data: NailSalon (local business) and BlogPosting.
 *
 * Duplicate protection: if an SEO plugin already outputs equivalent markup
 * (Yoast Local / Rank Math Local SEO), ours switches itself off. Yoast SEO free
 * does not output a LocalBusiness, so our NailSalon block is the only one; Yoast's
 * own Article node is upgraded to BlogPosting instead of adding a second one.
 *
 * @package MaisonBelleCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Does another plugin already output LocalBusiness markup?
 *
 * @return bool
 */
function mb_seo_plugin_outputs_local_business() {
	$has_local = class_exists( 'WPSEO_Local_Core' ) || class_exists( 'RankMathPro\\Local_Seo\\Local_Seo' ) || defined( 'RANK_MATH_PRO_VERSION' );
	/**
	 * Filter: force the NailSalon schema on or off.
	 *
	 * @param bool $has_local True when another plugin handles local business schema.
	 */
	return (bool) apply_filters( 'mb_external_local_business_schema', $has_local );
}

/**
 * Best available image URL for structured data.
 *
 * @return string
 */
function mb_schema_image_url() {
	foreach ( array( (int) mb_get_setting( 'logo' ), (int) mb_get_setting( 'hero_image_main' ), (int) get_option( 'site_icon' ) ) as $id ) {
		if ( $id ) {
			$url = wp_get_attachment_image_url( $id, 'large' );
			if ( $url ) {
				return $url;
			}
		}
	}
	return '';
}

/**
 * Build the NailSalon data array.
 *
 * @return array
 */
function mb_build_salon_schema() {
	$url  = home_url( '/' );
	$data = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'NailSalon',
		'@id'         => trailingslashit( $url ) . '#salon',
		'name'        => mb_get_setting( 'salon_name' ),
		'description' => mb_get_setting( 'description' ),
		'url'         => $url,
		'telephone'   => mb_phone_tel(),
		'email'       => mb_get_setting( 'email' ),
		'priceRange'  => mb_get_setting( 'price_range' ),
		'address'     => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => mb_get_setting( 'street' ),
			'addressLocality' => mb_get_setting( 'city' ),
			'addressRegion'   => mb_get_setting( 'region' ),
			'postalCode'      => mb_get_setting( 'postal' ),
			'addressCountry'  => mb_get_setting( 'country' ),
		),
		'hasMap'      => mb_maps_url(),
	);

	$image = mb_schema_image_url();
	if ( $image ) {
		$data['image'] = $image;
	}

	if ( is_numeric( mb_get_setting( 'lat' ) ) && is_numeric( mb_get_setting( 'lng' ) ) ) {
		$data['geo'] = array(
			'@type'     => 'GeoCoordinates',
			'latitude'  => (float) mb_get_setting( 'lat' ),
			'longitude' => (float) mb_get_setting( 'lng' ),
		);
	}

	$hours = array();
	foreach ( mb_get_hours() as $row ) {
		if ( empty( $row['days'] ) || empty( $row['opens'] ) || empty( $row['closes'] ) ) {
			continue;
		}
		$hours[] = array(
			'@type'     => 'OpeningHoursSpecification',
			'dayOfWeek' => array_map(
				function ( $day ) {
					return 'https://schema.org/' . $day;
				},
				$row['days']
			),
			'opens'     => $row['opens'],
			'closes'    => $row['closes'],
		);
	}
	if ( $hours ) {
		$data['openingHoursSpecification'] = $hours;
	}

	$same = array_values( array_filter( mb_get_socials(), function ( $u ) {
		return 0 === strpos( $u, 'http' );
	} ) );
	if ( $same ) {
		$data['sameAs'] = $same;
	}

	$catalog = array();
	foreach ( mb_get_services_menu() as $cat ) {
		$offers = array();
		foreach ( $cat['items'] as $item ) {
			$offers[] = array(
				'@type'         => 'Offer',
				'priceCurrency' => mb_get_setting( 'currency_code' ),
				'price'         => $item['price'],
				'itemOffered'   => array( '@type' => 'Service', 'name' => $item['name'] ),
			);
		}
		$catalog[] = array( '@type' => 'OfferCatalog', 'name' => $cat['name'], 'itemListElement' => $offers );
	}
	if ( $catalog ) {
		$data['hasOfferCatalog'] = array( '@type' => 'OfferCatalog', 'name' => 'Services', 'itemListElement' => $catalog );
	}

	/**
	 * Filter the NailSalon schema array before output.
	 *
	 * @param array $data Schema data.
	 */
	return apply_filters( 'mb_salon_schema', $data );
}

/**
 * Print JSON-LD in <head>.
 */
function mb_output_schema() {
	if ( ! mb_seo_plugin_outputs_local_business() ) {
		echo '<script type="application/ld+json" id="mb-salon-schema">' . wp_json_encode( mb_build_salon_schema(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG ) . "</script>\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- JSON, tags hex-encoded.
	}

	// BlogPosting: only when no SEO plugin handles Article markup.
	if ( is_singular( 'post' ) && ! defined( 'WPSEO_VERSION' ) && ! defined( 'RANK_MATH_VERSION' ) ) {
		$post = get_queried_object();
		$blog = array(
			'@context'         => 'https://schema.org',
			'@type'            => 'BlogPosting',
			'headline'         => get_the_title( $post ),
			'description'      => wp_strip_all_tags( get_the_excerpt( $post ) ),
			'datePublished'    => get_the_date( 'c', $post ),
			'dateModified'     => get_the_modified_date( 'c', $post ),
			'author'           => array( '@type' => 'Organization', 'name' => mb_get_setting( 'salon_name' ) ),
			'publisher'        => array( '@type' => 'Organization', 'name' => mb_get_setting( 'salon_name' ) ),
			'mainEntityOfPage' => get_permalink( $post ),
		);
		if ( has_post_thumbnail( $post ) ) {
			$blog['image'] = get_the_post_thumbnail_url( $post, 'large' );
		}
		echo '<script type="application/ld+json" id="mb-blogposting-schema">' . wp_json_encode( $blog, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG ) . "</script>\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
add_action( 'wp_head', 'mb_output_schema', 30 );

/**
 * With Yoast SEO active, make its Article node a BlogPosting (as in the design spec).
 *
 * @param string|string[] $type Article type chosen by Yoast.
 * @return string|string[]
 */
function mb_yoast_article_type( $type = '' ) {
	return is_singular( 'post' ) ? 'BlogPosting' : $type;
}
add_filter( 'wpseo_schema_article_type', 'mb_yoast_article_type' );
